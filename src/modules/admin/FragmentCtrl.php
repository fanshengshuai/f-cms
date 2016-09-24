<?php

class AdminFragmentCtrl extends AdminAbstractCtrl {
    public function indexAction() {
        $t = new FTable('fragment');

        $list = $t->page(intval($_GET['page']))->limit(30)->order('id desc')->select();
        $page_info = $t->getPagerInfo();
        $this->assign('page_info', $page_info);
        $this->assign('list', $list);

        $this->display();
    }

    public function addAction() {

        if ($this->isPost()) {
            $data = array(
                'name' => trim($_POST['name']),
                'content' => trim($_POST['content']),
                'title' => trim($_POST['title']),
            );

            $t = new FTable('fragment');

            $id = FRequest::getPostInt('id');

            if ($id) {
                $t->where(array('id' => $id))->update($data);
                $msg = '已经更新';
            } else {

                if (!$data['title']) {
                    $data['title'] = time();
                }
                $t->insert($data);
                $msg = '添加成功';
            }

            $this->success($msg, '/admin/fragment/index');
        }

        $id = FRequest::getInt('id');
        if ($id) {
            $t = new FTable('fragment');
            $info = $t->find($id);
            $this->assign('info', $info);
        }

        $this->display();
    }

    public function delAction() {
        $id = FRequest::getInt('id');
        $t = new FTable('fragment');

        $t->where(array('id' => $id))->remove(true);
        FResponse::output(array('result' => 1));
    }


    //杂项批量删除

    public function fragment_delAction() {

        $id = trim($_POST['id'], ',');
        $m = new FTable("fragment");
        if ($m->where("id in ($id)")->remove(true)) {
            echo 1;
        } else {
            echo 0;
        }

    }


}
