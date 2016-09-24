<?php

class AdminFrontCtrl extends  AdminAbstractCtrl {

    public function indexAction () {
        $t = new FTable('article');
        $cat = new FTable('category');
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num',$num);
        $info = $t->where('parent_id=1')->page($_GET['page'])->limit($num)->order(array('id' => 'desc'))->select();

        $this->assign('info', $info);
        $this->assign('style', '1');
        $this->assign('page_info', $t->getPagerInfo());
        $this->display();
    }
    public function caseAction () {
        $t = new FTable('article');
        $cat = new FTable('category');
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num',$num);
        $info = $t->where('parent_id=2')->page($_GET['page'])->limit($num)->order(array('id' => 'desc'))->select();

        //查询处列出分类
        $cats = $cat->where('parent_id=2')->select();
        $this->assign('cats', $cats);
        $this->assign('info', $info);
        $this->assign('style', '2');
        $this->assign('page_info', $t->getPagerInfo());
        $this->display();
    }
    public function approveAction () {
        $t = new FTable('article');
        $cat = new FTable('category');
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num',$num);
        $info = $t->where('parent_id=33')->page($_GET['page'])->limit($num)->order(array('id' => 'desc'))->select();

        //查询处列出分类
        $cats = $cat->where('parent_id=33')->select();
        $this->assign('cats', $cats);
        $this->assign('info', $info);
        $this->assign('style', '33');
        $this->assign('page_info', $t->getPagerInfo());
        $this->display();
    }
    public function demand_approveAction () {
        $t = new FTable('article');
        $cat = new FTable('category');
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num',$num);
        $info = $t->where('parent_id=34')->page($_GET['page'])->limit($num)->order(array('id' => 'desc'))->select();

        //查询处列出分类
        $cats = $cat->where('parent_id=34')->select();
        $this->assign('cats', $cats);
        $this->assign('info', $info);
        $this->assign('style', '34');
        $this->assign('page_info', $t->getPagerInfo());
        $this->display();
    }
    public function article_addAction(){
        $t = new FTable('category');
        $parent_id = $_GET['parent_id'];
        $list = $t -> where("parent_id=".$parent_id) -> select();
        $this -> assign("list",$list);
        $this -> assign("style",$parent_id);
        $this->display();
    }
    public function insAction(){
        $article = new FTable('article');
        $category = new FTable('category');
        $upload['pic'] = 'pic';
        $upload['case_pic'] = 'case_pic';
        foreach ($upload as $key => $v) {
            $upload_file = FUploader::saveFile($v, 'block');
            if ($upload_file) {
                $_POST[$v] = $upload_file;
            }
        }
        $_POST['status'] = '1';
        $_POST['case_url'] = sanitize_url($_POST['case_url']);
        $info = $category -> where("id=".$_POST['cat_id']) -> find();
        $_POST['parent_id'] = $info['parent_id'];
        if($article->insert($_POST)){
            $this->success('数据添加成功','javascript:history.back(-1);');
        }else{
            $this->error('数据添加失败！');
        }
    }


    public function editAction(){
        $t = M('article');
        $id = $_GET['id'];
        $info=$t->where('id='.$id)->find();
        $c = new FTable('category');
        $parent_id = $_GET['parent_id'];
        $list = $c -> where("parent_id=".$parent_id) -> select();
        $this->assign('style', $parent_id);
        $this -> assign("list",$list);
        $this->assign('info',$info);
        $this->display();
    }
    public function updateAction(){
        $upload_file = FUploader::saveFile('pic', 'block');
        $case_pic = FUploader::saveFile('case_pic', 'block');
        if ($upload_file) {
            $_POST['pic'] = $upload_file;
        }
        if ($case_pic) {
            $_POST['case_pic'] = $case_pic;
        }
        $id = $_POST['id'];
        $_POST['case_url'] = sanitize_url($_POST['case_url']);
        $t = new FTable('article');
        if($t->where("id=$id")->update($_POST)){
            $this->success('数据修改成功！','javascript:history.back(-1);');
        }else{
            $this->error('数据修改失败！','javascript:history.back(-1);');
        }
    }
    public function article_delAction() {
    $id = trim($_POST['a_id'], ',');
    $m = new FTable("article");
    if ($m->where("id in ($id)")->remove(true)) {
        echo 1;
    } else {
        echo 0;
    }
}

    public function article_throughAction() {
        $id = trim($_POST['a_id'], ',');
        $m = new FTable("article");
        $data['status'] = 1;
        if ($m->where("id in ($id)")->update($data)) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function delAction() {
        $id = trim($_POST['id'], ',');
        $m = new FTable("article");
        if ($m->where("id = $id")->remove(true)) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function auditAction() {
        $id = $_POST['id'];
        $m = new FTable("article");
        $data['status'] = 1;
        if ($m->where("id=$id")->update($data)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function audit1Action() {
        $id = $_POST['id'];
        $m = new FTable("member");
        $data['sign'] = 1;
        if ($m->where("m_id=$id")->update($data)) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function gerareaAction(){
        $parent_id = $_POST['parent_id'];
        $area = new FTable('area');
        $city = $area->where('parent_id='.$parent_id)->select();
        $data = json_encode($city);
        echo $data;
    }

    public function get_listAction(){
        $parent_id = $_POST['parent_id'];
        $area = new FTable('category');
        $city = $area->where('parent_id='.$parent_id)->select();
        $data = json_encode($city);
        echo $data;
    }
    public function get_list1Action(){
        $parent_id = $_POST['parent_id'];
        $area = new FTable('category');
        $city = $area->where('parent_id='.$parent_id)->select();
        $data = json_encode($city);
        echo $data;
    }






    public function readAction(){
        if($_GET['a_id']){
            $table = new FTable('article');
            $data = $table -> where('id='.$_GET['a_id']) -> find();
            $this->assign('data', $data);
            $this->display();
        }
    }

}