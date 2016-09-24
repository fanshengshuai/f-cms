<?php

class AdminSystemCtrl extends AdminAbstractCtrl {
    public function logAction() {

        $t = new FTable('system_log');

        $page = intval($_GET['page']);
        $log_list = $t->page($page)->select();
        $pager = $t->getPagerInfo();

        $this->assign('log_list', $log_list);
        $this->assign('pager', $pager);

        $this->display();
    }

    public function logDelAction() {
        $id = FRequest::getInt('id');

        $t = new FTable('system_log');
        $t->where("id={$id}")->remove(true);

        FResponse::output(array('result' => 1));
    }


    public function systemdelAction() {
        $id = trim($_POST['id'], ',');
        $m = new FTable("system_log");
        if ($m->where("id in ($id)")->remove(true)) {
            echo 1;
        } else {
            echo 0;
        }
    }





}