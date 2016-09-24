<?php

class AdminAdmingroupCtrl extends AdminAbstractCtrl{
    public function indexAction(){
        $a = new FTable("admin_group");
        $info = $a->order("id asc")->select();
        $this->assign('info',$info);
        $this->display();
    }

    public function addAction(){
        $a = new FTable("admin_group");
        if($_POST){
            if(!$_POST['name']){
                $this->error('组名不能为空','/admin/admingroup/index');
            }
            if($_POST['id']){
                $id = $_POST['id'];
                if($a->where("id = $id")->update($_POST)){
                    $this->success('修改成功','/admin/admingroup/index');
                }else{
                    $this->error('修改失败','/admin/admingroup/index');
                }
            }
            if($a->insert($_POST)){
                $this->success('添加成功','/admin/admingroup/index');
            }else{
                $this->error('添加失败','/admin/admingroup/index');
            }
        }
        if($_GET['id']){
            $info = $a->find($_GET['id']);
            $this->assign("info",$info);
        }
        $this->display();
    }
    public function delAction(){
        $a = new FTable("admin_group");
        $id = $_GET['id'];
        if($a->where("id = $id")->remove(true)){
            $this->success('删除成功','/admin/admingroup/index');
        }else{
            $this->error('删除失败','/admin/admingroup/index');
        }
    }
    public function admin_modifyAction(){
        $a = new FTable("admin_group");
        $id = $_GET['id'];
        if($_POST){
            $sys['sys_role'] = json_encode($_POST['cate']);
            if($a->where("id = $id")->update($sys)){
                $this->success('设置权限成功','/admin/admingroup/index');
            }else{
                $this->error('设置权限失败','/admin/admingroup/index');
            }
        }
        $group_info = $a->find($id);
        $group_info['sys_role'] = str_replace('/','_',json_decode($group_info['sys_role'],true));
        $this->assign('group_info',$group_info);
        $g_info = FConfig::get("admin_group");
        $this->assign('g_info',$g_info);
//        echo "<pre>";
//        var_dump($g_info);die;
        $this->display();
    }

    public function article_modifyAction(){
        $a = new FTable("admin_group");
        $id = $_GET['id'];
        $this->assign('gid',$id);

        if($_POST){
            $cms['cms_role'] = json_encode($_POST['cms']);
            if($a->where("id = $id")->update($cms)){
                $this->success('设置权限成功','/admin/admingroup/index');
            }else{
                $this->error('设置权限失败','/admin/admingroup/index');
            }
        }
        $art_group_info = $a->find($id);
        $art_group_info['cms_role'] = json_decode($art_group_info['cms_role'],true);
        $this->assign('art_group_info',$art_group_info);

        $cats = array();
        $t = new FTable('category');
        $cats_0 = $t->where('parent_id=0')->select();

        foreach ($cats_0 as $key => $item) {
            $cats_1 = null;
            $item['class'] = 0;
            $cats[] = $item;

            $cats_1 = $t->where('parent_id=' . $item['id'])->select();
            foreach ($cats_1 as $key1 => $item1) {
                $cats_2 = null;
                $item1['class'] = 1;

                $cats_2 = $t->where('parent_id=' . $item1['id'])->select();
                if ($cats_2) {
                    $item1['child'] = 1;
                }
                $cats[] = $item1;
                foreach ($cats_2 as $key2 => $item2) {
                    $cats_2 = null;
                    $item2['class'] = 2;
                    $cats[] = $item2;
                }
            }
        }

        $this->assign('cats', $cats);
        $this->display();
    }
}