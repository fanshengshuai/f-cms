<?php

/**
 *
 * 作者: 范圣帅(fanshengshuai@gmail.com)
 *
 * 创建: 2012-08-11 21:34:59
 * vim: set expandtab sw=4 ts=4 sts=4 *
 *
 * $Id: Global.php 1655 2015-09-22 10:26:07Z fanshengshuai $
 */
class AdminGlobalCtrl extends AdminAbstractCtrl {

    public function settingAction() {
        $t = new FTable('setting');
        if (IS_POST) {
            foreach ($_POST as $key => $item) {

                $t->where(array('setting_name' => $key))->update(array('setting_value' => $item));

            }

            FSetting::updateSystemCache();
            $this->success('提交成功', '/admin/global/setting');
            exit;
        }
        $setting = $t->order('sort asc')->select();

        $this->assign('setting', $setting);
        $this->display();
    }

    public function settingEditAction() {
        $a_id = $_GET['id'];
        $t = new FTable('setting');
        $item = $t->find($a_id);
        $this->assign('item', $item);
        $this->display();
    }

    public function updateAction() {
        $id = intval($_POST['id']);
        $t = new FTable('setting');
        if (IS_POST) {
            $data = array(
                'setting_name' => $_POST['setting_name'],
                'sort' => $_POST['sort'],
                'setting_type' => $_POST['setting_type'],
                'setting_title' => $_POST['setting_title'],
                'setting_summary' => $_POST['setting_summary'],
            );
            if ($id) {
                $t->where("id=$id")->update($data);
            }

            $this->success('更新成功，请继续设置', '/admin/global/setting');
        }
    }

    public function settingAddAction() {

        if ($this->isPost()) {
            $data = array(
                'setting_name' => $_POST['setting_name'],
                'sort' => $_POST['sort'],
                'setting_type' => $_POST['setting_type'],
                'setting_title' => $_POST['setting_title'],
                'setting_summary' => $_POST['setting_summary'],
            );

            FDB::insert('setting', $data);

            $this->success('添加成功，请继续设置', '/admin/global/setting');
        }

        $this->display();
    }

    public function settingDelAction() {
        $id = FRequest::getInt('id');
        $t = new FTable('setting');
        if ($t->where("id=" . $id)->remove(true)) {
            FResponse::output(array('result' => 1));
        }
    }

    public function passwdAction() {
        global $_F;

        $school_id = $_F['auth_info']['school_id'];

        if ($this->isPost()) {
            $new_passwd = trim($_POST['new_passwd']);
            //var_dump($new_passwd);exit;
            $schoolDAO = new DAO_School;
            $schoolDAO->update($school_id, array('password' => md5($new_passwd)));
            $this->success('密码已经修改，请牢记');
        }

        $this->display('admin/global/passwd');
    }

    public function agreementAction() {
        $setting_keys = array('agreement');

        if ($this->isPost()) {

            foreach ($setting_keys as $item) {
                Service_Setting::set($item, trim($_POST[$item]));
            }

            return $this->success('已经保存');
        }

        $settings = Service_Setting::get($setting_keys);
        $this->assign('settings', $settings);
        $this->display('global/agreement');
    }


}
