$(document).ready(function () {
	var $change_btn = $("#nav .content ul.menu li.last_menu>ul.one li");
	var $view_L_li = $("#main .container_new .news_events .news .news_right ul>li");
	var $view_R_img = $("#main .container_new .news_events .news .news_left a .img");
	var $body = $("body");
	var $info_part_item_d= $(".info_part-item-d")
	var $info1point4= $("#main .content .first_info .subtitle")
	var $info1point3= $("#main .content .ontology_ul ul li .text")
	var $download= $("#main .content .download_white_paper p.text")
	var $morepostion = $("#nav .content ul.menu .two")
	var $topnav = $("#nav .content ul.menu li a")
	var $mobiletopnav = $("#mobile_nav ul.menu>li>a")
	var $topnavlang = $("#nav .content ul.menu li span")
	var $nokoreanlang = $(".nokoreanlang")
	var $koreanlang = $(".koreanlang")
	var $banner = $("#banner")
	var $letter = $("#letter")
	var $Triones = $("#Triones")
	var $ONTO = $("#ONTO")
	var $GlobalMeet = $("#GlobalMeet")
	var $sticker = $("#sticker")
	var $hackathon = $("#hackathon")
	var $Triones2 = $("#Triones2")

	var $letterbtn = $(".letterbtn")
	var $Trionesbtn = $(".Trionesbtn")
	var $ONTObtn = $(".ONTObtn")
	var $GlobalMeetbtn = $(".GlobalMeetbtn")
	var $stickerbtn = $(".stickerbtn")
	var $hackathonbtn = $(".hackathonbtn")
	var $Triones2btn = $(".Triones2btn")

	var $letterbtnbtn = $(".letterbtnbtn")
	var $Trionesbtnbtn = $(".Trionesbtnbtn")
	var $ONTObtnbtn = $(".ONTObtnbtn")
	var $GlobalMeetbtnbtn = $(".GlobalMeetbtnbtn")
	var $stickerbtnbtn = $(".stickerbtnbtn")
	var $hackathonbtnbtn = $(".hackathonbtnbtn")
	var $Triones2btnbtn = $(".Triones2btnbtn")

	var $dotletter = $("#dotletter")
	var $dotTriones = $("#dotTriones")
	var $dotONTO = $("#dotONTO")
	var $dotGlobalMeet = $("#dotGlobalMeet")
	var $dotsticker = $("#dotsticker")
	var $dothackathon = $("#dothackathon")
	var $dotTriones2 = $("#dotTriones2")
	init();
	
	var timer = 0;
	bannerstart();

	$change_btn.click(function(){
		if($(this).index()==0){ // 英文
			eninit()
		}else{ // 中文
			if($(this).index()==1){
				cninit()
			}else{// 韩文
				if($(this).index()==2){
					koinit()
				}else{//日文
					jpinit()
				}
			}
		}
	});
	function init(){
		var key=getCookie("lang");
		if(key=="cn" || key=="zh" ){
			cninit()
		}else{
			if(key=="ko" ){
			   koinit()
			}else{
				if(key=="jp" ){
					jpinit()
				 }else{
					eninit()
				 }
			}
		}
	}
	var flag =5
	function bannerstart(){
		timer = setInterval(function(){
			changeBanner()
		},10000)
	}
	function bannerstop(){
		clearInterval(timer);
	}
	$dotletter.click(function(){
		bannerstop()
		flag = 0
		flag++
		changeBanner()
		bannerstart()
	});
	$dotONTO.click(function(){
		bannerstop()
		flag = 1
		flag++
		changeBanner()
		bannerstart()
	});
	$dotTriones.click(function(){
		bannerstop()
		flag = 2
		flag++
		changeBanner()
		bannerstart()
	});
	$dotGlobalMeet.click(function(){
		bannerstop()
		flag = 3
		flag++
		changeBanner()
		bannerstart()
	});
/* 	$dotsticker.click(function(){
		debugger
		bannerstop()
		flag = 4
		flag++
		changeBanner()
		bannerstart()
	}); */
	$dothackathon.click(function(){
		bannerstop()
		flag = 4
		flag++
		changeBanner()
		bannerstart()
	});
	$dotTriones2.click(function(){
		bannerstop()
		flag = 5
		flag++
		changeBanner()
		bannerstart()
	});
	function changeBanner(){
        var displaylist=[false,false,false,false,false,false]

		if(flag > 0){
			flag--
		}else{
			flag = 5
		}
		displaylist[flag]=true;
		bannerswitch(displaylist)
	}
	function bannerswitch($displaylist){
		letterswitch($displaylist[0])
		ONTOswitch($displaylist[1])
		Trionesswitch($displaylist[2])
		GlobalMeetswitch($displaylist[3])
/* 		stickerswitch($displaylist[4]) */
		hackathonswitch($displaylist[4])
		Triones2switch($displaylist[5])
	}
	function toletter(){
		$banner.css("background",'#000 url("../images/index/banner_bg.png")no-repeat center')

	}
	function toTriones(){
		$banner.css("background",'#000 url("../images/index/homepage_bg 8bit.png")no-repeat center')

	}
	function toONTO(){
		$banner.css("background",'#000 url("../images/index/ontoapp.png")no-repeat center')


	}
	function toGlobalMeet(){
		$banner.css("background",'#000 url("../images/index/banner_Ontology master schedule1.png")no-repeat center')
		
	}
	function tosticker(){
		$banner.css("background",'#000 url("../images/index/stickerbanner-02.png")no-repeat ')
		$banner.css("background-position-x",'center')

	
	}
	function tohackathon(){
		$banner.css("background",'#000 url("../images/index/hackathon_global.png")no-repeat center')
		
	}
	function letterswitch($display){

        if($display){
			$banner.css("background",'#000 url("../images/index/banner_bg.png")no-repeat center')
			$letter.css("display",'block')
			$letterbtn.css("display",'block')
			$letterbtnbtn.css("display",'flex')
			$dotletter.css("background-color","#32a4be")	
		}else{
			$letter.css("display",'none')
			$letterbtn.css("display",'none')
			$letterbtnbtn.css("display",'none')
			$dotletter.css("background-color","white")	
		}
	}
	function Trionesswitch($display){
        if($display){
			$banner.css("background",'#000 url("../images/index/homepage_bg 8bit.png")no-repeat center')
			$Triones.css("display",'block')
			$Trionesbtn.css("display",'block')
			$Trionesbtnbtn.css("display",'flex')
			$dotTriones.css("background-color","#32a4be")	
		}else{
			$Triones.css("display",'none')
			$Trionesbtn.css("display",'none')
			$Trionesbtnbtn.css("display",'none')
			$dotTriones.css("background-color","white")	
		}
	}
	function Triones2switch($display){
        if($display){
			$banner.css("background",'#000 url("../images/index/节点地图.png")no-repeat center')
			$Triones2.css("display",'block')
			$Triones2btn.css("display",'block')
			$Triones2btnbtn.css("display",'flex')
			$dotTriones2.css("background-color","#32a4be")	
		}else{
			$Triones2.css("display",'none')
			$Triones2btn.css("display",'none')
			$Triones2btnbtn.css("display",'none')
			$dotTriones2.css("background-color","white")	
		}
	}
	function ONTOswitch($display){
        if($display){
			$banner.css("background",'#000 url("../images/index/ontoapp.png")no-repeat center')
			$ONTO.css("display",'block')
			$ONTObtn.css("display",'block')
			$ONTObtnbtn.css("display",'flex')
			$dotONTO.css("background-color","#32a4be")	
		}else{
			$ONTO.css("display",'none')
			$ONTObtn.css("display",'none')
			$ONTObtnbtn.css("display",'none')
			$dotONTO.css("background-color","white")	
		}
	}
	function GlobalMeetswitch($display){
        if($display){
			$banner.css("background",'#000 url("../images/index/banner_Ontology master schedule1.png")no-repeat center')
			$GlobalMeet.css("display",'block')
			$GlobalMeetbtn.css("display",'block')
			$GlobalMeetbtnbtn.css("display",'flex')
			$dotGlobalMeet.css("background-color","#32a4be")	
		}else{
			$GlobalMeet.css("display",'none')
			$GlobalMeetbtn.css("display",'none')
			$GlobalMeetbtnbtn.css("display",'none')
			$dotGlobalMeet.css("background-color","white")	
		}
	}
	function stickerswitch($display){
        if($display){
			$banner.css("background",'#000 url("../images/index/stickerbanner-02.png")no-repeat ')
			$banner.css("background-position-x",'center')
			$sticker.css("display",'block')
			$stickerbtn.css("display",'block')
			$stickerbtnbtn.css("display",'flex')
			$dotsticker.css("background-color","#32a4be")	
		}else{
			$sticker.css("display",'none')
			$stickerbtn.css("display",'none')
			$stickerbtnbtn.css("display",'none')
			$dotsticker.css("background-color","white")	
		}
	}
	function hackathonswitch($display){
        if($display){
			$banner.css("background",'#000 url("../images/index/hackathon_global.png")no-repeat ')
			$banner.css("background-position-x",'center')
			$hackathon.css("display",'block')
			$hackathonbtn.css("display",'block')
			$hackathonbtnbtn.css("display",'flex')
			$dothackathon.css("background-color","#32a4be")	
		}else{
			$hackathon.css("display",'none')
			$hackathonbtn.css("display",'none')
			$hackathonbtnbtn.css("display",'none')
			$dothackathon.css("background-color","white")	
		}
	}
	function cninit(){
		$view_R_img.css("background","url('./images/index/view_1_cn.jpg') no-repeat center/cover");
		$view_L_li.eq(0).find('a .img').css("background","url('./images/index/view_2_cn.jpg') no-repeat center/cover");
		$view_L_li.eq(1).find('a .img').css("background","url('./images/index/view_3_cn.jpg') no-repeat center/cover");
		$body.css("font-family",'"OpenSans",sans-serif')
		$download.css("font-family",'SourceHanSansCN-ExtraLight')
		$info_part_item_d.css("line-height",1.3)
		$info1point4.css("line-height",1.4)
		$info1point3.css("line-height",1.3)
		$morepostion.css("left","-88%")
		$topnav.css("font-family",'"OpenSans",sans-serif')
		$mobiletopnav.css("font-family",'sans-serif')
		$topnavlang.css("font-family",'"OpenSans",sans-serif')
		$nokoreanlang.css("font-family",'"OpenSans",sans-serif')
		$koreanlang.css("font-family",'"NanumSquareR","OpenSans",sans-serif')
	}
	function eninit(){
        $view_R_img.css("background","url('./images/index/view_1_en.jpg') no-repeat center/cover");
        $view_L_li.eq(0).find('a .img').css("background","url('./images/index/view_2_en.jpg') no-repeat center/cover");
		$view_L_li.eq(1).find('a .img').css("background","url('./images/index/view_3_en.jpg') no-repeat center/cover");
		$body.css("font-family"," 'OpenSans',sans-serif")
		$download.css("font-family",'SourceHanSansCN-ExtraLight')
		$info_part_item_d.css("line-height",1.3)
		$info1point4.css("line-height",1.4)
		$info1point3.css("line-height",1.3)
		$morepostion.css("left","-73%")
		$topnav.css("font-family",'"OpenSans",sans-serif')
		$mobiletopnav.css("font-family",'sans-serif')
		$topnavlang.css("font-family",'"OpenSans",sans-serif')
		$nokoreanlang.css("font-family",'"OpenSans",sans-serif')
		$koreanlang.css("font-family",'"NanumSquareR","OpenSans",sans-serif')
	}
	function koinit(){
        $view_R_img.css("background","url('./images/index/view_1_en.jpg') no-repeat center/cover");
        $view_L_li.eq(0).find('a .img').css("background","url('./images/index/view_2_en.jpg') no-repeat center/cover");
        $view_L_li.eq(1).find('a .img').css("background","url('./images/index/view_3_en.jpg') no-repeat center/cover");
		$body.css("font-family",'"NanumSquareR","OpenSans",sans-serif')
		$download.css("font-family",'"NanumSquareR","OpenSans",sans-serif')
		$info_part_item_d.css("line-height",1.5)
		$info1point4.css("line-height",1.5)
		$info1point3.css("line-height",1.5)
		$morepostion.css("left","-51%")
		$topnav.css("font-family",'"NanumSquareR","OpenSans",sans-serif')
		$mobiletopnav.css("font-family",'"NanumSquareR","OpenSans",sans-serif')
		$topnavlang.css("font-family",'"NanumSquareR","OpenSans",sans-serif')
		$nokoreanlang.css("font-family",'"OpenSans",sans-serif')
		$koreanlang.css("font-family",'"NanumSquareR","OpenSans",sans-serif')
	}
	function jpinit(){
        $view_R_img.css("background","url('./images/index/view_1_en.jpg') no-repeat center/cover");
        $view_L_li.eq(0).find('a .img').css("background","url('./images/index/view_2_en.jpg') no-repeat center/cover");
        $view_L_li.eq(1).find('a .img').css("background","url('./images/index/view_3_en.jpg') no-repeat center/cover");
		$body.css("font-family",'"OpenSans",sans-serif')
		$download.css("font-family",'"OpenSans",sans-serif')
		$info_part_item_d.css("line-height",1.5)
		$info1point4.css("line-height",1.5)
		$info1point3.css("line-height",1.5)
		$morepostion.css("left","-51%")
		$topnav.css("font-family",'"OpenSans",sans-serif')
		$mobiletopnav.css("font-family",'"OpenSans",sans-serif')
		$topnavlang.css("font-family",'"OpenSans",sans-serif')
		$nokoreanlang.css("font-family",'"OpenSans",sans-serif')
		$koreanlang.css("font-family",'"NanumSquareR","OpenSans",sans-serif')
	}
    function getCookie(name){
        var strcookie=document.cookie;
        var arrcookie=strcookie.split("; ");
        for(var i=0;i<arrcookie.length;i++){
            var arr=arrcookie[i].split("=");
            if(arr[0]==name && arr[1]!='undefined' && arr[1]!='null'){
                return unescape(arr[1]);
            }
        }
        return null;
    }
/* 	$("#d14T").hover(function(){
		$("#d14D").css("display","block");
		},function(){
		$("#d14D").css("display","none");
	});
	$("#d16T").hover(function(){
		$("#d16D").css("display","block");
		},function(){
		$("#d16D").css("display","none");
	});
	$("#d18T").hover(function(){
		$("#d18D").css("display","block");
		},function(){
		$("#d18D").css("display","none");
	});

	$("#d21T").hover(function(){
		$("#d21D").css("display","block");
		},function(){
		$("#d21D").css("display","none");
	});
	$("#d34T").hover(function(){
		$("#d34D").css("display","block");
		},function(){
		$("#d34D").css("display","none");
	});
	$("#d36T").hover(function(){
		$("#d36D").css("display","block");
		},function(){
		$("#d36D").css("display","none");
	});

	$("#d39T").hover(function(){
		$("#d39D").css("display","block");
		},function(){
		$("#d39D").css("display","none");
	});
	$("#d41T").hover(function(){
		$("#d41D").css("display","block");
		},function(){
		$("#d41D").css("display","none");
	});
	$("#d43T").hover(function(){
		$("#d43D").css("display","block");
		},function(){
		$("#d43D").css("display","none");
	}); */

});