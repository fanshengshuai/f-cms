<?php

class Service_Setting {
    const PAY_PLATFORM_TENPAY = 1;
    const PAY_PLATFORM_CHINABANK = 2;
    const PAY_PLATFORM_UPMP = 3;

    const PAY_TYPE_CHARGE = 1;
    const PAY_TYPE_BUY_GOODS = 2;

    const PAY_QUERY_RESULT_SUCCESS = 1;
    const PAY_QUERY_RESULT_GOING = 2;
    const PAY_QUERY_RESULT_FAILED = 3;

    public static function get($keys) {

        $retData = null;

        if (is_string($keys)) {
            return self::_getSingle($keys);
        }

        $conditions = array();
        foreach ($keys as $key) {
            $conditions[] = "'{$key}'";
        }
        $condition_str = join(' , ', $conditions);

        $cacheKey = 'setting-cache-' . $condition_str;
        $cacheContent = FCache::get($cacheKey);
        if ($cacheContent) {
            return $cacheContent;
        }

        $settingDAO = new FTable('setting');
        $settings_data = $settingDAO->where(array('setting_name' => array("in" => $condition_str)))->select();

        if ($settings_data) {
            foreach ($settings_data as $item) {
                $retData[$item['setting_name']] = $item['setting_value'];
            }
        }

        FCache::set($cacheKey, $retData, 7200000);
        return $retData;
    }

    public static function _getSingle($key) {

        $cacheKey = 'setting-cache-s-' . $key;
        $cacheContent = FCache::get($cacheKey);
        if ($cacheContent) {
            return $cacheContent;
        }

        $settingDAO = new FTable('setting');
        $setting = $settingDAO->where(array("setting_name" => $key))->find();

        if ($setting) {
   //         $value = json_decode($setting['setting_value'], true);
            FCache::set($cacheKey, $setting['setting_value'], 7200000);
            return $setting['setting_value'];
        } else {
            return false;
        }
    }

    public static function set($key, $value) {

        $settingDAO = new FTable('setting');
        $setting = $settingDAO->where(array("k" => $key))->find();

        $value = json_encode($value);

        if ($setting) {
            $settingDAO->where(array('k' => $key))->update(array('v' => $value));
        } else {
            $settingDAO->insert(array(
                'k' => $key,
                'v' => $value
            ));
        }

        return true;
    }
}
