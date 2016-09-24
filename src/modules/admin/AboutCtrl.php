<?php

class AdminAboutCtrl extends AdminAbstractCtrl {
    public function company_profileAction() {
//        $this->openDebug();
        $aboutT = new FTable('about');
        $info = $aboutT->where("type=1")->find();
        $this->assign('info', $info);
        $this->display();
    }

    public function company_cultureAction() {
        $aboutT = new FTable('about');
        $info = $aboutT->where("type=3")->find();
        $this->assign('info', $info);
        $this->display();
    }

    public function company_honorAction() {
        $aboutT = new FTable('about');
        $info = $aboutT->where("type=2")->find();
        $this->assign('info', $info);
        $this->display();
    }


    public function company_structureAction() {
        $aboutT = new FTable('about');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $info = $aboutT->where("type=3 and language='" . $current_lang . "'")->find();

        $this->assign('info', $info);
        $this->display();
    }

    public function company_videoAction() {
        $aboutT = new FTable('about');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $info = $aboutT->where("type=4 and language='" . $current_lang . "'")->find();

        $this->assign('info', $info);
        $this->display();
    }


    public function company_qualificationAction() {
        $aboutT = new FTable('about');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $num = $_POST['num'] ? $_POST['num'] : 10;
        $this->assign('num', $num);
        $info = $aboutT->where("type=6 and language='" . $current_lang . "'")->page($_GET['page'])->limit($num)->select();

        $this->assign('info', $info);
        $this->assign('page_info', $aboutT->getPagerInfo());

        $this->display();
    }

    public function insAction() {
        $aboutT = new FTable('about');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $upload_file = FUploader::saveFile('up_pic', 'block');
        if ($upload_file) {
            $_POST['pic'] = $upload_file;
        }
        $data = array(
            'summary' => $_POST['content'],
            'type' => $_POST['type'],
            'language' => $current_lang,
            'status' => 1,
            'create_time' => date("Y-m-d H:i:s"),
            'pic' => $_POST['pic'],
            'url' => $_POST['url'],
            'title' => $_POST['title'],
        );

        $info = $aboutT->where('type=' . $_POST['type'] . " and language='" . $current_lang . "'")->find();
        if ($info) {
            if ($aboutT->where('type=' . $_POST['type'] . " and language='" . $current_lang . "'")->update($data)) {
                $this->success('数据修改成功', 'javascript:history.back(-1);');
            } else {
                $this->error('数据修改失败！');
            }
        } else {
            if ($aboutT->insert($data)) {
                $this->success('数据添加成功', 'javascript:history.back(-1);');
            } else {
                $this->error('数据添加失败！');
            }
        }
    }


    public function addAction() {
        $aboutT = new FTable('about');
        $current_lang = FSession::get("lang");
        if (!$current_lang) $current_lang = "zh_CN";
        $upload_file = FUploader::saveFile('up_pic', 'block');
        if ($upload_file) {
            $_POST['pic'] = $upload_file;
        }
        $data = array(
            'summary' => $_POST['content'],
            'type' => $_POST['type'],
            'language' => $current_lang,
            'status' => 1,
            'create_time' => date("Y-m-d H:i:s"),
            'pic' => $_POST['pic'],
            'url' => $_POST['url'],
        );
        if ($_POST['id']) {
            $info = $aboutT->where('type=' . $_POST['type'] . ' and id=' . $_POST['id'])->find();
        } else {
            $info = '';
        }
        if ($info) {
            if ($aboutT->where('type=' . $_POST['type'] . " and id=" . $_POST['id'])->update($data)) {
                $this->success('数据修改成功', 'javascript:history.back(-1);');
            } else {
                $this->error('数据修改失败！');
            }
        } else {
            if ($aboutT->insert($data)) {
                $this->success('数据添加成功', 'javascript:history.back(-1);');
            } else {
                $this->error('数据添加失败！');
            }
        }
    }


    public function delAction() {
        $id = trim($_POST['id'], ',');
        $m = new FTable("about");
        if ($m->where("id in ($id)")->remove(true)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function company_honor_addAction() {
        $id = $_GET['id'];
        if ($id) {
            $aboutT = new FTable('about');
            $info = $aboutT->where("id=" . $id)->find();
            $this->assign('info', $info);
        }
        $this->display();
    }

    public function company_qualification_addAction() {
        $id = $_GET['id'];
        if ($id) {
            $aboutT = new FTable('about');
            $info = $aboutT->where("id=" . $id)->find();
            $this->assign('info', $info);
        }
        $this->display();
    }
}