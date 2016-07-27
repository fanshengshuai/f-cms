<?php

class FrontIndexCtrl extends FController {
    public function indexAction() {
        $qq = Service_Setting::get(array('qq1', 'qq2', 'qq3', 'qq4'));
        $this->assign('qq', $qq);
        $this->display();
    }
}