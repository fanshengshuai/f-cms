<?php

class AdminAbstractCtrl extends FController {
    public function beforeAction() {
        global $_F;

        $manager_uid = FSession::get('manager_uid');
        if (!$manager_uid && $_F['controller'] != 'Controller_Admin_Public') {
            FResponse::redirect('/admin/public/login');
        }

        $plugin_file = F_APP_ROOT . "plugin/plugin.func.php";
        if (file_exists($plugin_file)) {
            include_once $plugin_file;
        }

        return true;
    }
}