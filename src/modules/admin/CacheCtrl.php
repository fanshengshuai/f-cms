<?php

/**
 *
 * 作者: 范圣帅(fanshengshuai@gmail.com)
 *
 * 创建: 2012-08-05 16:16:30
 * vim: set expandtab sw=4 ts=4 sts=4 *
 *
 * $Id: Cache.php 1482 2015-09-15 09:06:32Z fanshengshuai $
 */
class AdminCacheCtrl extends AdminAbstractCtrl {

    public function clearAction() {

        global $_F;

//        $_F['debug']=1;

        FCache::flush();

        FSetting::updateSystemCache();


        $cache_dir = WEB_ROOT_DIR . "data/template_c";
//        FFile::rmDir(WEB_ROOT_DIR . "data");

        if (is_dir($cache_dir)) {
            $cache_dir_new = $cache_dir . '.bak_' . $_F['http_host'] . '_' . date('Y-m-d_H_i_s') . rand(1000, 9999);
            rename($cache_dir, $cache_dir_new);
//            chmod($cache_dir_new, 0777, 1);
            set_time_limit(0);
            FFile::rmDir($cache_dir_new . '/');
        }

//        FFile::rmDir();

        $this->success('缓存已经清空。');

    }
}