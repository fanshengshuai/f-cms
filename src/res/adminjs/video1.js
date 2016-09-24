// JavaScript Document
$(function(){
	var srcl="",simg=''
	//高度计算
	$(window).resize(function(){
		video()
	})
	$(window).resize();
	
	var isSupportTouch = "ontouchend" in document ? true : false;
	$(".video_button").click(function(e){
		srcl=$(this).data("video");
		simg=$(this).data("img");
		$(".video_appbox").fadeIn();
		video()
	})
	
	$(".video_appbox .mask").click(function(){
		$(".video_appbox").fadeOut();
		$(".video_t").html("")
	})
	

	
	function video(){

		if(isSupportTouch) {
            $(".video_t").html("<video width='500' height='400' src='"+ srcl +"' type='video/mp4' id='media' poster='"+ simg +"' controls='controls' preload='none'></video>")
			//
			$(".video_t video").attr({width:$(".video_t").width(),height:$(".video_t").height()})
        } else {
            videoBox($(".video_t").width(), $(".video_t").height(), srcl,simg);
        }

	}
	
	function videoBox(width, height, url,img) {
	    var s1 = new SWFObject("../flash/flvplayer.swf","single",width,height,"7");
        s1.addParam("allowfullscreen","true");
        s1.addParam("wmode","transparent");
        s1.addVariable("file",url);
        s1.addVariable("autostart","true");
        s1.addVariable("width",width);
		s1.addVariable("backcolor",0x000000);
		s1.addVariable("frontcolor",0xFFFFFF);
		s1.addVariable("lightcolor",0x000000);
        s1.addVariable("height",height);
        s1.write("player1");
	}
	
})