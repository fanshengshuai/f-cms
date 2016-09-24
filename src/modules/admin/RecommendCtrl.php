<?php

class AdminRecommendCtrl extends  AdminAbstractCtrl {
    public function indexAction () {
        $t = new FTable('recommend');
//        $num = $_REQUEST['num'] ? $_REQUEST['num'] : 10;
//        $this->assign('num',$num);
        $where = array();
        if($_REQUEST['title']){
            $title = $_REQUEST['title'];
            $where['title'] = array('like'=>$title);
            $this->assign('title', $title);
        }
        if($_REQUEST['cat_id']){
            $cat_id = $_REQUEST['cat_id'];
            $where['cat_id'] = $cat_id;
            $this->assign('cat_id', $cat_id);
        }
        $info = $t->where($where)->page($_GET['page'])->limit(10)->order("sort desc,id desc")->select();
        $this->assign('info', $info);
        $this->assign('page_info', $t->getPagerInfo());
        $this->display();
    }
    public function addAction(){
        $t = new FTable('recommend');
        if($_POST){
            if($_POST['url']){
                $_POST['url'] = sanitize_url($_POST['url']);
            }
            if($_POST['id']){
                $id = $_POST['id'];
                if($t->where("id=$id")->update($_POST)){
                    $this->success('数据修改成功！','javascript:history.back(-3);');
                }else{
                    $this->error('数据修改失败！','javascript:history.back(-3);');
                }
            }else{
                if($t->insert($_POST)){
                    $this->success('数据添加成功！','/admin/recommend/index');
                }else{
                    $this->error('数据添加失败！','/admin/recommend/index');
                }
            }
        }
        if($_GET['id']){
            $id = $_GET['id'];
            $info = $t->find($id);
            $this->assign('info',$info);
        }
        $this->display();
    }


    public function delAction() {
        $id = trim($_POST['id'], ',');
        $m = new FTable("recommend");
        if ($m->where("id in ($id)")->remove(true)) {
            echo 1;
        } else {
            echo 0;
        }
    }


}