<?php

class AdminContentCtrl extends AdminAbstractCtrl {
    private $modelId = 0;
    private $modelData = 0;

    public function beforeAction() {
        if (!parent::beforeAction()) return false;
        $this->getModelData();
        return true;
    }

    private function getModelData() {
        $this->modelId = intval($_REQUEST['model']);
        if (!$this->modelId) die('param model error');

        $modelT = new FTable('model');
        $this->modelData = $modelT->where("id='{$this->modelId}'")->find();

        if (!$this->modelData) die('model not found!');
        $this->modelData['fields'] = json_decode($this->modelData['summary'], true);

        $this->assign('modelData', $this->modelData);
    }

    public function indexAction() {
        $this->modelId = intval($_REQUEST['model']);

        $key_word = ($_REQUEST['key_word']);

        $modelT = new FTable('model');
        $model_info = $modelT->where('id=' . $this->modelId)->find();
        $model_info['summary'] = json_decode($model_info["summary"], true);
        $articleT = new FTable($this->modelData['table_name']);

        $num = FSession::get("perPage");
        $num = $num ? $num : 30;
        $this->assign('num', $num);
        if ($key_word) {
            $list = $articleT->where("code LIKE '%" . $key_word . "%'")->page($_GET['page'])->limit($num)->select();
        } else {
            $list = $articleT->page($_GET['page'])->limit($num)->order('id desc')->select();
        }
        foreach ($list as $key => $v) {
            foreach ($model_info['summary'] as $a => $b) {
                if ($model_info['summary'][$a][4] == 1) {
                    $m_name = $model_info['summary'][$a][0];
                    $m_title = $model_info['summary'][$a][2];
                    $list[$key]['show_list'][$m_title] = $list[$key][$m_name];
                }
            }
        }
        $this->assign('list', $list);
        $this->assign('model_info', $model_info['summary']);
        $this->assign('page_info', $articleT->getPagerInfo());
        $this->display();
    }

    public function categoryAction() {
        $cats = array();
        $t = new FTable('category');
        $cats_0 = $t->where("model_id='{$this->modelId}' and parent_id=0")->order(array('id' => 'asc'))->select();

        foreach ($cats_0 as $key => $item) {
            $cats_1 = null;
            $item['class'] = 0;
            $cats[] = $item;

            $cats_1 = $t->where('parent_id=' . $item['id'])->order(array('id' => 'asc'))->select();
            foreach ($cats_1 as $key1 => $item1) {
                $cats_2 = null;
                $item1['class'] = 1;
                $cats[] = $item1;

                $cats_2 = $t->where('parent_id=' . $item1['id'])->order(array('id' => 'asc'))->select();
                foreach ($cats_2 as $key2 => $item2) {
                    $cats_2 = null;
                    $item2['class'] = 2;
                    $cats[] = $item2;
                }
            }

//            $cats[$key]['son'] = $tmp_cats;
        }


        $this->assign('cats', $cats);

        $this->display();
    }

    public function categoryAddAction() {
        $t = new FTable('category');

        if (IS_POST) {
            $name = $_POST['name'];
            $parent_id = FRequest::getPostInt('parent_id');

            $data = array(
                'name' => $name,
                'parent_id' => $parent_id,
                'model_id' => $this->modelId,
            );
            $id = intval($_POST['id']);

            if ($id) {
                $t->where("id=$id")->update($data);
            } else {
                $t->insert($data);
            }
            // 更新 parent_id
            $son_count = $t->where(array('parent_id' => $parent_id))->count();
            $t->where(array('id' => $parent_id))->update(array('son_count' => $son_count));
            echo "<script>parent.location.reload();</script>";
            exit;
        }
        $id = intval($_GET['id']);
        if ($id) {
            $catData = $t->find($id);
            $this->assign('catData', $catData);
        }
        $cats = array();
        $t = new FTable('category');
        $cats_0 = $t->where("model_id='{$this->modelId}' and parent_id=0")
        ->order(array('id' => 'asc'))->select();
        foreach ($cats_0 as $key => $item) {
            $cats_1 = null;
            $item['class'] = 0;
            $cats[] = $item;
            $cats_1 = $t->where('parent_id=' . $item['id'])->order(array('id' => 'asc'))->select();
            foreach ($cats_1 as $key1 => $item1) {
                $item1['class'] = 1;
                $cats[] = $item1;
            }
//            $cats[$key]['son'] = $tmp_cats;
        }

        $this->assign('cats', $cats);
        $this->display();
    }

    public function categoryDelAction() {
        $id = FRequest::getInt('id');
        $t = new FTable('category');
        $a = new FTable('article');
        if ($t->where("parent_id = $id")->select()) {
            FResponse::output(array('result' => 2));
        } else {
//            if($a->where("cat_id = $id")->select()){
//                FResponse::output(array('result' => 3));
//            }else{
            if ($t->where("id={$id}")->remove(true)) {
                FResponse::output(array('result' => 1));
            }
//            }
        }
    }

    public function addAction() {
        if ($this->isPost()) {
            $t = new FTable('category');

            $articleT = new FTable($this->modelData['table_name']);
            $data = $_POST['data'];

            $_fields = array('title', 'cate_id', 'content');
            foreach ($_fields as $field) {
                if (in_array($field, $this->modelData['fields'])):
                    $data[$field] = trim($_POST[$field]);
                endif;
            }

            if ($_POST['cate_id']) {
                $aa = $t->where('id=' . $_POST['cate_id'])->find();
                $data['parent_cate_id'] = trim($aa['parent_id']);
            }

            $current_lang = FSession::get("lang");
            $data['lang'] = $current_lang ? $current_lang : 'zh_CN';

            if (in_array('pic', $this->modelData['fields'])):
                $upload_file = FUploader::saveFile('up_pic', 'model');
                if ($upload_file) {
                    $data['pic'] = $upload_file;
                }
            endif;

            $id = intval($_POST['id']);
            if ($id) {
                $result = $articleT->update($data, "id='{$id}'");
                $text = '数据更新成功';
            } else {
                if ($_POST['data']['code']) {
                    $strs = $_POST['data']['code'];
                    $strs = str_replace('，', ',', $strs);
                    $strs = str_replace("n", ',', $strs);
                    $strs = str_replace("rn", ',', $strs);
                    $strs = str_replace("\r\n", ',', $strs);
                    $strs = str_replace(' ', ',', $strs);
                    $code_array = explode(',', $strs);
                    foreach ($code_array as $key => $v) {
                        $order_info = $articleT->where("code='" . $v . "'")->find();
                        if (!$order_info) {
                            $new_array = $data;
                            $new_array['code'] = $v;
                            $result = $articleT->insert($new_array);
                        }
                    }
                } else {
//                    var_dump($data);exit;
                    $result = $articleT->insert($data);
                }
                $text = '数据添加成功';
            }

            if ($result) {
                $this->success($text, 'javascript:history.back(-1);');
            } else {
                $this->error('数据操作失败！');
            }
        }

        $id = intval($_GET['id']);
        if ($id) {
            $articleT = new FTable($this->modelData['table_name']);
            $initData = $articleT->where("id='{$id}'")->find();

            $this->assign('initData', $initData);
        }


        $categoryArray = array();
        $t = new FTable('category');
        $cats_0 = $t->where("model_id='{$this->modelId}' and parent_id=0")
        ->order(array('id' => 'asc'))->select();
        foreach ($cats_0 as $key => $item) {
            $cats_1 = null;
            $item['class'] = 0;
            $categoryArray[] = $item;
            $cats_1 = $t->where('parent_id=' . $item['id'])->order(array('id' => 'asc'))->select();
            foreach ($cats_1 as $key1 => $item1) {
                $item1['class'] = 1;
                $categoryArray[] = $item1;
            }
        }
        $this->assign('categoryArray', $categoryArray);


        $this->display();
    }

    public function importAction() {
        global $_F;
//        $_F['debug'] = 1;

        try {
            $data['up_import_txt'] = FUploader::saveFile('up_import_txt', 'file');
        } catch (Exception $e) {
            echo($e->getMessage());
            exit;
        }

        $file = WEB_ROOT_DIR . 'uploads/' . $data['up_import_txt'];
//        var_dump($file);exit;

//        $file = '/data/project/api_kd/src/uploads/file/20160628/0933355468.xls';

        require_once F_APP_ROOT . 'lib/PHPExcel/PHPExcel.php';
        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
        $objPHPExcel = $objReader->load($file);
        $objWorksheet = $objPHPExcel->getActiveSheet();

        $map = array('code', 'third_delivery_code', 'third_delivery_name', 'departure_place', 'destination_place');
        $deliveryT = new FTable('delivery');
        $kd100T = new FTable('kd100');


        echo '<table class="table table-bordered">';
        echo '<thead><tr><td>系统订单号</td><td>国内快递号</td><td>状态</td></tr></thead>';
        echo '<tbody>';


        foreach ($objWorksheet->getRowIterator() as $row) {

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $data = array();
            foreach ($cellIterator as $key => $cell) {
                $data[$map[$key]] = trim($cell->getValue());
            }

            $code = $data['code'];

            if (!$code || $code == '自定义单号') continue;

            $aa = $deliveryT->where("code='{$code}'")->find();
            if ($aa) {
                unset($data['code']);
                $deliveryT->where("code='" . $code . "'")->update($data);
                $CodeData = $kd100T->where("code='" . $code . "'")->find();

                //todo 做个判断，kd100 不要重复
                if (!$CodeData['code'] == $code) {
                    // 只保存到数据库，不推送
                    $kd100T->insert(array(
                        'code' => $code,
                        'third_delivery_name' => $data['third_delivery_name'],
                        'departure_place' => $data['departure_place'],
                        'destination_place' => $data['destination_place'],
                        'api_status' => '<span style="color:#ccc;">未订阅</span>',
                        'third_delivery_code' => $data['third_delivery_code'],
                        'content' => '',
                        'create_time' => date('y-m-d h:i:s', time())
                    ));

                    echo "<tr style=\"color:green;\"><td>{$code}</td><td>{$data['third_delivery_code']}</td><td><span style=\"color:green;\">导入成功，未订阅</span></td></tr>";
                } else {

                    echo "<tr style=\"color:green;\"><td>{$code}</td><td>{$data['third_delivery_code']}</td><td><span style=\"color:crimson;\">重复导入</span></td></tr>";

                }

                /*

                                  // 推送到 kd 100
                                  $eleAPI = new Service_KdAPI();
                                  $result = $eleAPI->Subscription_request($data['third_delivery_name'], $data['third_delivery_code'], $data['departure_place'], $data['destination_place']);
                                  $kd100T->insert(array(
                                      'code' => $code,
                                      'api_status' => $result['result'] ? '<span style="color:green;">成功</span>' : '<span style="color:red;">失败</span>',
                                      'third_delivery_code' => $data['third_delivery_code'],
                                      'content' => $result['message'],
                                      'create_time' => date('y-m-d h:i:s', time())
                                  ));*/
            } else {
                echo "<tr><td>{$code}</td><td>{$data['third_delivery_code']}</td><td><span style=\"color:red;\">不匹配</span></td></tr>";
            }


        }

        echo '</tbody></table>';

        echo "<button type='button' onclick='window.close();'>关闭页面</button>";


        unlink($file);
//        redirect('/admin/content/index?model=12');

    }

    public function subscribeAction() {

        $id = trim($_REQUEST['id'], ',');


       $kd100T = new FTable('kd100');

        $data1 = $kd100T->where("id in ($id)")->select();


        if (!preg_match('/[\d,]+/', $id)) {

            FResponse::output(array('result' => 0));

            exit();
        }

        if ($id) {
            $eleAPI = new Service_KdAPI();
            foreach ($data1 as $data) {
                $code = $data['code'];
                // 推送到 kd 100
                $result = $eleAPI->Subscription_request($data['third_delivery_name'], $data['third_delivery_code'], $data['departure_place'], $data['destination_place']);
                $kd100T->where("code='" . $code . "'")->update(array('api_status' => $result['result'] ? '<span style="color:green;">成功</span>' : '<span style="color:red;">失败</span>', 'third_delivery_code' => $data['third_delivery_code'], 'content' => $result['message'], 'create_time' => date('y-m-d h:i:s', time())));
            }
            FResponse::output(array('result' => 1));
        }
    }
    public function delAction() {
        $id = trim($_REQUEST['id'], ',');

        if (!preg_match('/[\d,]+/', $id)) {
            FResponse::output(array('result' => 0));
            exit();
        }

        $articleT = new FTable($this->modelData['table_name']);
        if ($articleT->where("id in ($id)")->remove(true)) {
            FResponse::output(array('result' => 1));
        }
    }

    public function content_list_delAction() {
        $id = intval($_POST['id']);
        $delivery_statusT = new FTable('delivery_status');
        $aa = $delivery_statusT->where("id='{$id}'")->remove(true);
        if ($aa) {
            FResponse::output(array('result' => 1));
        }
    }

    public function content_list_saveAction() {
        $data['id'] = intval($_POST['id']);
        $data["reach_time"] = $_POST['reach_time'];
        $data["summary"] = $_POST['summary'];
        $data["update_time"] = date('y-m-d h:i:s', time());
        $delivery_statusT = new FTable('delivery_status');
        if ($data['id']) {
            $aa = $delivery_statusT->where("id='{$data['id']}'")->update($data);
        }
        if ($aa) {
            FResponse::output(array('result' => 1));
        }
    }

    public function content_list_addAction() {
        $data['delivery_id'] = intval($_POST['id']);
        $data["reach_time"] = date('y-m-d h:i:s', time());
        $data["status"] = 0;
        $data["summary"] = $_POST['summary'];
        $data["update_time"] = date('y-m-d h:i:s', time());
        $delivery_statusT = new FTable('delivery_status');
        if ($data['delivery_id']) {
            $aa = $delivery_statusT->insert($data);
        }
        if ($aa) {
            FResponse::output(array('result' => 1, 'id' => $aa, 'time' => $data["reach_time"], 'summary' => $data["summary"]));
        }
    }

}
