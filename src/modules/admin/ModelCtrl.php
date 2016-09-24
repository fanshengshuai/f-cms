<?php

class AdminModelCtrl extends AdminAbstractCtrl {
    // 模块列表
    public function indexAction() {

        $cats = array();
        $t = new FTable('model');
        $cats_0 = $t->order("sort asc")->select();
        $this->assign('cats', $cats_0);
        $this->display();
    }

    public function addAction() {
        $t = new FTable('model');



        if (IS_POST) {
            $data['model_name'] = $_POST['model_name'];
            $data['table_name'] = $_POST['table_name'];
            $data['model_addon'] = $_POST['model_addon'];

            $data['readonly'] = $_POST['readonly'];
            $data['has_cate']=$_POST['has_cate'];

            $table_fields = array(


                'title' => array('title', 'varchar(255)', '标题', 0, 1,0,0,0),
                'cate_id' => array('cate_id', 'int(11)', '分类ID', 0, 0,0,0,0),
                'lang' => array('lang', 'varchar(20)', '语言', 0, 0,0,0,0),
                'pic' => array('pic', 'varchar(255)', '图片', 0, 0,0,0,0),
                'content' => array('content', 'text', '内容', 0, 1,0,0,0),
                'create_time' => array('create_time', 'datetime', '记录创建时间', 0, 1,0,0,0),
                'update_time' => array('update_time', 'datetime', '记录更新时间', 0, 0,0,0,0),
                'remote_time' => array('remote_time', 'datetime', '记录删除时间', 0, 0,0,0,0),
                'status' => array('status', 'int(1)', '记录状态', 0, 0,0,0,0),


            );




            $table_fields_text = '';
            foreach ($table_fields as $f) {
                $table_fields_text .= "`{$f[0]}` {$f[1]} COMMENT '{$f[2]}',";
            }

            $sql = "CREATE TABLE xy_" . $data['table_name'] . "(
                `id` int(11) primary key auto_increment,
                $table_fields_text
                INDEX `id` USING BTREE (`id`) ,
                INDEX `status` USING BTREE (`status`) ,
                INDEX `lang` USING BTREE (`lang`)
                )ENGINE=MyISAM DEFAULT CHARACTER SET=utf8";

//            echo $sql;exit;
            FDB::query($sql);
            if ($data['model_addon']) {
                $sql2 = "CREATE TABLE xy_" . $data['model_addon'] . "(id int(11) primary key auto_increment,title varchar(255),content varchar(255),create_time datetime)";
                $res2 = FDB::query($sql2);
//                if (!$res2) {
//                    die('添加副表失败');
//                }
            }
//            if (!$res) {
//                die('添加主表失败');
//            }

            unset($table_fields['lang']);
            unset($table_fields['cate_id']);
            unset($table_fields['remote_time']);
            $data['summary'] = json_encode($table_fields);
            $data['status'] = '1';

            $new_table = $t->insert($data);

            if (!$new_table && $new_table != '0') {
                die('数据添加失败');
            }
            echo "<script>parent.location.reload();</script>";
            exit;
        }

        $cats = $t->select();
        $this->assign('cats', $cats);



        $this->display();
    }






    public function editAction() {
        $t = new FTable('model');
        $id = intval($_GET['id']);
        $cats = $t->where('id=' . $id)->find();
        $data['summary'] = json_decode($cats["summary"], true);
        $this->assign('data', $data['summary']);
        $this->assign('cats', $cats);
        $this->display();
    }

    public function addFieldAction() {




        $t = new FTable('model');
        $table = $t->where('id=' . $_GET['id'])->find();
        if (IS_POST) {
            $data['field_name'] = $_POST['field_name'];
            $data['field_type'] = $_POST['field_type'];
            $data['field_summary'] = $_POST['field_summary'];
            $sql = "ALTER TABLE xy_{$table['table_name']} ADD {$data['field_name']} {$data['field_type']}";

            FDB::query($sql);

            $data3 = json_decode($table['summary'], true);
            $type = $data['field_type'];
            $summary = $data['field_summary'];
            $name = $data['field_name'];
            $data3[$name] = array("$name", "$type", "$summary");
            $data1['summary'] = json_encode($data3);
            $new_table = $t->where('id=' . $_GET['id'])->update($data1);
            if (!$new_table) {
                die('数据保存失败');
            }
            echo "<script>parent.location.reload();</script>";
            exit;
        }
        $this->display();
    }

    public function editFieldAction() {
        $t = new FTable('model');
        $name = $_GET['name'];
        $table_name = $_GET['table_name'];
        $id = $_GET['id'];
        if (IS_POST) {
            $table_name = $_POST['table_name'];
            $id1 = $_POST['id'];
            $field_name = $_POST['field_name'];
            $field_name_old = $_POST['field_name_old'];
            $field_type = $_POST['field_type'];
            $field_type_old = $_POST['field_type_old'];
            $field_summary = $_POST['field_summary'];
            $sql1 = "ALTER TABLE xy_" . $table_name . " change " . $field_name_old . " " . $field_name . " " . $field_type . " not null";
            FDB::query($sql1);
            $cats = $t->where('id=' . $id1)->find();
            $data['summary'] = json_decode($cats['summary'], true);
            foreach ($data['summary'] as $key => $v) {
                if ($v['0'] == $field_name_old) {
                    $data['summary'][$key] = array("$field_name", "$field_type", "$field_summary", $data['summary'][$key][3], $data['summary'][$key][4]);
                }
            }
            $data1['summary'] = json_encode($data['summary'], true);
            $new_table = $t->where('id=' . $id1)->update($data1);
            if (!$new_table) {
                die('数据保存失败');
            }
            $this->success('修改成功', '/admin/model/edit?id=' . $id1);
        }
        $cats = $t->where('id=' . $id)->find();
        $data['summary'] = json_decode($cats['summary'], true);
        foreach ($data['summary'] as $key => $v) {
            if ($v['0'] == $name) {
                $table_field = $v;
            }
        }
        $this->assign('catData', $table_field);
        $this->assign('table_name', $table_name);
        $this->assign('id', $id);
        $this->display();

    }

    public function delAction() {
        $t = new FTable('model');
        $id = FRequest::getInt('id');
        $data = $t->where("id={$id}")->find();

        $articleT = new FTable($data['table_name']);

        $count = $articleT->count();

        if ($count > 0) {
            FResponse::output(array('result' => 2, 'msg' => '表中有数据无法删除'));
            exit;
        }

        $sql = "DROP TABLE xy_" . $data['table_name'];
        FDB::query($sql);
        $t->where("id={$id}")->remove(true);
        FResponse::output(array('result' => 1));
    }

    public function delFieldAction() {
        $t = new FTable('model');
        $id = FRequest::getInt('id');
        $data1['table_name'] = $_GET['table_name'];
        $name = $_GET['name'];
        $data = $t->where("id={$id}")->find();
        $sql = "ALTER TABLE xy_" . $data1['table_name'] . " DROP COLUMN " . $name;
        FDB::query($sql);
        $data1['summary'] = json_decode($data['summary'], true);
        foreach ($data1['summary'] as $key => $v) {
            if ($v['0'] == $name) {
                unset($data1['summary'][$key]);
            }
        }
        $data2['summary'] = json_encode($data1['summary']);
        $edit_table = $t->where('id=' . $id)->update($data2);
        if ($edit_table) {
            $this->success('删除成功', '/admin/model/edit?id=' . $id);
        } else {
            $this->error('删除失败', '/admin/model/edit?id=' . $id);
        }
    }

    public function change_has_cateAction() {
        $t = new FTable('model');
        $has_cate = $_POST['status'];
        $module_id = $_POST['module_id'];
        $aa = $t->where('id=' . $module_id)->update(array('has_cate' => $has_cate));
    }

    public function change_readonlyAction() {
        $t = new FTable('model');
        $readonly = $_POST['status'];
        $module_id = $_POST['module_id'];
        $aa = $t->where('id=' . $module_id)->update(array('readonly' => $readonly));
    }

    public function change_column_displayAction() {
        $t = new FTable('model');
        $column_display = $_POST['status'];
        $cat_name = $_POST['cat_name'];
        $module_id = $_POST['module_id'];
        $info = $t->where('id=' . $module_id)->find();
        $data = json_decode($info["summary"], true);
        foreach ($data as $key => $v) {
            if ($v['0'] == $cat_name) {
                $data[$key][4] = $column_display;
            }
        }
        $aa = $t->where('id=' . $module_id)->update(array('summary' => json_encode($data)));
    }

    public function change_report_formAction() {
        $t = new FTable('model');
        $column_display = $_POST['status'];
        $cat_name = $_POST['cat_name'];
        $module_id = $_POST['module_id'];
        $info = $t->where('id=' . $module_id)->find();
        $data = json_decode($info["summary"], true);
        foreach ($data as $key => $v) {
            if ($v['0'] == $cat_name) {
                $data[$key][3] = $column_display;
            }
        }
        $aa = $t->where('id=' . $module_id)->update(array('summary' => json_encode($data)));
    }

    //排序
    public function change_btnAction() {
        $t = new FTable('model');
        $sort=$_POST['sort'];
        $module_id = $_POST['module_id'];
        $aa = $t->where('id=' . $module_id)->update(array('sort' => $sort));
    }




    public function change_sortAction(){
        $id = intval($_POST['id']);
        $key_value = $_POST['key_value'];
        $sort = $_POST['sort'];
        if(!$sort){
            $sort = 0;
        }
        $newArray = array();
        $t = new FTable('model');
        $cats = $t->where('id=' . $id)->find();
        $data['summary'] = json_decode($cats["summary"], true);
        foreach($data['summary'] as $key => $v){
            if(!$data['summary'][$key][5]){
                $data['summary'][$key][5] = 0;
            }
            if($key == $key_value){
                $data['summary'][$key_value][5] = $sort;
            }
            $newArray[$key] = $data['summary'][$key][5];
        }
        asort($newArray);
        foreach($newArray as $key => $v){
            foreach($data['summary'] as $a => $b){
                if($a == $key){
                    $newArray[$key] = $b;
                }
            }
        }
        $array_data = json_encode($newArray);
        $aa = $t->where('id=' . $id) -> update(array('summary' => $array_data));
        if($aa){
            FResponse::output(array('result' => 1));
        }
    }

    public function change_typeAction(){
        $id = intval($_POST['id']);
        $key_value = $_POST['key_value'];
        $value = $_POST['value'];
        if(!$value){
            $value = 0;
        }
        $t = new FTable('model');
        $cats = $t->where('id=' . $id)->find();
        $data['summary'] = json_decode($cats["summary"], true);
        foreach($data['summary'] as $key => $v){
            if(!$data['summary'][$key][6]){
                $data['summary'][$key][6] = 0;
            }
            if($key == $key_value){
                $data['summary'][$key_value][6] = $value;
            }
        }
        $array_data = json_encode($data['summary']);
        $aa = $t->where('id=' . $id) -> update(array('summary' => $array_data));
        if($aa){
            FResponse::output(array('result' => 1));
        }
    }

    //系统更新项目排序
    public function setting_sortAction() {

        $t = new FTable('setting');
        $sort=$_POST['sort'];
        $module_id = intval($_POST['module_id']);
        $t->where('id=' . $module_id)->update(array('sort' => $sort));

        }


}