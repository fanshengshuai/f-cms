<?php

class NewsPlugin {
    public $modelData;

    function init($modelData) {
        $this->modelData = $modelData;
    }

    function admin_content_form_after() {
        echo <<<EOF
        阿斯顿发生的发烧豆腐
EOF;
    }
}