<?php

class AdminSettingCtrl extends AdminAbstractCtrl {
    public function globalAction() {
        $this->display();
    }

    public function pagerAction() {

        $t = new FTable('page');
        $page_info = $t->where('status=1')->order(array('id' => 'desc'))->select();
        $this->assign('page_info', $page_info);
        $this->display();
    }

    public function pageAddAction() {
        $t = new FTable('page');
        if (IS_POST) {
            $url = $_POST['url1'];
            $style = $_POST['style'];
            $content = $_POST['content'];
            $data = array(
                'url' => $url,
                'style' => $style,
                'content' => $content,
            );
            $t->insert($data);
            echo "<script>parent.location.reload();</script>";
            exit;
        }
        $this->display();
    }

    public function pageEditAction() {
        $t = new FTable('page');
        $id = intval($_GET['id']);

        if (IS_POST) {
            $url = $_POST['url1'];
            $style = $_POST['style'];
            $content = $_POST['content'];
            $data = array(
                'url' => $url,
                'style' => $style,
                'content' => $content,
            );
            $t->where("id=$id")->update($data);
            echo "<script>parent.location.reload();</script>";
            exit;
        }
        $page_info = $t->where('id=' . $id)->find();
        $this->assign('page_info', $page_info);
        $this->display();
    }

    public function pageDelAction() {
        $id = FRequest::getInt('id');
        $t = new FTable('page');
        $data = array(
            'status' => '2',
        );
        if ($t->where("id=" . $id)->update($data)) {
            FResponse::output(array('result' => 1));
        }
    }
}