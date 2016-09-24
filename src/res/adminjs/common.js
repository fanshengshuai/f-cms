$(function(){
	//banner
	var lis=$(".banner li").size();
	var ind=0;
	var timer=null;
	for(i=0 ; i<lis ; i++){
		$(".iBtn").append("<span></span>")
	}
	$(".iBtn span:first").addClass("on")
	function move(index){
		$(".banner li").eq(index).fadeIn().siblings().fadeOut();
		$(".iBtn span").eq(index).addClass("on").siblings().removeClass("on");
	}
	timer=setInterval(function(){
		ind++;
		if(ind>=lis){
			ind=0;
		}
		move(ind);
	},6000)
	$(".iBtn span").click(function(){
		clearInterval(timer);
		var nIndex=$(".iBtn span").index(this);
		//alert(nIndex)
		$(".banner li").eq(nIndex).fadeIn().siblings().fadeOut();
		$(".iBtn span").eq(nIndex).addClass("on").siblings().removeClass("on");
		ind=nIndex;
		timer=setInterval(function(){
			ind++;
			if(ind>=lis){
				ind=0;
			}
			move(ind);
			
		},6000)
	})
	
	$(".product .con ul li").each(function(index) {
        $(this).click(function(){
			//$(".product .con .box").eq(index).show().siblings(".box").hide();
		})
    });
	$(".product .con .box a.close").click(function(){
		$(this).parent(".box").hide();
	})
	
	
	//nav
	$(".nav ul li").hover(function(){
			$(this).addClass("active")
			$(this).children("dl").show();
			
		
	},function(){
			$(this).removeClass("active")
			$(this).children("dl").hide();
		})
	
	/*$(".nav ul li").each(function(){
			$(this).find("dd").eq($(this).find("dd").size()-1).css({"borderBottom":"none"});
	})
	$(".nav ul li").each(function() {
        $(this).find("dl a:last").css("margin",0)
    });*/
	
	
	$(".footer .right ul li:first").addClass("first");
	$(".about_care_content ul li:last").addClass("last");
	$(".newsList li:last").addClass("last");
	$(".containers .search_list li:odd").addClass("odd");
	$(".cocept_content article table tr:odd").addClass("odd");
	$(".cocept_content article table tr:first").addClass("first");
	$(".catering_top .right .caterimg_btn").click(function(){
		$(this).prev(".con").show().stop().animate({"width":"442px","left":"0","z-index":"1"},500).siblings(".con").stop().animate({"width":"0","left":"-442px","z-index":"0"},500);//
		$(this).addClass("on").siblings(".caterimg_btn").removeClass("on")
	}).first().click();
	$(".scrollBox ul li").hover(function(){
		$(this).find(".box").stop(false,true).slideDown();
	},function(){
		$(this).find(".box").stop(false,true).slideUp();
	})
	$(".fastfood_product ul li").hover(function(){
		$(this).find(".box").stop(false,true).slideDown();
	},function(){
		$(this).find(".box").stop(false,true).slideUp();
	})
	$(".hotel_product ul li .tit").click(function() {
			$(this).parent("li").stop().animate({"width":"469px"},200).siblings("li").stop().animate({"width":"174px"},200);
			$(this).parent("li").find(".con").stop().animate({"z-index":"1"},200).parent("li").siblings("li").find(".con").stop().animate({"z-index":"0"},200);
    }).first().click();
	
	
	/*
	//scrollBox
	function scrollBox3(Wrap,arrow_l,arrow_r,num){
		  
		  var $scrollBox_ul = $(Wrap).find(".introduction_detail"); 
		  var li_width = $scrollBox_ul.find("dl:first").outerWidth(true);
		  var scrollBox_li=$(Wrap).find("dl");
	
		  
		  if(scrollBox_li.length>num){
			 
			   $(Wrap).prev().click(function(){
					 if(!$scrollBox_ul.is(":animated")){  
							$scrollBox_ul.css({marginLeft:-li_width});
							$scrollBox_ul.find("dl:first").before($scrollBox_ul.find("dl:last"))
							$scrollBox_ul.animate({ "marginLeft" : 0+"px" }, 500)
					  } 	
			   })
			   
			   $(Wrap).next().click(function(){
					  if(!$scrollBox_ul.is(":animated")){  
							$scrollBox_ul.animate({ "marginLeft" : -li_width+"px" }, 500 , function(){
							$scrollBox_ul.css({marginLeft:0}).find("dl:first").appendTo($scrollBox_ul); 
							})
					  }
			   })
		 } 
		 
		 scrollBox_li.live("click",function(){
			  
			  var data=$(this).attr("data");
			  $(".Big img").eq(data).fadeIn().siblings().fadeOut() 
			 
		 })
	}
	
	$(function(){
		scrollBox3(".introductionWrap",".LeftBtn",".RightBtn",4)// 外框，左，右，不滚动数量	
	})
	
	
	//scrollBox
	function scrollBox2(Wrap,arrow_l,arrow_r,num){
		  
		  var $scrollBox_ul = $(Wrap).find(".introductionVideo_detail"); 
		  var li_width = $scrollBox_ul.find("dl:first").outerHeight(true);
		  var scrollBox_li=$(Wrap).find("dl");
		  var index=0;
		  
		  if(scrollBox_li.length>num){
			 
			   $(arrow_l).click(function(){
					 if(!$scrollBox_ul.is(":animated")){  
							
							if(index==0){
							   return false;
							 }
							
							if(index<=1){
								
								$(arrow_l).find("a").css("background-position","left top");//左面灰色	
							 }
							 else
							 {
								$(arrow_r).find("a").css("background-position","left -18px");//右面红色  
							 }
							
							index--;
													
							$scrollBox_ul.css({marginTop:-li_width});
							$scrollBox_ul.find("dl:first").before($scrollBox_ul.find("dl:last"))
							$scrollBox_ul.animate({ "marginTop" : 0+"px" }, 500)
							
					  } 	
			   })
			   
			   $(arrow_r).click(function(){
					  if(!$scrollBox_ul.is(":animated")){ 
							
							index++;
							
							if(index>scrollBox_li.length-num){
								index=scrollBox_li.length-num;
								return false;					
							}
							
							if(index>scrollBox_li.length-num-1)	
							{
								$(arrow_r).find("a").css("background-position","left 16px")//右面灰色  
							}
							else
							{
								$(arrow_l).find("a").css("background-position","left 32px"); //左面红色	 
							}	
							
							$scrollBox_ul.animate({ "marginTop" : -li_width+"px" }, 500 , function(){
							$scrollBox_ul.css({marginTop:0}).find("dl:first").appendTo($scrollBox_ul); 
							
							})
					  }
			   })
		 } 
	}
	
	$(function(){
		scrollBox2(".introductionVideoWrap",".topBtn",".bottomBtn",3)// 外框，左，右，不滚动数量	
	})
	*/
}) 


	//单独样式标记
	$(document).ready(function(){
	$(".newlist4 ul li:nth-child(3n)").addClass('last');
	$(".newlist5 ul li:nth-child(3n)").addClass('last');
	})
	
	
	// 弹出新窗口打印
	function doPrint() {
	bdhtml=window.document.body.innerHTML;
	sprnstr="<!--startprint-->";
	eprnstr="<!--endprint-->";
	prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17);
	prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));
	OpenWindow = window.open("");  
	OpenWindow.document.write("<!DOCTYPE html PUBLIC '-\/\/W3C\/\/DTD XHTML 1.0 Transitional\/\/EN' 'http:\/\/www.w3.org\/TR\/xhtml1\/DTD\/xhtml1-transitional.dtd'><html xmlns='http:\/\/www.w3.org\/1999\/xhtml'><HEAD><meta http-equiv=\"Content-Type\" content=\"text\/html; charset=utf-8\" \/><TITLE>打印页面<\/TITLE><link href=\"..\/css\/style.css\" rel=\"stylesheet\" type=\"text\/css\" \/><\/HEAD><BODY><div id=\"printbox\" ><\/div><\/BODY><\/HTML>"); 
	OpenWindow.document.getElementById("printbox").innerHTML=prnhtml;  
	OpenWindow.document.close(); 
	OpenWindow.print();  
	}
	/*打印区的内容一定要加<!--startprint-->和<!--endprint-->标记*/


//内容区 字体字号
$(document).ready(function () {
    //
    $('.a_size i').click(function () {
        var index = $(this).index();
        $(this).addClass('on').siblings().removeClass('on');
        if (index == 0) {
            $('.news_article span,p').css('font-size', '16px');
        }
        else if (index == 1) {
            $('.news_article span,p').css('font-size', '14px');
        }
        else {
            $('.news_article span,p').css('font-size', '12px');
        }
    })
    //
})




$(function(){
	function in_products() {
		
			var count = 1;
			var allCount = $(".honor_part ul li").size();
			if(allCount > 1) {
				$(".honor_part ul li:eq(0)").css({ "left": 0, "width": 286, "height": 213 }).show();
				$(".honor_part ul li:eq(1)").css({ "left": 113, "width": 439, "height": 328 }).show();
				$(".honor_part ul li:eq(2)").css({ "left": 376, "width": 286, "height": 213 }).show();
				//$(".honor_part ul li:eq(1)").find(".inPart2Wrap > a").attr("href", $(".honor_part ul li:eq(1)").find(".inPart2Wrap > a").attr("rel"));
				$(".honor_part ul li:eq(1)").find(".inPartArr").show();
				$(".ab_honor_text_part").eq(1).show();
			} else {
				$(".honor_part ul li:eq(0)").css({ "left": 113, "width": 439, "height": 328 }).show();
				$(".ab_honor_text_part").eq(0).show();
				$(".honor_part > a").hide();
			}
		
			try {
				var activeRule = {
					width: 439,
					height: 328,
					left: $(".honor_part ul li:eq(1)").position().left,
					top: $(".honor_part ul li:eq(1)").position().top
		
				}
				var activeRule_prev = {
					width: 286,
					height: 213,
					left: $(".honor_part ul li:eq(0)").position().left,
					top: $(".honor_part ul li:eq(0)").position().top
				}
				/*var activeRule_next = {
					width: 162,
					height: 110,
					left: $(".honor_part ul li:eq(2)").position().left,
					top: $(".honor_part ul li:eq(2)").position().top
				}*/
				var activeRule_next = {
					width: 286,
					height: 213,
					left: 376,
					top: 58
				}
			} catch (e) { }
		
			$(".news_listMedia ul").width($(".news_listMedia ul li").size() * 227);
		
			$("a.part2_arrow_l").click(function () {
				if (!$(".honor_part ul li").is(":animated")) {
					if (count <= 0) {
						return false;
		
					} else {
						count--;
						$("a.part2_arrow_r").removeClass("on")
						//alert(count)
						$(".honor_part ul li:eq(" + count + ")").find(".inPart2Wrap > a").attr("href", $(".honor_part ul li:eq(" + count + ")").find(".inPart2Wrap > a").attr("rel"));
						$(".honor_part ul li:eq(" + count + ")").siblings().find(".inPart2Wrap > a").attr("href", "javascript:void(0)");
						$(".honor_part ul li:eq(" + count + ")").siblings().css("zIndex", 1);
						$(".honor_part ul li:eq(" + count + ")").find(".inPartArr").show();
						$(".honor_part ul li:eq(" + count + ")").siblings().find(".inPartArr").hide();
						$(".honor_part ul li:eq(" + (count) + ")").css({ "zIndex": 3 }).addClass("on").siblings("li").removeClass("on");
						$(".honor_part ul li:eq(" + (count + 1) + ")").css({ "zIndex": 2 });
						$(".ab_honor_text_part").eq(count).show().siblings().hide();
		
						if (count - 1 < 0) {
							//alert(1);
						} else {
							$(".honor_part ul li:eq(" + (count - 1) + ")").find(".inPart2Shadow").css("bottom", -36);
							$(".honor_part ul li:eq(" + (count - 1) + ")").show().css({ "left": -$(".honor_part ul li:eq(0)").width(), "zIndex": 2 });
							$(".honor_part ul li:eq(" + (count - 1) + ")").animate({ "width": activeRule_prev.width, "height": activeRule_prev.height, "left": activeRule_prev.left, "top": activeRule_prev.top });
						}
						$(".honor_part ul li:eq(" + (count + 1) + ")").animate({ "width": activeRule_next.width, "height": activeRule_next.height, "left": activeRule_next.left, "top": activeRule_next.top });
						$(".honor_part ul li:eq(" + (count + 2) + ")").animate({ "width": activeRule_prev.width, "height": activeRule_prev.height, "left": $(".honor_part ul").width(), "top": activeRule_prev.top });
						$(".honor_part ul li:eq(" + (count) + ")").animate({ "width": activeRule.width, "height": activeRule.height, "left": activeRule.left, "top": activeRule.top });
						
						$(".honor_part ul li:eq(" + (count) + ")").find(".inPart2Wrap").animate({"width":439,"height":328})
						$(".honor_part ul li:eq(" + (count) + ")").siblings().find(".inPart2Wrap").animate({"width":286,"height":213});
						
		
					}
				}
				
				
				var index=$(".honor_part ul li.on").index();
				$(".honor_con").eq(index).show().siblings(".honor_con").hide();
				if (!$(".honor_con:first").is(":hidden")){$("a.part2_arrow_l").removeClass("on")}
			})
			$("a.part2_arrow_r").click(function () {
				if (!$(".honor_part ul li").is(":animated")) {
					if (count >= allCount - 1) {
						return false;
					} else {
						$("a.part2_arrow_l").addClass("on")
						count++;
						$(".honor_part ul li:eq(" + count + ")").find(".inPart2Wrap > a").attr("href", $(".honor_part ul li:eq(" + count + ")").find(".inPart2Wrap > a").attr("rel"));
						$(".honor_part ul li:eq(" + count + ")").siblings().find(".inPart2Wrap > a").attr("href", "javascript:void(0)");
						$(".honor_part ul li:eq(" + count + ")").siblings().css("zIndex", 1);
						$(".honor_part ul li:eq(" + count + ")").find(".inPartArr").show();
						$(".honor_part ul li:eq(" + count + ")").siblings().find(".inPartArr").hide();
						$(".honor_part ul li:eq(" + (count) + ")").css({ "zIndex": 3 }).addClass("on").siblings("li").removeClass("on");
						$(".honor_part ul li:eq(" + (count - 1) + ")").css({ "zIndex": 2 });
						$(".honor_part ul li:eq(" + (count + 1) + ")").show().css({ "left": $(".honor_part ul").width(), "zIndex": 2 });
						$(".honor_part ul li:eq(" + (count - 1) + ")").animate({ "width": activeRule_prev.width, "height": activeRule_prev.height, "left": activeRule_prev.left, "top": activeRule_prev.top });
						$(".honor_part ul li:eq(" + (count + 1) + ")").animate({ "width": activeRule_next.width, "height": activeRule_next.height, "left": activeRule_next.left, "top": activeRule_next.top });
						$(".ab_honor_text_part").eq(count).show().siblings().hide();
						if (count - 2 < 0) {
		
						} else {
							$(".honor_part ul li:eq(" + (count - 2) + ")").animate({ "width": activeRule_prev.width, "height": activeRule_prev.height, "left": -$(".honor_part ul li:eq(0)").width() - 10, "top": activeRule_prev.top });
						}
						$(".honor_part ul li:eq(" + count + ")").animate({ "width": activeRule.width, "height": activeRule.height, "left": activeRule.left, "top": activeRule.top });
						
						$(".honor_part ul li:eq(" + (count) + ")").find(".inPart2Wrap").animate({"width":439,"height":328})
						$(".honor_part ul li:eq(" + (count) + ")").siblings().find(".inPart2Wrap").animate({"width":286,"height":213});
		
					}
				}
				
				var index=$(".honor_part ul li.on").index();
				$(".honor_con").eq(index).show().siblings(".honor_con").hide();
				
				
				if (!$(".honor_con:last").is(":hidden")){$("a.part2_arrow_r").addClass("on")}
			})
		}
		in_products();






})
