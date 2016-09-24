<?php

//产品管理
class AdminProductCtrl extends AdminAbstractCtrl {
    public function listAction() {
        $productT = new FTable('product');
        $categoryT = new FTable('category');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num', $num);
        $productList = $productT->where("language='" . $current_lang . "'")->page($_GET['page'])->limit($num)->select();
        foreach ($productList as $key => $v) {
            $category_info = $categoryT->where('id=' . $v['category'])->find();
            $productList[$key]['category_name'] = $category_info['name'];
        }
        $this->assign('productList', $productList);
        $this->assign('page_info', $productT->getPagerInfo());

        $this->display();
    }

    public function addAction() {
        $categoryT = new FTable('category');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $categoryList = $categoryT->where("language='" . $current_lang . "'")->select();
        $this->assign('categoryList', $categoryList);
        $this->display();
    }

    public function editAction() {
        $productT = new FTable('product');
        $categoryT = new FTable('category');

        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $id = $_GET['id'];
        $info = $productT->where('id=' . $id)->find();
        $this->assign('info', $info);

        $categoryList = $categoryT->where("language='" . $current_lang . "'")->select();
        $this->assign('categoryList', $categoryList);
        $this->display();
    }

    public function insAction() {
        $productT = new FTable('product');
        $upload_file = FUploader::saveFile('up_pic', 'block');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        if ($upload_file) {
            $_POST['pic'] = $upload_file;
        }
        $data = array(
            'title' => $_POST['title'],
            'pic' => $_POST['pic'],
            'summary' => $_POST['content'],
            'create_time' => date('Y-m-d H:i:s'),
            'language' => $current_lang,
            'category' => $_POST['category']
        );
        if ($productT->insert($data)) {
            $this->success('数据添加成功', 'javascript:history.back(-1);');
        } else {
            $this->error('数据添加失败！');
        }
    }

    public function updataAction() {
        $productT = new FTable('product');
        $upload_file = FUploader::saveFile('up_pic', 'block');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        if ($upload_file) {
            $_POST['pic'] = $upload_file;
        }
        $id = $_POST['id'];
        $data = array(
            'title' => $_POST['title'],
            'pic' => $_POST['pic'],
            'summary' => $_POST['content'],
            'create_time' => date('Y-m-d H:i:s'),
            'language' => $current_lang,
            'category' => $_POST['category']
        );
        if ($id) {
            if ($productT->where('id=' . $id)->update($data)) {
                $this->success('数据修改成功', 'javascript:history.back(-1);');
            } else {
                $this->error('数据修改失败！');
            }
        } else {
            $this->error('数据修改失败！');
        }

    }


    public function delAction() {
        $id = trim($_POST['id'], ',');
        $m = new FTable("product");
        if ($m->where("id in ($id)")->remove(true)) {
            echo 1;
        } else {
            echo 0;
        }
    }


    public function categoryAction() {

        $cats = array();
        $t = new FTable('category');
        $cats_0 = $t->where('parent_id=0')->order(array('id' => 'asc'))->select();

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
                'parent_id' => $parent_id
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
        $cats_0 = $t->where('parent_id=0')->order(array('id' => 'asc'))->select();
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
}