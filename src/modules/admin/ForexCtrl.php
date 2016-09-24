<?php

class AdminForexCtrl extends AdminAbstractCtrl {
    public function indexAction(){
        $m = new FTable('forex');
        $data = $m->order('sort asc')->select();
        $this->assign('data',$data);
        $this->display();
    }
    public function addAction(){
        if(IS_POST){
            $data['currency'] = $_POST['currency'];
            $data['unit'] = $_POST['unit'];
            $data['sort'] = $_POST['sort'];
            if(M('forex')->insert($data)){
                $this->success('数据添加成功！', '/admin/Forex/index',1);
            }else{
                $this->error('数据添加失败！');
            }
        }else{
            $this->display();
        }
    }
    public function editAction(){
        if(IS_POST){
            $id = $_POST['id'];
            if(M('forex')->where('id='.$id)->update($_POST)){
                $this->success('数据修改成功！', '/admin/Forex/index',1);
            }else{
                $this->error('数据修改失败！');
            }
        }else{
            $eid = $_GET['id'];
            $data = M('forex')->where('id='.$eid)->find();
            $this->assign('data',$data);
            $this->display();
        }
    }
    public function delAction(){
        $id = FRequest::getInt('id');
        $t = new FTable('forex');

        $t->where(array('id' => $id))->remove(true);
        FResponse::output(array('result' => 1));
    }

}