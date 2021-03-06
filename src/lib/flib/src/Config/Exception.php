<?php

/**
 *
 *      作者: 范圣帅(fanshengshuai@gmail.com)
 *  创建时间: 2012-02-12 23:47:27
 *
 *  $Id: Exception.php 764 2015-04-14 15:09:06Z fanshengshuai $
 */
class Config_Exception extends Exception {

    public function __construct($message, $code = 0) {
        if (is_a($message, 'Exception')) {
            parent::__construct($message->getMessage(), intval($message->getCode()));
        } else {
            parent::__construct($message, intval($code));
        }
    }

}
