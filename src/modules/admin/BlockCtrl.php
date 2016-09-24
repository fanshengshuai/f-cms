<?php

/**
 *  作者:范圣帅(fanshengshuai@gmail.com)
 *  创建时间:2011-03-12 05:29:52
 *  修改记录:
 *  $Id: Block.php 2487 2015-10-31 05:15:46Z wangtao $
 */
class AdminBlockCtrl extends AdminAbstractCtrl {

    public function addAction() {
        $data = array(
            'block_name' => '新增加的模块',
            'page' => 1,
            'status' => 1,
        );
        FDB::insert('block', $data);
    }

    public function listAction() {
        $block_list = array();
        $_block_list = FDB::fetch("SELECT * FROM xy_block b WHERE  status=1 ");

        foreach ($_block_list as $v) {
            $block_list [$v ['area']] [] = $v;
        }
        $this->assign('block_list', $block_list);
        $this->display();
    }

    public function editAction() {
        global $_F;
        $bid = intval($_REQUEST ['bid']);

        if ($_POST) {
            $_POST ['show_num'] = intval($_POST ['show_num']);
            $_POST ['show_num'] = $_POST ['show_num'] > 0 ? $_POST ['show_num'] : 10;
            $_POST ['parameter'] ['items'] = $_POST ['show_num'];
            $set_array = array(
                'block_name' => $_POST ['block_name'],
                'block_title' => $_POST ['block_title'],
                'show_num' => $_POST ['show_num'],
                'pic_width' => $_POST ['pic_width'],
                'pic_height' => $_POST ['pic_height'],
                'page' => intval($_POST ['page']),
                'tpl' => stripcslashes($_POST ['tpl']),
                'area' => $_POST ['area'],
                'block_type' => intval($_POST ['block_type'])
            );
            if ($bid) {
                FDB::update('block', $set_array, array('bid' => $bid));

                if ($set_array['block_type'] == 1) {
                    $ad_block_cache_file = F_APP_ROOT . 'data/block_tpl/' . $bid . '.php';
                    FFile::unlink($ad_block_cache_file);
                }
                header('location: ' . $_SERVER ['HTTP_REFERER'] . '&success=1');
                exit ();
            } else {
                $bid = FDB::insert('block', $set_array, true);
            }

            FResponse::redirect('/admin/block/list');
//            $_F ['block'] [$bid] = FDB::fetchFirst("SELECT * FROM xy_block WHERE bid='$bid'");
        }

        if ($bid) {

            $this->assign('bid', $bid);
            $block = FDB::fetchFirst("SELECT b.* FROM xy_block b  WHERE b.bid='$bid' and status=1");

            $block_item_list = FDB::fetch("select * from xy_block_item where bid='{$bid}' and status=1 order by sort asc");
            $this->assign('block_item_list', $block_item_list);
            $this->assign('block_data', $block);
        }

        $this->display();
    }

    public function removeAction() {
        $bid = $_GET ['bid'];
        FDB::remove('block', "bid='{$bid}'");
        redirect($_SERVER ['HTTP_REFERER']);
    }

    /**
     * Block 项目修改
     */
    public function bItemEditAction() {
        $item_id = intval($_GET ['item_id']);
        $bid = intval($_REQUEST ['bid']);
        $block_info = array('bid' => $bid);
        $vid = intval($_REQUEST ['vid']);

        $area = new FTable('area');
        $table = new FTable('category');
        $list = $table -> where('parent_id=64') ->select();
//        $list = $table -> where('parent_id=25') ->select();
        $province1 = $area->where('parent_id=0')->select();
        if ($vid) {
//            $v_info = FDB::fetchFirst("select * from video where vid='{$vid}'");
//            //var_dump($v_info);
//            $block_info = array(
//                'bid' => $bid,
//                'title' => $v_info['title'],
//                'url' => getVideoInfoUrl($v_info),
//                'pic' => $v_info['thumb_pic'] ? $v_info['thumb_pic'] : $v_info['picurl'],
//                'summary' => $v_info['intro'],
//                'note' => $v_info['score'],
//            );
//            $this->assign('block_info', $block_info);
        } else {
            $this->assign('item_id', $item_id);
            if ($item_id) {
                $block_info = FDB::fetchFirst("select * from xy_block_item where item_id='{$item_id}'");
            }
        }

        if ($this->isPost()) {

            $upload_file = FUploader::saveFile('pic', 'block');
            $url = 'javascript:;';
            if ($_POST['url']) {
                $url = $_POST ['url'];
            }
            $pic = '';
            if ($upload_file) {
                $pic = $upload_file;
            }

            if (!$pic) {
                $data = array(
                    'bid' => $bid,
                    'url' => $url,
                    'type' =>$_POST['type'],
                    'datemin' =>$_POST['datemin'],
                    'datemax' =>$_POST['datemax'],
                    'province' =>$_POST['province'],
                    'city' =>$_POST['city'],
                    'title' => $_POST ['title'],
                    'summary' => $_POST ['summary'],
                    'note' => $_POST['note'],
                    'status' => 1,
//                'position' => $_POST['position']
                );
            }else{
            $data = array(
                'bid' => $bid,
                'url' => $url,
                'pic' => $pic,
                'type' =>$_POST['type'],
                'datemin' =>$_POST['datemin'],
                'datemax' =>$_POST['datemax'],
                'province' =>$_POST['province'],
                'city' =>$_POST['city'],
                'title' => $_POST ['title'],
                'summary' => $_POST ['summary'],
                'note' => $_POST['note'],
                'status' => 1,
            );

            }
            $table1 = new FTable('block_item');

            if ($item_id) {
                FDB::update("block_item", $data, "item_id='{$item_id}'");
            } else {
                $inset = $table1 -> insert($data);
//                FDB::insert("block_item", $data);
            }
            FResponse::redirect("/admin/block/edit?bid=" . $bid);
        }
        if($block_info['type']){
            $type = $table -> where('id='.$block_info['type']) -> find();
            $block_info['type_name'] = $type['name'];
        }
        if($block_info['province']){
            $province = $area -> where('id='.$block_info['province']) -> find();
            $block_info['province_name'] = $province['name'];
        }
        if($block_info['city']){
            $city = $area -> where('id='.$block_info['city']) -> find();
            $block_info['city_name'] = $city['name'];
        }

        $this->assign('block_info', $block_info);
        $this->assign('list', $list);
        $this->assign('province', $province1);
        $this->display();
    }

    public function bItemDeleteAction() {
        $item_id = $_GET ['item_id'];

        FDB::remove('block_item', "item_id='{$item_id}'");

        header("location: {$_SERVER['HTTP_REFERER']}");
    }


    /**
     * 更新显示顺序
     */
    public function updateSortAction() {
        $sorts = $_POST ['sort'];

        foreach ($sorts as $k => $v) {
            $data = array(
                'sort' => $v
            );

            FDB::update('block_item', $data, "item_id={$k}");
        }

        header('location: ' . $_SERVER ['HTTP_REFERER'] . '&success=1');
    }
}
