<?php

class AdminMemberCtrl extends  AdminAbstractCtrl {
    public function indexAction () {
        $m = new FTable("member");
        $ainfo = $m->order(array('m_id'=>'desc'))->select();
        $count = $m->count();
        foreach($ainfo as $key=>$v){
            $ainfo[$key]['key'] = $count-$key;
        }
        $count = $m->count();
        $this->assign('ainfo',$ainfo);
        $this->assign('count',$count);
        $this->display();
    }

    public function messageAction () {
        $num =  15;

        $m = new FTable("message");
        $member = new FTable("member");

        $ainfo = $m->where('type=1')->order(array('id'=>'desc'))->page($_GET['page'])->limit($num)->select();
        foreach($ainfo as $key=>$v){
            $user = $member -> where('m_id='.$v['sender']) -> find();
            $ainfo[$key]['sender_name'] = $user['username'];
            $ainfo[$key]['nick_name'] = $user['nickname'];
            $ainfo[$key]['email'] = $user['email'];
        }
        $count = $m->where('type=1')->count();
        $this->assign('page_info', $m->getPagerInfo());

        $this->assign('ainfo',$ainfo);
        $this->assign('count',$count);
        $this->display();
    }
    //会员添加
    public function addAction () {
        $this->display();
    }
    //验证用户名是否已经注册
    public function addcheckAction () {
        $name = $_POST['name'];
        $param = $_POST['param'];
        $m = new FTable("member");
        if($m->where("$name = '$param'")->find()){
            $arr['status'] = 'n';
            $arr['info'] = '用户名已经被注册，请重新输入';
        }else{
            $arr['status'] = 'y';
            $arr['info'] = '用户名未被注册，可以使用';
        }
        echo json_encode($arr);
    }
    public function insertAction () {
        $m = new FTable("member");
        $_POST['rtime'] = time();
        $_POST['username'] = trim($_POST['username']);
        $_POST['password'] = md5(trim($_POST['password']));
        if($m->insert($_POST)){
            $arr['status'] = 'y';
            $arr['info'] = '添加成功';
        }else{
            $arr['status'] = 'n';
            $arr['info'] = '添加失败';
        }
        echo json_encode($arr);
    }
    //会员启用
    public function member_startAction () {
        $m_id = $_POST['m_id'];
        $m = new FTable("member");
        if($m->where("m_id = $m_id")->update(array('status'=>1))){
            echo 1;
        }else{
            echo 0;
        }
    }
    //会员停用
    public function member_stopAction () {
        $m_id = $_POST['m_id'];
        $m = new FTable("member");
        if($m->where("m_id = $m_id")->update(array('status'=>0))){
            echo 1;
        }else{
            echo 0;
        }
    }
    //伪删除会员
    public function member_delAction () {
        $m_id = trim($_POST['m_id'],',');
        $m = new FTable("member");
        if($m->where("m_id=".$m_id)->remove(true)){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function member_del_messageAction () {
        $m_id = trim($_POST['m_id'],',');
        $m = new FTable("message");
        if($m->where("id in ($m_id)")->remove(true)){
            echo 1;
        }else{
            echo 0;
        }
    }
    //更新会员信息
    public function editAction () {
        $m_id = $_GET['a_id'];
        $m = new FTable("member");
        $adinfo = $m->find($m_id);
        $this->assign('adinfo',$adinfo);
        $this->display();
    }

    public function seeAction () {
        $m_id = $_GET['a_id'];
        $m = new FTable("member");
        $table = new FTable("postcard");
        $adinfo1 = $m->find($m_id);
        $userinfo = $table->where('user_id='.$m_id)->find();



        $adinfo['id'] = $adinfo1['m_id'];
        $adinfo['username'] = $adinfo1['username'];
        $adinfo['email'] = $adinfo1['email'];
        $adinfo['nickname'] = $adinfo1['nickname'];
        $adinfo['type'] = $adinfo1['type'];



        $adinfo['name'] = $userinfo['name'];
        $adinfo['company'] = $userinfo['company'];

        $area = new FTable('area');
        if($userinfo['province']){
            $province = $area -> where('id='.$userinfo['province']) -> find();
            $adinfo['province'] = $province['name'];
        }else{
            $adinfo['province'] = '未填写';
        }
        if($userinfo['city']){
            $city = $area -> where('id='.$userinfo['city']) -> find();
            $adinfo['city'] = $city['name'];
        }else{
            $adinfo['city'] = '未填写';
        }
        $adinfo['phone'] = $userinfo['phone'];
        $adinfo['weixin'] = $userinfo['weixin'];
        if($userinfo['title'] == 1){
            $adinfo['title'] = '博士';
        }elseif($userinfo['title'] == 2){
            $adinfo['title'] = '正高职称';
        }else{
            $adinfo['title'] = $userinfo['other'];
        }
        $adinfo['position'] = $userinfo['position'];
        $adinfo['address'] = $userinfo['address'];
        $adinfo['email1'] = $userinfo['email'];
        $adinfo['qq'] = $userinfo['qq'];
        $adinfo['content'] = $userinfo['content'];



        $adinfo['name1'] = $userinfo['name1'];
        $adinfo['company1'] = $userinfo['company1'];
        if($userinfo['province1']){
            $province1 = $area -> where('id='.$userinfo['province1']) -> find();
            $adinfo['province1'] = $province1['name'];
        }else{
            $adinfo['province1'] = '未填写';
        }
        if($userinfo['city1']){
            $city1 = $area -> where('id='.$userinfo['city1']) -> find();
            $adinfo['city1'] = $city1['name'];
        }else{
            $adinfo['city1'] = '未填写';
        }
        $adinfo['phone1'] = $userinfo['phone1'];
        $adinfo['weixin1'] = $userinfo['weixin1'];
        if($userinfo['title1'] == 1){
            $adinfo['title1'] = '博士';
        }elseif($userinfo['title1'] == 2){
            $adinfo['title1'] = '正高职称';
        }else{
            $adinfo['title1'] = $userinfo['other1'];
        }
        $adinfo['position1'] = $userinfo['position1'];
        $adinfo['address1'] = $userinfo['address1'];
        $adinfo['email2'] = $userinfo['email1'];
        $adinfo['qq1'] = $userinfo['qq1'];
        $adinfo['content1'] = $userinfo['content1'];
        FSession::set('excel_data',$adinfo);
        $this->assign('adinfo',$adinfo);
        $this->display();
    }


    public function exportAction(){
        require_once WEB_ROOT_DIR."/lib/flib/Excel.php";
        $list = FSession::get('excel_data');
        $row = array();
        $row[0] = array('序号', '手机', '邮箱', '昵称', '名片一:姓名', '名片一:单位', '名片一:所在省', '名片一:所在市','名片一:手机','名片一:微信号','名片一:头衔','名片一:职位','名片一:地址','名片一:邮箱','名片一:QQ号','名片一:经营/研究领域','名片二:姓名','名片二:单位', '名片二:所在省', '名片二:所在市','名片二:手机','名片二:微信号','名片二:头衔','名片二:职位','名片二:地址','名片二:邮箱','名片二:QQ号','名片二:经营/研究领域');
        $row[1] = $list;
        $xls = new Excel_XML('UTF-8', false, $list['username']);
        $xls->addArray($row);
        $xls->generateXML($list['username']);
    }

    public function export_allAction(){
        require_once WEB_ROOT_DIR."/lib/flib/Excel.php";

        $m = new FTable("member");
        $table = new FTable("postcard");
        $adinfo1 = $m->order(array('m_id'=> 'asc'))->select();
        foreach($adinfo1 as $key=> $v){
            $adinfo[$key]['id'] = $v['m_id'];
            $adinfo[$key]['username'] = $v['username'];
            $adinfo[$key]['email'] = $v['email'];
            $adinfo[$key]['nickname'] = $v['nickname'];
            $userinfo = $table->where('user_id='.$v['m_id']) ->find();
            $adinfo[$key]['name'] = $userinfo['name'];
            $adinfo[$key]['company'] = $userinfo['company'];

                $area = new FTable('area');
                if($userinfo['province']){
                    $province = $area -> where('id='.$userinfo['province']) -> find();
                    $adinfo[$key]['province'] = $province['name'];
                }else{
                    $adinfo[$key]['province'] = '未填写';
                }
                if($userinfo['city']){
                    $city = $area -> where('id='.$userinfo['city']) -> find();
                    $adinfo[$key]['city'] = $city['name'];
                }else{
                    $adinfo[$key]['city'] = '未填写';
                }
                $adinfo[$key]['phone'] = $userinfo['phone'];
                $adinfo[$key]['weixin'] = $userinfo['weixin'];
                if($userinfo['title'] == 1){
                    $adinfo[$key]['title'] = '博士';
                }elseif($userinfo['title'] == 2){
                    $adinfo[$key]['title'] = '正高职称';
                }else{
                    $adinfo[$key]['title'] = $userinfo['other'];
                }
                $adinfo[$key]['position'] = $userinfo['position'];
                $adinfo[$key]['address'] = $userinfo['address'];
                $adinfo[$key]['email1'] = $userinfo['email'];
                $adinfo[$key]['qq'] = $userinfo['qq'];
                $adinfo[$key]['content'] = $userinfo['content'];



                $adinfo[$key]['name1'] = $userinfo['name1'];
                $adinfo[$key]['company1'] = $userinfo['company1'];
                if($userinfo['province1']){
                    $province1 = $area -> where('id='.$userinfo['province1']) -> find();
                    $adinfo[$key]['province1'] = $province1['name'];
                }else{
                    $adinfo[$key]['province1'] = '未填写';
                }
                if($userinfo['city1']){
                    $city1 = $area -> where('id='.$userinfo['city1']) -> find();
                    $adinfo[$key]['city1'] = $city1['name'];
                }else{
                    $adinfo[$key]['city1'] = '未填写';
                }
                $adinfo[$key]['phone1'] = $userinfo['phone1'];
                $adinfo[$key]['weixin1'] = $userinfo['weixin1'];
                if($userinfo['title1'] == 1){
                    $adinfo[$key]['title1'] = '博士';
                }elseif($userinfo['title1'] == 2){
                    $adinfo[$key]['title1'] = '正高职称';
                }else{
                    $adinfo[$key]['title1'] = $userinfo['other1'];
                }
                $adinfo[$key]['position1'] = $userinfo['position1'];
                $adinfo[$key]['address1'] = $userinfo['address1'];
                $adinfo[$key]['email2'] = $userinfo['email1'];
                $adinfo[$key]['qq1'] = $userinfo['qq1'];
                $adinfo[$key]['content1'] = $userinfo['content1'];
        }


        $row = array();
        $row[0] = array('序号', '手机', '邮箱', '昵称', '名片一:姓名', '名片一:单位', '名片一:所在省', '名片一:所在市','名片一:手机','名片一:微信号','名片一:头衔','名片一:职位','名片一:地址','名片一:邮箱','名片一:QQ号','名片一:经营/研究领域','名片二:姓名','名片二:单位', '名片二:所在省', '名片二:所在市','名片二:手机','名片二:微信号','名片二:头衔','名片二:职位','名片二:地址','名片二:邮箱','名片二:QQ号','名片二:经营/研究领域');
        $i = 1;
        foreach ($adinfo as $v) {
            $row[$i]['id'] = $v['id'];
            $row[$i]['username'] = $v['username'];
            $row[$i]['email'] = $v['email'];
            $row[$i]['nickname'] = $v['nickname'];
            $row[$i]['name'] = $v['name'];
            $row[$i]['company'] = $v['company'];
            $row[$i]['province'] = $v['province'];
            $row[$i]['city'] = $v['city'];
            $row[$i]['phone'] = $v['phone'];
            $row[$i]['weixin'] = $v['weixin'];
            $row[$i]['title'] = $v['title'];
            $row[$i]['position'] = $v['position'];
            $row[$i]['address'] = $v['address'];
            $row[$i]['email1'] = $v['email1'];
            $row[$i]['qq'] = $v['qq'];
            $row[$i]['content'] = $v['content'];



            $row[$i]['name1'] = $v['name1'];
            $row[$i]['company1'] = $v['company1'];
            $row[$i]['province1'] = $v['province1'];
            $row[$i]['city1'] = $v['city1'];
            $row[$i]['phone1'] = $v['phone1'];
            $row[$i]['weixin1'] = $v['weixin1'];
            $row[$i]['title1'] = $v['title1'];
            $row[$i]['position1'] = $v['position1'];
            $row[$i]['address1'] = $v['address1'];
            $row[$i]['email2'] = $v['email2'];
            $row[$i]['qq1'] = $v['qq1'];
            $row[$i]['content1'] = $v['content1'];
            $i++;
        }
        $xls = new Excel_XML('UTF-8', false, 'user_info');
        $xls->addArray($row);
        $xls->generateXML('user_info');
    }

    public function edit_messageAction () {
        $m_id = $_GET['a_id'];
        $m = new FTable("message");
        $adinfo = $m->find($m_id);
        $this->assign('adinfo',$adinfo);
        $this->display();
    }

    public function reply_messageAction  () {
        $m_id = $_GET['a_id'];
        $m = new FTable("message");
        $member = new FTable("member");
        $adinfo = $m->find($m_id);
        $user = $member->find($adinfo['sender']);
        $user_info = $user['username'];

        $this->assign('user_info',$user_info);
        $this->display();
    }

    public function send_messageAction() {
        if ($_POST) {
            $member = new FTable('member');
                $recipient = $_POST['touser'];
                $user = $member->where("username='" . $recipient . "'")->find();
                if (!$user) {
                    $this->error('收件人不存在！', '/front/Index/send_message');
                } else {
                    $message = new FTable('message');
                    $data['sender'] = '1';
                    $data['type'] = '2';
                    $data['info'] = $_POST['bz'];
                    $data['status'] = '1';
                    $data['title'] = $_POST['tinf'];
                    $data['recipient'] = $user['m_id'];
                    $updata = $message->insert($data);
                    if ($updata) {
                        $this->success('发送成功！');

                    } else {
                        $this->error('发送失败，请重试！');

                    }
                }
        }
        $this->display();
    }

    public function updateAction () {
        $m_id = $_POST['m_id'];
        $m = new FTable("member");
        if($m->where("m_id = $m_id")->update($_POST)){
            $arr['status'] = 'y';
            $arr['info'] = '更新成功';
        }else{
            $arr['status'] = 'n';
            $arr['info'] = '更新失败';
        }
        echo json_encode($arr);
    }
    //修改密码显示页
    public function change_pwdAction () {
        $m_id = $_GET['m_id'];
        $m = new FTable("member");
        $res = $m->find($m_id);
        $this->assign('minfo',$res);
        $this->display();
    }
    public function do_pwdAction () {
        $m_id = $_POST['m_id'];
        $m = new FTable("member");
        $password = md5(trim($_POST['password']));
        if($m->where("m_id = $m_id")->update(array('password'=>$password))){
            $arr['status'] = 'y';
            $arr['info'] = '更新成功';
        }else{
            $arr['status'] = 'n';
            $arr['info'] = '更新失败';
        }
        echo json_encode($arr);
    }

    //被删除（伪删除）用户列表
    public function deletedlistAction () {
        if($_POST){
            $datemin = strtotime($_POST['datemin']);
            $datemax = strtotime($_POST['datemax']." 23:59:59");
            $username = $_POST['username'];
            $this->assign('username',$username);
            $this->assign('datemin',$_POST['datemin']);
            $this->assign('datemax',$_POST['datemax']);
            if($username){
                $user = "username like '%$username%' ";
                $deleted = " and deleted = '0'";
                if($_POST['datemax']){
                    $max = " and rtime < $datemax";
                }
                if($_POST['datemin']){
                    $min = " and rtime > $datemin";
                }
            }else{
                if($_POST['datemax']){
                    $deleted = " and deleted = '0'";
                    $max = "  rtime < $datemax";
                    if($_POST['datemin']){
                        $min = " and rtime > $datemin";
                    }
                }else{
                    if($_POST['datemin']){
                        $deleted = " and deleted = '0'";
                        $min = " rtime > $datemin";
                    }else{
                        $deleted = "deleted = '0'";
                    }
                }
            }
        }else{
            $deleted = "deleted = '0'";
        }
        $m = new FTable("member");
        $ainfo = $m->where($user.$max.$min.$deleted)->select();
        $count = $m->where($user.$max.$min.$deleted)->count();
        $this->assign('ainfo',$ainfo);
        $this->assign('count',$count);
        $this->display();
    }
    //将伪删除用户还原为正常状态
    public function member_hyAction (){
        $m_id = $_POST['m_id'];
        $m = new FTable("member");
        if($m->where("m_id = $m_id")->update(array('deleted'=>1))){
            echo 1;
        }else{
            echo 0;
        }
    }
    //将伪删除用户彻底删除
    public function all_deleteAction () {
        $m_id = trim($_POST['m_id'],',');
        $m = new FTable("member");
        if($m->where("m_id in ($m_id)")->remove(true)){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function browseAction () {
        $this->display();
    }

    public function showAction () {
        $m_id = $_GET['m_id'];
        $m = new FTable("member");
        $mm = $m->find($m_id);
        $this->assign('mm',$mm);
        $this->display();
    }

    public function changeAction(){
        $num =  15;
        $table = new FTable('member');
        $user_card = new FTable('rolodex');
        $card = $user_card -> order(array('id'=>'desc'))->page($_GET['page'])->limit($num)->select();
        foreach($card as $key=>$v){
            $user = $table -> where('m_id='.$v['user_id']) -> find();
            $apply = $table -> where('m_id='.$v['apply_user']) -> find();
            $data[$key]['user_name'] = $user['username'];
            $data[$key]['user_nickname'] = $user['nickname'];
            $data[$key]['apply_name'] = $apply['username'];
            $data[$key]['apply_nickname'] = $apply['nickname'];
            $data[$key]['time'] = $v['create_time'];
            $data[$key]['key'] = $key;
        }
        $this->assign('data',$data);
        $this->assign('page_info', $user_card->getPagerInfo());

        $this->display();

    }

    public function user_msgAction(){
        $num =  15;
        $table = new FTable('message');
        $member = new FTable('member');
        $message = $table -> where('type=0')-> order(array('id'=>'desc'))->page($_GET['page'])->limit($num)->select();
        $i = 0;
        foreach($message as $key=>$v){
            if($v['type']){
            }else{
            $user = $member -> where('m_id='.$v['sender']) -> find();
            $apply = $member -> where('m_id='.$v['recipient']) -> find();
            $data[$key]['user_name'] = $user['username'];
            $data[$key]['user_nickname'] = $user['nickname'];
            $data[$key]['apply_name'] = $apply['username'];
            $data[$key]['apply_nickname'] = $apply['nickname'];
            $data[$key]['time'] = $v['create_time'];
            $data[$key]['key'] = $i;
            $data[$key]['id'] = $v['id'];
             $i++;
            }
        }
        $this->assign('num',$num);

        $this->assign('page_info', $table->getPagerInfo());
        $this->assign('data',$data);
        $this->display();

    }

    public function commentAction(){
        $table = new FTable('common');
        $num =  15;
        if($_POST['title1']){
            $message = $table ->where("user_name like '%".$_POST['title1']."%'")->page($_GET['page'])->limit($num)-> order(array('id'=>'desc')) -> select();
        }else{
            $message = $table -> order(array('id'=>'desc'))->page($_GET['page'])->limit($num) -> select();
        }
        $this -> assign('message',$message);
        $this->assign('page_info', $table->getPagerInfo());

        $this -> display();
    }

    public function edit_commentAction () {
        $m_id = $_GET['a_id'];
        $m = new FTable("common");
        $adinfo = $m->find($m_id);
        $this->assign('adinfo',$adinfo);
        $this->display();
    }

    public function member_del_commentAction () {
        $m_id = trim($_POST['m_id'],',');
        $m = new FTable("common");
        if($m->where("id=".$m_id)->remove(true)){
            echo 1;
        }else{
            echo 0;
        }
    }


    public function member_del_contentAction(){
        $m_id = trim($_POST['m_id'],',');
        $m = new FTable("common");
        if($m->where("id in ($m_id)")->remove(true)){
            echo 1;
        }else{
            echo 0;
        }
    }

}