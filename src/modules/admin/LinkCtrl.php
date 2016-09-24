<?php

class AdminLinkCtrl extends AdminAbstractCtrl {
    public function indexAction() {
        $l = new FTable("link");
        $info = $l->page($_GET['page'])->limit(10)->select();
        $this->assign('info',$info);
        $this->assign('page_info', $l->getPagerInfo());
        $this->display();
    }

    public function addAction(){
        $l = new FTable("link");
        if($_POST){
            if($_POST['id']){
                $id = $_POST['id'];
                $_POST['url'] = sanitize_url($_POST['url']);
                $l->where(array('id' => $id))->update($_POST);
                $msg = '已经更新';
            }else{
                $_POST['url'] = sanitize_url($_POST['url']);
                $l->insert($_POST);
                $msg = '添加成功';
            }
            $this->success($msg, '/admin/Link/index');
        }
        if($_GET['id']){
            $info = $l->find($_GET['id']);
            $this->assign('info', $info);
        }
        $this->display();
    }
    public function delAction(){
        $id = $_REQUEST['id'];
        $m = new FTable("link");
        if($m->where("id = $id")->remove(true)){
            echo 1;
        }else{
            echo 0;
        }
    }

}