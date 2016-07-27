<?php

class FrontAbsCtrl extends FController {
    public function beforeAction() {
//
//        if (FRequest::isMobile()) {
//            FResponse::redirect("/mobile");
//        }
//
//        //导航的分类
//        $catT = new FTable("cat");
//        $cat_info = $catT->where("status = 1")->limit(3)->order("sort asc")->select();
//        $this->assign("cat_info", $cat_info);
//        //系统设置
//        $sT = new FTable("setting");
//        $sett = $sT->select();
//        $setting = array();
//        foreach($sett as $k=>$v){
//            $setting[$v['setting_name']] = $v['setting_value'];
//        }
//        $setting['hot_search'] = explode(" ", trim($setting['hot_search'], " "));
//        $this->assign("setting", $setting);
//        //用户协议
//        $fragmentT = new FTable("fragment");
//        $agreement = $fragmentT->where("name = 'agreement'")->find();
//        $this->assign("agreement",$agreement);
//        //热门课程
//        $hot_sql = "SELECT a.*,b.name FROM xy_course as a LEFT JOIN xy_teacher as b on a.teacher_id=b.teacher_id WHERE a.is_hot = 1 ORDER BY order_num DESC limit 3";
//        $hot = FDB::fetch($hot_sql);
//        $this->assign("hot", $hot);
//        //轮播
//        $bT = new FTable("banner");
//        $banner = $bT->where("type = 1")->order("sort asc")->select();
//        $this->assign("banner", $banner);
//        //尾部文章
//        $aT = new FTable("article");
//        $as = $aT->select();
//        $a_info = array();
//        foreach($as as $k=>$v){
//            $a_info[$v['cat_id']][] = $v;
//        }
//        $this->assign("articles",$a_info);
        return true;
    }
}