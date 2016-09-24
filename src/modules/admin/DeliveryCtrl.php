<?php

class AdminDeliveryCtrl extends AdminAbstractCtrl {
    public function importAction() {

        ob_clean();
        echo <<<EOF
        <!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
EOF;

        $file = null;
        try {
            $file = F_APP_ROOT . 'uploads/' . FUploader::saveFile('file', 'file');
        } catch (Exception $e) {
            echo($e->getMessage());
            exit;
        }

//        $file = F_APP_ROOT . 'uploads/file/20160624/1704019800.xls';

        require_once F_APP_ROOT . 'lib/PHPExcel/PHPExcel.php';
        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
        $objPHPExcel = $objReader->load($file);

        $objWorksheet = $objPHPExcel->getActiveSheet();
        $i = 0;
        echo '<table class="table table-bordered">';
        foreach ($objWorksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            if ($i == 0) {
                echo '<thead>';
            }

            $data = array();
            echo '<tr>';

            foreach ($cellIterator as $key => $cell) {
                switch ($key) {
                    case 0:
                        $data['code'] = $cell->getValue();
                        break;
                    case 1:
                        $data['reach_time'] = str_replace(array('年', '月', '日'), '-', $cell->getValue());
                        break;
                    case 2:
                        $data['summary'] = $cell->getValue();
                        break;
                }
                echo '<td>' . $cell->getValue() . '</td>';
            }

            if ($i == 0) {
                echo '<td>状态</td>';
            } else {

                $result = $this->saveDeliveryStatus($data);

                if ($result['result'] == 'ok') {
                    echo '<td style="color: green;">更新成功</td>';
                } else {
                    echo '<td style="color: red;">' . $result['msg'] . '</td>';
                }
            }
            echo '</tr>';


            if ($i == 0) {
                echo '</thead>';
            }
            $i++;
        }

        echo '</table>';
        echo <<<EOF
        </div>
        </body>
</html>
EOF;
    }

    public function saveDeliveryStatus($delivery) {

        $code = $delivery['code'];
        $summary = $delivery['summary'];
        $reach_time = $delivery['reach_time'];
        $deliveryT = new FTable('delivery');
        $deliveryST = new FTable('delivery_status');
        $deliveryData = $deliveryT->where("code='{$code}'")->find();

        if ($deliveryData) {

            if (!$delivery['summary']) {
                return array('result' => 'error', 'msg' => '跳过');
            }


            $deliveryStatusData = $deliveryST->where("delivery_id='{$deliveryData['id']}' and reach_time='{$reach_time}'")->find();


            if ($deliveryStatusData) {
                return array('result' => 'error', 'msg' => '重复导入');
            } else {
                $deliveryST->insert(array(
                    'delivery_id' => $deliveryData['id'],
                    'reach_time' => $reach_time,
                    'summary' => $summary,
                    'status' => 0,
                ));
                $deliveryT->where("code='" . $code . "'")->update(array('now_status' => $summary));
                return array('result' => 'ok', 'msg' => '');
            }
        } else {

            $deliveryT->insert(array('code' => $code));

            if ($summary) {
                $deliveryT->where("code='" . $code . "'")->update(array('now_status' => $summary));
                $Data = $deliveryT->where("code='{$code}'")->find();

                if ($Data) {
                    $deliveryST->insert(array(
                        'delivery_id' => $Data['id'],
                        'reach_time' => $reach_time,
                        'summary' => $summary,
                        'status' => 0,
                    ));
                }


            }

            return array('result' => 'error', 'msg' => '新订单导入成功');
        }
    }

    function isUTF8($str) {
        if ($str === mb_convert_encoding(mb_convert_encoding($str, "UTF-32", "UTF-8"), "UTF-8", "UTF-32")) {
            return true;
        } else {
            return false;
        }
    }

}