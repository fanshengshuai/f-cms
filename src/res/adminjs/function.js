//单独样式标记
$(function(){
	
	var LiWidth=$(".zr_con li:eq(0)").width()+14;
	var Ul=$(".zr_con ul");
	var ispeet=-5
	var offset = Ul.position();
	function a(){
			clearTimeout(tim);
			$(".zr_content").animate({"left":"-=" + LiWidth + "px"},1000,function(){
				$(this).css("left","0px").find("li:first").appendTo($(this));
			});
			tim = setTimeout(a,2000);
	}
	tim=setTimeout(a,2000)
	$(".zr_content li").hover(function(){
		clearTimeout(tim);
	},function(){
		tim = setTimeout(a,2000);
	});
	
	
	function scroll_manage(){
				var oUl = $(".scrollBox ul");
				var oLiWid = $(".scrollBox ul li:eq(0)").width();
				var timer = null;
				var leB = $(".prev");
				var riB = $(".next");
				if(oUl.find("li").size() < 4){return false};
				
				function prevLeft(){
					if(!oUl.is(":animated")){
						clearTimeout(timer);
						oUl.find("li:last").clone().prependTo(oUl);
						oUl.css("left","-" + oLiWid + "px");
						oUl.animate({"left":"+=" + oLiWid + "px"},1000);
						oUl.find("li:last").remove();
						
						timer = setTimeout(nextLeft,3000);
					};
				};
				
				function nextLeft(){
					if(!oUl.is(":animated")){
						clearTimeout(timer);
						oUl.animate({"left":"-=" + oLiWid + "px"},1000,function(){
							$(this).css("left","0px").find("li:first").appendTo($(this));
							//if(oLiWid>$(".scrollBox ul li:eq(0)").width()*$(".scrollBox ul li").size()){}
						});
						timer = setTimeout(nextLeft,3000);
					};
				};
				
				leB.click(function(){
					prevLeft();
				});
				
				riB.click(function(){
					nextLeft();
				});
				
				timer = setTimeout(nextLeft,3000);
				$(".scrollBox,.prev,.next").hover(function(){
					clearTimeout(timer);
				},function(){
					timer = setTimeout(nextLeft,3000);
				});
		}
					
		scroll_manage();
		
		
		function scroll_realE(){
				var oUl = $(".constructionProjectsImg");
				var oLiWid = $(".constructionProjectsImg li:eq(0)").width();
				var timer = null;
				var leB = $(".constructionProjectsPrev");
				var riB = $(".constructionProjectsNext");
				if(oUl.find("li").size() < 2){return false};
				
				function prevLeft(){
					if(!oUl.is(":animated")){
						oUl.find("li:last").clone().prependTo(oUl);
						oUl.css("left","-" + oLiWid + "px");
						oUl.animate({"left":"+=" + oLiWid + "px"},1000);
						oUl.find("li:last").remove();
					};
				};
				
				function nextLeft(){
					if(!oUl.is(":animated")){
						clearTimeout(timer);
						oUl.animate({"left":"-=" + oLiWid + "px"},1000,function(){
							$(this).css("left","0px").find("li:first").appendTo($(this));
						});
					};
				};
				
				leB.click(function(){
					prevLeft();
					var n=$(".constructionProjectsImg li:eq(0)").attr("date-num")
					var i=$(".constructionProjectsImg li:eq(0)").attr("date-val")
					$(".pageNem i").html(n);
					$(".constructionProjects .right .cp_con").eq(i).css("top","0").siblings(".cp_con").css("top","400px");
				});
				
				riB.click(function(){
					nextLeft();
					var n=$(".constructionProjectsImg li:eq(1)").attr("date-num")
					var i=$(".constructionProjectsImg li:eq(1)").attr("date-val")
					$(".pageNem i").html(n);
					$(".constructionProjects .right .cp_con").eq(i).css("top","0").siblings(".cp_con").css("top","400px");
				});
		}
		$(".constructionProjects .right .cp_con:first").css("top","0")
		scroll_realE();
		$(".pageNem span").html($(".constructionProjectsImg li").size())
		
		
		function scroll_property(){
				var oUl = $(".picBox ul");
				var oLiWid = $(".picBox ul li:eq(0)").width();
				var timer = null;
				var leB = $(".propertyPrev");
				var riB = $(".propertyNext");
				if(oUl.find("li").size() < 2){return false};
				
				function prevLeft(){
					if(!oUl.is(":animated")){
						oUl.find("li:last").clone().prependTo(oUl);
						oUl.css("left","-" + oLiWid + "px");
						oUl.animate({"left":"+=" + oLiWid + "px"},1000);
						oUl.find("li:last").remove();
					};
				};
				
				function nextLeft(){
					if(!oUl.is(":animated")){
						clearTimeout(timer);
						oUl.animate({"left":"-=" + oLiWid + "px"},1000,function(){
							$(this).css("left","0px").find("li:first").appendTo($(this));
						});
					};
				};
				
				leB.click(function(){
					prevLeft();
				});
				
				riB.click(function(){
					nextLeft();
				});
		}
		scroll_property();
		
		
		$(".honor_part a.part2_arrow_l").addClass("on")
		
		function in_product() {
		
			var count = 1;
			var allCount = $(".ab_part2 ul li").size();
			if(allCount > 1) {
				$(".ab_part2 ul li:eq(0)").css({ "left": 0, "width": 251, "height": 141 }).show();
				$(".ab_part2 ul li:eq(1)").css({ "left": 96, "width": 326, "height": 205 }).show();
				$(".ab_part2 ul li:eq(2)").css({ "left": 263, "width": 251, "height": 141 }).show();
				$(".ab_part2 ul li:eq(1)").find(".inPart2Wrap > a").attr("href", $(".ab_part2 ul li:eq(1)").find(".inPart2Wrap > a").attr("rel"));
				$(".ab_part2 ul li:eq(1)").find(".inPartArr").show();
				$(".ab_honor_text_part").eq(1).show();
			} else {
				$(".ab_part2 ul li:eq(0)").css({ "left": 96, "width": 326, "height": 205 }).show();
				$(".ab_honor_text_part").eq(0).show();
				$(".ab_part2 > a").hide();
			}
		
			try {
				var activeRule = {
					width: 326,
					height: 205,
					left: $(".ab_part2 ul li:eq(1)").position().left,
					top: $(".ab_part2 ul li:eq(1)").position().top
		
				}
				var activeRule_prev = {
					width: 251,
					height: 141,
					left: $(".ab_part2 ul li:eq(0)").position().left,
					top: $(".ab_part2 ul li:eq(0)").position().top
				}
				/*var activeRule_next = {
					width: 162,
					height: 110,
					left: $(".ab_part2 ul li:eq(2)").position().left,
					top: $(".ab_part2 ul li:eq(2)").position().top
				}*/
				var activeRule_next = {
					width: 251,
					height: 141,
					left: 263,
					top: 33
				}
			} catch (e) { }
		
			$(".news_listMedia ul").width($(".news_listMedia ul li").size() * 227);
		
			$("a.part2_arrow_l").click(function () {
				if (!$(".ab_part2 ul li").is(":animated")) {
					if (count <= 0) {
						$(".ab_part2 a.part2_arrow_l").hide()
						return false;
					} else {
						count--;
						$(".ab_part2 a.part2_arrow_r").show();
						//alert(count)
						$(".ab_part2 ul li:eq(" + count + ")").find(".inPart2Wrap > a").attr("href", $(".ab_part2 ul li:eq(" + count + ")").find(".inPart2Wrap > a").attr("rel"));
						$(".ab_part2 ul li:eq(" + count + ")").siblings().find(".inPart2Wrap > a").attr("href", "javascript:void(0)");
						$(".ab_part2 ul li:eq(" + count + ")").siblings().css("zIndex", 1);
						$(".ab_part2 ul li:eq(" + count + ")").find("p").css("display","block");
						$(".ab_part2 ul li:eq(" + count + ")").siblings().find("p").css("display","none");
						$(".ab_part2 ul li:eq(" + count + ")").find(".inPartArr").show();
						$(".ab_part2 ul li:eq(" + count + ")").siblings().find(".inPartArr").hide();
						$(".ab_part2 ul li:eq(" + (count) + ")").css({ "zIndex": 3 });
						$(".ab_part2 ul li:eq(" + (count + 1) + ")").css({ "zIndex": 2 });
						$(".ab_honor_text_part").eq(count).show().siblings().hide();
		
						if (count - 1 < 0) {
							//alert(1);
						} else {
							$(".ab_part2 ul li:eq(" + (count - 1) + ")").find(".inPart2Shadow").css("bottom", -36);
							$(".ab_part2 ul li:eq(" + (count - 1) + ")").show().css({ "left": -$(".ab_part2 ul li:eq(0)").width(), "zIndex": 2 });
							$(".ab_part2 ul li:eq(" + (count - 1) + ")").animate({ "width": activeRule_prev.width, "height": activeRule_prev.height, "left": activeRule_prev.left, "top": activeRule_prev.top });
							//$(".ab_part2 a.part2_arrow_l").hide();
						}
						$(".ab_part2 ul li:eq(" + (count + 1) + ")").animate({ "width": activeRule_next.width, "height": activeRule_next.height, "left": activeRule_next.left, "top": activeRule_next.top });
						$(".ab_part2 ul li:eq(" + (count + 2) + ")").animate({ "width": activeRule_prev.width, "height": activeRule_prev.height, "left": $(".ab_part2 ul").width(), "top": activeRule_prev.top });
						$(".ab_part2 ul li:eq(" + (count) + ")").animate({ "width": activeRule.width, "height": activeRule.height, "left": activeRule.left, "top": activeRule.top });
						
						$(".ab_part2 ul li:eq(" + (count) + ")").find(".inPart2Wrap").animate({"width":326,"height":183})
						$(".ab_part2 ul li:eq(" + (count) + ")").siblings().find(".inPart2Wrap").animate({"width":251,"height":141});
						
		
					}
				}
				//alert($(".ab_part2 ul li:first").width())
				//if($(".ab_part2 ul li:first").width()=326){$(this).hide()}else{}
			})
			$("a.part2_arrow_r").click(function () {
				if (!$(".ab_part2 ul li").is(":animated")) {
					if (count >= allCount - 1) {
						$(".ab_part2 a.part2_arrow_r").hide()
						return false;
					} else {
						$(".ab_part2 a.part2_arrow_l").show()
						count++;
						$(".ab_part2 ul li:eq(" + count + ")").find(".inPart2Wrap > a").attr("href", $(".ab_part2 ul li:eq(" + count + ")").find(".inPart2Wrap > a").attr("rel"));
						$(".ab_part2 ul li:eq(" + count + ")").siblings().find(".inPart2Wrap > a").attr("href", "javascript:void(0)");
						$(".ab_part2 ul li:eq(" + count + ")").siblings().css("zIndex", 1);
						$(".ab_part2 ul li:eq(" + count + ")").find(".inPartArr").show();
						$(".ab_part2 ul li:eq(" + count + ")").find("p").css("display","block");
						$(".ab_part2 ul li:eq(" + count + ")").siblings().find("p").css("display","none");
						$(".ab_part2 ul li:eq(" + count + ")").siblings().find(".inPartArr").hide();
						$(".ab_part2 ul li:eq(" + (count) + ")").css({ "zIndex": 3 });
						$(".ab_part2 ul li:eq(" + (count - 1) + ")").css({ "zIndex": 2 });
						$(".ab_part2 ul li:eq(" + (count + 1) + ")").show().css({ "left": $(".ab_part2 ul").width(), "zIndex": 2 });
						$(".ab_part2 ul li:eq(" + (count - 1) + ")").animate({ "width": activeRule_prev.width, "height": activeRule_prev.height, "left": activeRule_prev.left, "top": activeRule_prev.top });
						$(".ab_part2 ul li:eq(" + (count + 1) + ")").animate({ "width": activeRule_next.width, "height": activeRule_next.height, "left": activeRule_next.left, "top": activeRule_next.top });
						$(".ab_honor_text_part").eq(count).show().siblings().hide();
						if (count - 2 < 0) {
							//alert(0)
						} else {
							$(".ab_part2 ul li:eq(" + (count - 2) + ")").animate({ "width": activeRule_prev.width, "height": activeRule_prev.height, "left": -$(".ab_part2 ul li:eq(0)").width() - 10, "top": activeRule_prev.top });
						}
						$(".ab_part2 ul li:eq(" + count + ")").animate({ "width": activeRule.width, "height": activeRule.height, "left": activeRule.left, "top": activeRule.top });
						
						$(".ab_part2 ul li:eq(" + (count) + ")").find(".inPart2Wrap").animate({"width":326,"height":183})
						$(".ab_part2 ul li:eq(" + (count) + ")").siblings().find(".inPart2Wrap").animate({"width":251,"height":141});
		
					}
				}
				
				
			})
		}
		in_product();
		
		
		
		
		
		
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


//内容区 字体字号 s
$(document).ready(function(){
	$('.font_size a').click(function () {
        var index = jQuery(this).index();
        jQuery(this).addClass('on').siblings().removeClass('on');
        if (index == 0) {
            $('.conts').css('font-size', '12px');
			$('.conts').css('line-height', '24px');
			
        }
        else if (index == 1) {
            $('.conts').css('font-size', '14px');
			$('.conts').css('line-height', '26px');
			
        }
        else {
            $('.conts').css('font-size', '16px');
			$('.conts').css('line-height', '28px');
			
        }
    })
})

$(function(){
	$(".nav ul li:last").css("background","none")
	//$(".zr_content li:last").css("margin","0")
	$(".leadership_l ul li:first").addClass("first")
	$(".management_wrap:odd").css("margin","0")
})


$(function(){
	var lis=$(".swdt_left li").size();
	var ind=0;
	var timer=null;
	for(i=0 ; i<lis ; i++){
		$(".swdt_btn").append("<span></span>")
	}
	$(".swdt_btn span:first").addClass("on")
	function move(index){
		$(".swdt_left li").eq(index).fadeIn().siblings().fadeOut();
		$(".swdt_btn span").eq(index).addClass("on").siblings().removeClass("on");
	}
	timer=setInterval(function(){
		ind++;
		if(ind>=lis){
			ind=0;
		}
		move(ind);
	},6000)
	$(".swdt_btn span").click(function(){
		clearInterval(timer);
		var nIndex=$(".swdt_btn span").index(this);
		//alert(nIndex)
		$(".swdt_left li").eq(nIndex).fadeIn().siblings().fadeOut();
		$(".swdt_btn span").eq(nIndex).addClass("on").siblings().removeClass("on");
		ind=nIndex;
		timer=setInterval(function(){
			ind++;
			if(ind>=lis){
				ind=0;
			}
			move(ind);
			
		},6000)
	})
})

$(function(){
	var lis=$(".swj_banner li").size();
	var ind=0;
	var timer=null;
	for(i=0 ; i<lis ; i++){
		$(".swjb_btn").append("<span></span>")
	}
	$(".swjb_btn span:first").addClass("on")
	function move(index){
		$(".swj_banner li").eq(index).fadeIn().siblings().fadeOut();
		$(".swjb_btn span").eq(index).addClass("on").siblings().removeClass("on");
	}
	timer=setInterval(function(){
		ind++;
		if(ind>=lis){
			ind=0;
		}
		move(ind);
	},6000)
	$(".swjb_btn span").click(function(){
		clearInterval(timer);
		var nIndex=$(".swjb_btn span").index(this);
		//alert(nIndex)
		$(".swj_banner li").eq(nIndex).fadeIn().siblings().fadeOut();
		$(".swjb_btn span").eq(nIndex).addClass("on").siblings().removeClass("on");
		ind=nIndex;
		timer=setInterval(function(){
			ind++;
			if(ind>=lis){
				ind=0;
			}
			move(ind);
		},6000)
	})
})

$(function(){
	$(".bt_btn li:last").css("margin","0 0 0 1px");
	$(".bt_btn li").hover(function(){
		
	})
})
function errpic(t){
		t.src="../images/error.jpg"
	}
	$(document).ready(function(){
		$("img").each(function(){
		if($(this).attr("src").replace(/(\s)*/gi , "")==""){
		$(this).attr("src", "../images/error.jpg"); 
		}
	})
});