<?php

class AdminArticleCtrl extends  AdminAbstractCtrl {
    public function indexAction () {

        $articleT = new FTable('article');
        $info = $articleT -> where("type=1") -> find();
        $this->assign('info', $info);
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num',$num);
        $type = $_GET['type'];
        if($type){
            $info = $articleT->where('status=1 and type='.$type." and language='".$current_lang."'")->page($_GET['page'])->limit($num)->order(array('id' => 'desc'))->select();
            $this->assign('info', $info);
            $this->assign('type', $type);
            $this->assign('page_info', $articleT->getPagerInfo());
        }
        $this->display();
    }
    public function demandAction () {
        $t = new FTable('article');
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num',$num);
        $info = $t->where('type = 5 or type = 4')->page($_GET['page'])->limit($num)->order(array( 'id' => 'desc'))->select();
        $this->assign('info', $info);
        $this->assign('page_info', $t->getPagerInfo());
        $this->display();
    }
    public function declaractionAction(){
        $articleT = new FTable('article');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $info = $articleT -> where("type=7 and language='".$current_lang."'") -> find();
        $this -> assign('info',$info);
        $this -> display();
    }
    public function declaraction_addAction(){
        $articleT = new FTable('article');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $data = array(
            'content' => $_POST['content'],
            'type' => $_POST['type'],
            'language' => $current_lang,
            'status' => 1,
            'create_time' => date("Y-m-d H:i:s"),
        );

        $info = $articleT -> where('type='.$_POST['type']." and language='".$current_lang."'") -> find();
        if($info){
            if($articleT->where('type='.$_POST['type'])->update($data)){
                $this->success('数据修改成功','javascript:history.back(-1);');
            }else{
                $this->error('数据修改失败！');
            }
        }else{
            if($articleT->insert($data)){
                $this->success('数据添加成功','javascript:history.back(-1);');
            }else{
                $this->error('数据添加失败！');
            }
        }
    }
    public function show_listAction () {
        $t = new FTable('article');
        $type= $_GET['type'];
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num',$num);
        $info = $t->where('type = '.$type.'')->page($_GET['page'])->limit($num)->order(array( 'id' => 'desc'))->select();
        $this->assign('info', $info);
        $this->assign('type', $type);
        $this->assign('page_info', $t->getPagerInfo());
        $this->display();
    }
    public function show_list_addAction(){
        $type= $_GET['type'];
        $this->assign('type', $type);
        $this->display();
    }
    public function show_list_editAction(){
        $t = M('article');
        $id = $_GET['id'];
        $info=$t->where('id='.$id)->find();
        $this->assign('info',$info);
        $this->display();
    }
    public function jobAction () {
        $t = new FTable('article');
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num',$num);
        $info = $t->where('type = 7')->page($_GET['page'])->limit($num)->order(array( 'id' => 'desc'))->select();
        $this->assign('info', $info);
        $this->assign('page_info', $t->getPagerInfo());
        $this->display();
    }
    public function approveAction () {
        $t = new FTable('article');
        $cat = new FTable('category');
        $area = new FTable('area');

        $ca = $cat ->select();
        $key1 = $_POST['cat_id'];
        $key_2 = $_POST['title1'];
        $statu = $_POST['statu'];
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num',$num);
        $info = $t->where('status=0 and is_gz=1')->page($_GET['page'])->limit($num)->order(array('sort' => 'asc', 'id' => 'desc'))->select();

        //列表分类显示

        foreach($info as $key=>$v){
            if($v['province']){
                $province = $area ->where('id='.$v['province'])->find();
                $info[$key]['province']=$province['name'];

            }
            if($v['city']){
                $city = $area ->where('id='.$v['city'])->find();
                $info[$key]['city']=$city['name'];

            }
        }
        $this->assign('info', $info);
        $this->assign('page_info', $t->getPagerInfo());
        $this->display();
    }
    public function demand_approveAction () {
        $t = new FTable('article');
        $cat = new FTable('category');
        $area = new FTable('area');

        $ca = $cat ->select();
        $key1 = $_POST['cat_id'];
        $key_2 = $_POST['title1'];
        $statu = $_POST['statu'];
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num',$num);
        $info = $t->where('status=0 and is_gz=2')->page($_GET['page'])->limit($num)->order(array('sort' => 'asc', 'id' => 'desc'))->select();

        //列表分类显示

        foreach($info as $key=>$v){
            $province = $area ->where('id='.$v['province'])->find();
            $city = $area ->where('id='.$v['city'])->find();
            $info[$key]['province']=$province['name'];
            $info[$key]['city']=$city['name'];
        }
        //查询处列出分类
//        $cats = array();
//        $cats_0 = $cat->where('parent_id=0')->select();
//        foreach ($cats_0 as $key => $item) {
//            $cats_1 = null;
//            $item['class'] = 0;
//            $cats[] = $item;
//
//            $cats_1 = $cat->where('parent_id=' . $item['id'])->select();
//            foreach ($cats_1 as $key1 => $item1) {
//                $cats_2 = null;
//                $item1['class'] = 1;
//
//                $cats_2 = $cat->where('parent_id=' . $item1['id'])->select();
//                if($cats_2){
//                    $item1['child'] = 1;
//                }
//                $cats[] = $item1;
//                foreach ($cats_2 as $key2 => $item2) {
//                    $cats_2 = null;
//                    $item2['class'] = 2;
//                    $cats[] = $item2;
//                }
//            }
//        }
//        $this->assign('cats', $cats);
        $this->assign('info', $info);
        $this->assign('page_info', $t->getPagerInfo());
        $this->display();
    }
    public function article_addAction(){
        $type= $_GET['type'];
        $this -> assign('type',$type);
        $this->display();
    }



    public function news_insAction(){
        $articleT = new FTable('article');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $upload_file = FUploader::saveFile('up_pic', 'block');
        if ($upload_file) {
            $_POST['pic'] = $upload_file;
        }
        $data = array(
            'content' => $_POST['content'],
            'type' => $_POST['type'],
            'language' => $current_lang,
            'status' => 1,
            'create_time' => date("Y-m-d H:i:s"),
            'pic' => $_POST['pic'],
            'author' => $_POST['author'],
            'comefrom' => $_POST['comefrom'],
            'title' => $_POST['title'],
        );
            if($articleT->insert($data)){
                $this->success('数据添加成功','javascript:history.back(-1);');
            }else{
                $this->error('数据添加失败！');
            }
    }



    public function demand_article_addAction(){
        $this->display();
    }
    public function job_addAction(){
        $this->display();
    }

    public function insAction(){
        $article = new FTable('article');
        $area = new FTable('area');
        $upload['pic'] = 'pic';
        $upload['plugs1'] = 'plugs1';
        $upload['plugs2'] = 'plugs2';
        $upload['plugs3'] = 'plugs3';
        foreach ($upload as $key => $v) {
            $upload_file = FUploader::saveFile($v, 'block');
            if ($upload_file) {
                $_POST[$v] = $upload_file;
            }
        }
        $t = new FTable('category');
        //后台添加文章不需要审核，直接通过
        $_POST['audit'] = 1;
        $_POST['is_gz'] = 1;
        //查询录入文章所属分类的父ID的父级ID
        $_POST['author_id'] = '1';
        $_POST['status'] = '1';

        if($article->insert($_POST)){
            $this->success('数据添加成功','javascript:history.back(-1);');
        }else{
            $this->error('数据添加失败！');
        }
    }
    public function demand_insAction(){
        $article = new FTable('article');
        $upload_file = FUploader::saveFile('up_pic', 'block');
        if ($upload_file) {
            $_POST['pic'] = $upload_file;
            unset($_POST['up_pic']);
        }
        if($article->insert($_POST)){
            $this->success('数据添加成功','javascript:history.back(-1);');
        }else{
            $this->error('数据添加失败！');
        }
    }

    public function downAction(){
        if($_GET['a_id']){
            $table = new FTable('article');
            $data = $table -> where('id='.$_GET['a_id']) -> find();
            $this->assign('data', $data);
            $this->display();
        }
    }

    public function editAction(){
        $t = M('article');
        $id = $_GET['id'];
        $info=$t->where('id='.$id)->find();
        $this->assign('info',$info);
        $this->display();
    }
    public function demand_editAction(){
        $t = M('article');
        $id = $_GET['id'];
        $info=$t->where('id='.$id)->find();
        $this->assign('info',$info);
        $this->display();
    }
    public function job_editAction(){
        $t = M('article');
        $id = $_GET['id'];
        $info=$t->where('id='.$id)->find();
        $this->assign('info',$info);
        $this->display();
    }

    public function updateAction(){
        $upload_file = FUploader::saveFile('up_pic', 'block');
        if ($upload_file) {
            $_POST['pic'] = $upload_file;
            unset($_POST['up_pic']);
        }
        $id = $_POST['id'];
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



    public function technology_supplyAction () {
        $t = new FTable('article');
        if(isset($_POST['title']) && $_POST['title']!=''){
            $where['title'] = $_POST['title'];
        }
        if(isset($_POST['begin_time']) && isset($_POST['end_tme']) && $_POST['begin_time']!='' && $_POST['end_time']!=''){
            $begin = strtotime($_POST['begin_time']);
            $end = strtotime($_POST['end_time']);
            $where['create_time'] = array(array('gt',$begin),array('lt',$end));
        }
        $count = $t->where($where)->count();
        $num = $_POST['num'] ? $_POST['num'] : 3;
        $p = $_POST['p'] ? $_POST['p'] : 1;
        $s = ceil($count/$num);
        $page = new FPager($count,$num);

        $limit = $page->firstRow.','.$page->listRows;
        $show = $page->build();
        $info = $t->where($where)->order('id desc')->limit($limit)->select();

        $this->assign('info', $info);
        $this->assign('show', $show);
        $this->assign('count',$count);
        $this->assign('p', $p);
        $this->assign('s', $s);
        $this->display();
    }

    public function technology_supply_addAction(){
//        $info = M('category')->select();
//        foreach($info as $k=>$v){
//            if($v['parent_id'] == 0){
//                $arr[$v['id']] = $v;
//            }else if($v['parent_id'] != 0){
//                $arr[$v['parent_id']]['child'][] = $v;
//            }
//        }
//        echo '<pre>';
//        print_r($arr);exit;
//        $this->assign('arr', $arr);
        $cats = array();
        $t = new FTable('category');
        $cats_0 = $t->where('parent_id=0')->select();

        foreach ($cats_0 as $key => $item) {
            $cats_1 = null;
            $item['class'] = 0;
            $cats[] = $item;

            $cats_1 = $t->where('parent_id=' . $item['id'])->select();
            foreach ($cats_1 as $key1 => $item1) {
                $item1['class'] = 1;
                $cats[] = $item1;
            }

//            $cats[$key]['son'] = $tmp_cats;
        }


        $this->assign('cats', $cats);
        $this->display();
    }
    public function technology_supply_insAction(){
        $m = new FTable('article');
        if($m->insert($_POST)){
            $this->success('数据添加成功','/admin/Article/index');
        }else{
            $this->error('数据添加失败！');
        }
    }

    public function technology_supply_editAction(){
        $t = M('article');
        $id = $_GET['id'];
        $info=$t->where('id='.$id)->find();
        $this->assign('info',$info);
        $this->display();
    }
    public function technology_supply_updateAction(){
        $id = $_POST['id'];
        $t = new FTable('article');

        if($t->where("id=$id")->update($_POST)){
            $this->success('数据修改成功！','/admin/Article/index');
        }else{
            $this->error('数据修改失败！');
        }
    }
    public function technology_supply_delAction(){
        $id = $_POST['id'];
        $m = new FTable("article");
        if($m->where("id = $id")->remove(true)){
            echo 1;
        }else{
            echo 0;
        }

    }

}