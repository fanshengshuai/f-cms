<?php

class AdminSyssettingCtrl extends AdminAbstractCtrl {

    public function editAction() {
        $default_settings = FConfig::get('global.setting_map');

        if (IS_POST) {
            $t = new FTable('setting');
            $data = array();
            foreach ($default_settings as $item) {
                $name = $item['name'];
                if (isset($_POST[$name]) && $_POST[$name] != '') {
                    if ($t->where(array('setting_key' => $name))->find()) {
                        $t->where(array('setting_key' => $name))->update(array('setting_value' => $_POST[$name]));
                    } else {
                        $t->insert(array('setting_key' => $name, 'setting_value' => $_POST[$name]));
                    }
                }
            }

            FSetting::updateSystemCache();
            $this->success('提交成功');
            exit;
        }
        $this->assign('setting', $default_settings);
        $this->display();
    }
}