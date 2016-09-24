<?php

class AdminPublicCtrl extends FController {
    public function loginAction() {
        if (IS_POST) {
            $m = new FTable("admin");
            //获取验证码、用户名和密码
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            if ($res = $m->where("username = '$username' and password = '$password'")->find()) {
                FSession::set('manager_uid', $res['a_id']);
                FSession::set('manager_name', $res['username']);
                $arr['status'] = 'y';
                $arr['info'] = '登录成功';
                Service_System::log(1, '登录成功', $username);
            } else {
                $arr['status'] = 'n';
                $arr['info'] = '密码错误，请重新登录';

                Service_System::log(2, '登陆失败', $username);

            }
            FResponse::output($arr);
        }
        $this->display();
    }

    //生成验证码：
    public function captchaAction() {
        FCaptcha::genImg(100, 41, 4);
    }

    public function ckUserAction() {
        $name = $_POST['name'];
        $param = $_POST['param'];
        $m = new FTable("admin");
        if ($m->where("$name = '$param'")->find()) {
            $arr['status'] = 'y';
            $arr['info'] = '用户名存在，请输入密码';
        } else {
            $arr['status'] = 'n';
            $arr['info'] = '用户名不存在';
        }
        echo json_encode($arr);
    }

    /**
     * 检查验证码
     */
    public function ckCaptchaAction() {
        $param = $_POST['param'];
//        session_start();
//        var_dump($_SESSION);
        if (FCaptcha::checkCaptcha($param)) {
            $arr['status'] = 'y';
            $arr['info'] = '验证码正确';
        } else {
            $arr['status'] = 'n';
            $arr['info'] = '验证码错误，请重新输入';
        }
        echo json_encode($arr);
    }

    /**
     * 退出登陆
     */
    public function logoutAction() {
        FSession::set('manager_uid', 0);
        FSession::set('manager_name', null);

        FResponse::redirect('/');
    }

    /**
     * 切换用户
     */
    public function changeUserAction() {
        FSession::set('manager_uid', 0);
        FSession::set('manager_name', null);

        FResponse::redirect('/admin/public/login');
    }
}