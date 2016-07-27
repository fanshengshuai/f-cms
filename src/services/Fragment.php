<?php

class Service_Fragment {
    public static function get($id) {
        $t = new FTable('fragment');
        $f_info = $t->find($id);

        return $f_info;
    }
    public static function getContentByName($name) {
        $t = new FTable('fragment');
        $f_info = $t->where(array('name' => $name))->find();

        return $f_info['content'];
    }
}
