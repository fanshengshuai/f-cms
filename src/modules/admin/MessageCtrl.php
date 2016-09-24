<?php

class AdminMessageCtrl extends  AdminAbstractCtrl {
    public function indexAction(){
        if($_REQUEST['title']){
            $title = $_REQUEST['title'];
            $this->assign('title',$title);
            $where['title'] = array('like'=>$title);
        }

        $m = new FTable("message");
        $info = $m->where($where)->page($_GET['page'])->limit(10)->order("create_time desc")->select();
        $mem = new FTable("member");
        $minfo = $mem->select();
        foreach($info as $k=>$v){
            if($v['m_id'] == 0){
                $info[$k]['username'] = '所有人';
            }
            foreach($minfo as $km=>$vm){
                if($vm['m_id'] == $v['m_id']){
                    $info[$k]['username'] = $vm['username'];
                }
            }
        }
        $this->assign('page_info', $m->getPagerInfo());
        $this->assign('info',$info);
        $this->display();
    }
    public function addAction(){
        if($_POST['username']){
            $username = $_POST['username'];
            $m = new FTable("member");
            $where['username'] = array('like'=>$username);
            $info = $m->where($where)->order("m_id asc")->select();
            $this->assign('user_info',$info);
            $this->assign('username',$username);
        }
        if($_GET['feedback']){
            $feedback = $_GET['feedback'];
            $feedname = $_GET['feedname'];
            $this->assign('feedback',$feedback);
            $this->assign('feedname',$feedname);
        }
        $this->display();
    }
    public function insertAction(){
        $m = new FTable("message");
        if(!$_POST['title'] || !$_POST['content']){
            $this->error('标题和内容不能为空','/admin/Message/index');
        }
        $arr['title'] = $_POST['title'];
        $arr['content'] = $_POST['content'];
        $arr['status'] = 0;
        if($_POST['message_accept'] == 0){
            $arr['m_id'] = 0;
            $m->insert($arr);
            $this->success('站内信添加成功','/admin/Message/index');
        }elseif($_POST['message_accept'] == 1){
            $arr['m_id'] = $_POST['m_id'];
            $m->insert($arr);
            $this->success('站内信添加成功','/admin/Message/index');
        }elseif($_POST['message_accept'] == 2 || $_POST['message_accept'] == 3 || $_POST['message_accept'] == 4 || $_POST['message_accept'] == 5 || $_POST['message_accept'] == 6){
            $mem = new FTable('member');
            $gid = $_POST['message_accept'];
            $info = $mem->where("gid = $gid")->select();
            foreach($info as $k=>$v){
                $arr['m_id'] = $v['m_id'];
                $m->insert($arr);
            }
            $this->success('站内信添加成功','/admin/Message/index');
        }elseif($_POST['feedback']){
            $arr['m_id'] = $_POST['feedback'];
            $m->insert($arr);
            $this->success('反馈回复成功','/admin/Message/index');
        }
    }
    public function editAction(){
        $id = $_REQUEST['id'];
        $m = new FTable("message");
        $info = $m->find($id);
        $this->assign('info',$info);
        $this->display();
    }
    public function updateAction(){
        $id = $_REQUEST['id'];
        $m = new FTable("message");
        $_POST['status'] = 0;
        if($m->where("id = $id")->update($_POST)){
            $this->success('站内信修改成功','/admin/Message/index');
        }else{
            $this->error('站内信修改失败','/admin/Message/index');
        }
    }

    public function message_delAction(){
        $id = $_REQUEST['id'];
        $m = new FTable("message");
        if($m->where("id = $id")->remove(true)){
            echo 1;
        }else{
            echo 0;
        }
    }
}