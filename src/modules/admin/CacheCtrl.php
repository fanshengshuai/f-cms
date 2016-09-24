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

//        $_F['debug'] = 1;
        FCache::flush();

        FSetting::updateSystemCache();

        $this->success('缓存已经清空。');

    }
}