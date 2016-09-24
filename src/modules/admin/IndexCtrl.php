<?php

class AdminIndexCtrl extends AdminAbstractCtrl {
    public function indexAction() {
        $this->assign('admin', FSession::get('admin'));
        $this->display();
    }

    public function article_list() {
        $this->display();
    }
}