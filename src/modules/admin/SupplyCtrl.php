<?php

class AdminSupplyCtrl extends  AdminAbstractCtrl {
    public function indexAction () {
        if($_POST) {
            $datemin = strtotime($_POST['datemin']);
            $datemax = strtotime($_POST['datemax'] . " 23:59:59");
            $title = $_POST['title'];
            $this->assign('title', $title);
            $this->assign('datemin', $_POST['datemin']);
            $this->assign('datemax', $_POST['datemax']);
            if ($title) {
                $where['title'] = array('like' => $title);
            }
            if ($_POST['datemax'] || $_POST['datemin']) {
                $where['rtime'] = array('lt' => $datemax,'gt' => $datemin);
            }
        }
        //管理员权限
        $gid = FSession::get('manager_gid');
        $this->assign('gid',$gid);

        $m = new FTable("supply");
        $ainfo = $m->where($where)->order("gq_id desc")->select();
        $count = $m->where($where)->count();
        $this->assign('ainfo',$ainfo);
        $this->assign('count',$count);
        FSession::set('excel_all',$ainfo);
        $this->display();
    }
    public function no_passAction () {
        if($_POST) {
            $datemin = strtotime($_POST['datemin']);
            $datemax = strtotime($_POST['datemax'] . " 23:59:59");
            $title = $_POST['title'];
            $this->assign('title', $title);
            $this->assign('datemin', $_POST['datemin']);
            $this->assign('datemax', $_POST['datemax']);
            if ($title) {
                $where['title'] = array('like' => $title);
            }
            if ($_POST['datemax'] || $_POST['datemin']) {
                $where['rtime'] = array('lt' => $datemax,'gt' => $datemin);
            }
        }
        //管理员权限
        $gid = FSession::get('manager_gid');
        $this->assign('gid',$gid);

        //此方法查未通过信息
        $where['review'] = 2;
        $m = new FTable("supply");
        $ainfo = $m->where($where)->order("gq_id desc")->select();
        $count = $m->where($where)->count();
        $this->assign('ainfo',$ainfo);
        $this->assign('count',$count);
        FSession::set('excel_no_pass',$ainfo);
        $this->display();
    }
    public function re_topAction () {
        if($_POST) {
            $datemin = strtotime($_POST['datemin']);
            $datemax = strtotime($_POST['datemax'] . " 23:59:59");
            $title = $_POST['title'];
            $this->assign('title', $title);
            $this->assign('datemin', $_POST['datemin']);
            $this->assign('datemax', $_POST['datemax']);
            if ($title) {
                $where['title'] = array('like' => $title);
            }
            if ($_POST['datemax'] || $_POST['datemin']) {
                $where['rtime'] = array('lt' => $datemax,'gt' => $datemin);
            }
        }
        //管理员权限
        $gid = FSession::get('manager_gid');
        $this->assign('gid',$gid);

        //此方法查置顶信息
        $where['top_time'] = array('>'=>0);
        $m = new FTable("supply");
        $ainfo = $m->where($where)->order("gq_id desc")->select();
        $count = $m->where($where)->count();
        $this->assign('ainfo',$ainfo);
        $this->assign('count',$count);
        FSession::set('excel_top',$ainfo);
        $this->display();
    }

    //导出excel表格
    public function exportAction(){
        $name = $_REQUEST['s'];
        require_once "lib/flib/Excel.php";
        $list = FSession::get("$name");
        foreach($list as $k=>$v){
            switch($v['gq_type']){
                case 1:
                    $list[$k]['gq_type'] = '供应';
                    break;
                case 2:
                    $list[$k]['gq_type'] = '求购';
                    break;
            }
            $arr = array('请选择','安徽','北京','重庆','福建','甘肃','广东','广西','贵州','海南','河北','黑龙江','河南','香港','湖北','湖南','江苏','江西','吉林','辽宁','澳门','内蒙古','宁夏','青海','山东','上海','山西','陕西','四川','台湾','天津','新疆','西藏','云南','浙江');
            $list[$k]['city'] = $arr[$v['city']];
            $lj = array('请选择','甜椒','朝天椒','金塔','北京红','冷冻北京红','冷冻金塔','冷冻益都红','辣椒粉','辣椒碎','辣椒红色素','辣椒籽','甜椒籽','其他');
            $list[$k]['lj_type'] = $lj[$v['lj_type']];
        }
        $row = array();
        $row[0] = array('序号', '供求', '内容', '仓储地', '辣椒种类', '联系电话', '发布人', '发布日期');
        $i = 1;
        foreach ($list as $v) {
            $row[$i]['i'] = $i;
            $row[$i]['gq_type'] =$v['gq_type'];
            $row[$i]['content'] = strip_tags($v['content']);
            $row[$i]['address'] = $v['city'].$v['address'];
            $row[$i]['lj_type'] = $v['lj_type'];
            $row[$i]['phone'] = $v['phone'];
            $row[$i]['name'] = $v['name'];
            $row[$i]['rtime'] = date("Y-m-d H:i:s", $v['rtime']);
            $i++;
        }

        $xls = new Excel_XML('UTF-8', false, "$name");
        $xls->addArray($row);
        $xls->generateXML("$name");
    }

    //更新
    public function editAction () {
        $m_id = $_GET['gq_id'];
        $m = new FTable("supply");
        $adinfo = $m->find($m_id);
        $this->assign('adinfo',$adinfo);
        $this->display();
    }
    public function updateAction () {
        $gq_id = $_POST['gq_id'];
        $m = new FTable("supply");
        $supply=$m->find($gq_id);
        $supply['gq_type']=($_POST['gq_type']);
        $supply['lj_type']=($_POST['lj_type']);
        $supply['f_type']=($_POST['f_type']);
        $supply['title']=($_POST['title']);
        $supply['name']=($_POST['name']);
        $supply['phone']=($_POST['phone']);
        $supply['city']=($_POST['city']);
        $supply['address']=($_POST['address']);
        $supply['last_time']=($_POST['last_time']);
        if($m->where("gq_id = $gq_id")->update($supply)){
            $arr['status'] = 'y';
            $arr['info'] = '更新成功';
        }else{
            $arr['status'] = 'n';
            $arr['info'] = '更新失败';
        }
        echo json_encode($arr);
    }
    public function showAction () {
        $m_id = $_GET['gq_id'];
        $m = new FTable("supply");
        $mm = $m->find($m_id);
        $this->assign('mm',$mm);
        $this->display();
    }
    public function reviewAction () {
        $m_id = $_GET['gq_id'];
        $m = new FTable("supply");
        $mm = $m->find($m_id);
        $this->assign('mm',$mm);
        $this->display();
    }
    public function doReviewAction () {
        $gq_id = $_POST['gq_id'];
        $m = new FTable("supply");
        $supply=$m->find($gq_id);
        $supply['review']=intval($_POST['review']);
        if($m->where("gq_id = $gq_id")->update($supply)){
            $arr['status'] = 'y';
            $arr['info'] = '审核成功';
        }else{
            $arr['status'] = 'n';
            $arr['info'] = '审核失败';
        }
        echo json_encode($arr);
    }
    public function settopAction () {
        $m_id = $_GET['gq_id'];
        $m = new FTable("supply");
        $mm = $m->find($m_id);
        $this->assign('mm',$mm);
        $this->assign('defaultTime',date("Y-m-d",strtotime("+".$mm['last_time']." days")));
        $this->display();
    }
    public function doSetTopAction () {
        $gq_id = $_POST['gq_id'];
        $m = new FTable("supply");
        $supply=$m->find($gq_id);
        $supply['top_time']=($_POST['top_time']);
        if($_POST['top_order'])
        {
            $supply['top_order']=intval($_POST['top_order']);
        }
        if($m->where("gq_id = $gq_id")->update($supply)){
            $arr['status'] = 'y';
            $arr['info'] = '置顶成功';
        }else{
            $arr['status'] = 'n';
            $arr['info'] = '置顶失败';
        }
        echo json_encode($arr);
    }

    //删除供求信息
    public function supply_delAction () {
        $gq_id = trim($_POST['gq_id'],',');
        $m = new FTable("supply");
        if($m->where("gq_id in ($gq_id)")->remove(true)){
            echo 1;
        }else{
            echo 0;
        }
    }
}