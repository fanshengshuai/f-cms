<?php

class AdminFeedbackCtrl extends AdminAbstractCtrl {
    public function indexAction() {
        global $_F;

        $page = FRequest::getInt('page');

        $feedbackTable = new FTable('feedback');
        $feedbackList = $feedbackTable->where(array('status' => 1))->order(array('auto_id' => 'desc'))->page($page)->limit(50)->select();
        $this->assign('page_info', $feedbackTable->getPagerInfo());

        $this->assign('feedbackList', $feedbackList);
        $this->display('admin/feedback-index');
    }

    public function detailAction() {
        $auto_id = FRequest::getInt('auto_id');

        $feedbackTable = new FTable('feedback');
        $feedbackData = $feedbackTable->where(array('auto_id' => $auto_id))->find();

        $this->assign('feedbackData', $feedbackData);
        $this->display('admin/feedback-detail');
    }
}