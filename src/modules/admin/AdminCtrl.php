<?php

class AdminAdminCtrl extends AdminAbstractCtrl {
    public function indexAction() {
        if ($_POST) {
            $datemin = strtotime($_POST['datemin']);
            $datemax = strtotime($_POST['datemax'] . " 23:59:59");
            $username = $_POST['username'];
            $this->assign('username', $username);
            $this->assign('datemin', $_POST['datemin']);
            $this->assign('datemax', $_POST['datemax']);
            if ($username) {
                $user = "username like '%$username%' ";
                if ($_POST['datemax']) {
                    $max = " and rtime < $datemax";
                }
                if ($_POST['datemin']) {
                    $min = " and rtime > $datemin";
                }
            } else {
                if ($_POST['datemax']) {
                    $max = "  rtime < $datemax";
                    if ($_POST['datemin']) {
                        $min = " and rtime > $datemin";
                    }
                } else {
                    if ($_POST['datemin']) {
                        $min = " rtime > $datemin";
                    }
                }
            }
        }
        $m = new FTable("admin");
        $ainfo = $m->where($user . $max . $min)->select();
        $count = $m->where($user . $max . $min)->count();
        $this->assign('ainfo', $ainfo);
        $this->assign('count', $count);
        $this->display('admin/admin/index');
    }

    public function admin_startAction() {
        $a_id = $_POST['a_id'];
        $m = new FTable("admin");
        if ($m->where("a_id = $a_id")->update(array('status' => 1))) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function admin_stopAction() {
        $a_id = $_POST['a_id'];
        $m = new FTable("admin");
        if ($m->where("a_id = $a_id")->update(array('status' => 0))) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function admin_delAction() {
        $a_id = trim($_POST['a_id'], ',');
        $m = new FTable("admin");
        if ($m->where("a_id in ($a_id)")->remove(true)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function addAction() {
        $this->display('/admin/admin/add');
    }

    public function addcheckAction() {
        $name = $_POST['name'];
        $param = $_POST['param'];
        $m = new FTable("admin");
        if ($m->where("$name = '$param'")->find()) {
            $arr['status'] = 'n';
            $arr['info'] = '用户名已经被注册，请重新输入';
        } else {
            $arr['status'] = 'y';
            $arr['info'] = '用户名未被注册，可以使用';
        }
        echo json_encode($arr);
    }

    public function insertAction() {
        $m = new FTable("admin");
        $_POST['create_time'] = time();
        $_POST['username'] = trim($_POST['username']);
        $_POST['password'] = md5(trim($_POST['password']));
        if ($m->insert($_POST)) {
            $arr['status'] = 'y';
            $arr['info'] = '添加成功';
        } else {
            $arr['status'] = 'n';
            $arr['info'] = '添加失败';
        }
        echo json_encode($arr);
    }

    public function editAction() {
        $a_id = $_GET['a_id'];
        $m = new FTable("admin");
        $adinfo = $m->find($a_id);
        $this->assign('adinfo', $adinfo);
        $this->display('admin/admin/edit');
    }

    public function updateAction() {
        $a_id = $_POST['a_id'];
        $m = new FTable("admin");
        if (!empty($_POST['password'])) {
            $_POST['password'] = md5(trim($_POST['password']));
        } else {
            unset($_POST['password']);
        }

        if ($m->where("a_id = $a_id")->update($_POST)) {
            $arr['status'] = 'y';
            $arr['info'] = '更新成功';
        } else {
            $arr['status'] = 'n';
            $arr['info'] = '更新失败';
        }
        echo json_encode($arr);
    }

    public function permissionAction() {
        $this->display('admin/admin/permission');
    }

    public function roleAction() {
        $this->display('admin/admin/role');
    }

    public function roleAddAction() {
        $this->display('admin/admin/roleAdd');
    }


}