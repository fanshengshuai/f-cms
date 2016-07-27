<?php

class Service_System {
    public static function log($log_type, $content, $manager_name = null) {
        $system_data = array(
            'log_type' => $log_type,
            'content' => $content,
            'ip' => FRequest::getClientIP(),
            'manager_name' => $manager_name ? $manager_name : FSession::get('manager_name'),
        );

        $t = new FTable('system_log');
        $t->insert($system_data);
    }
}