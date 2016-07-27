<?php

class FrontPublicCtrl extends FController {
    public function changePerPageAction() {
        global $_F;

        $page = intval($_GET['perPage']);
        FSession::set("perPage", $page);

        FResponse::output(array('result' => 'ok'));
    }
}