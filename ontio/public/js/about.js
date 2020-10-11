$(document).ready(function () {
  var $change_btn = $("#nav .content ul.menu li.last_menu>ul.one li");
  var $body = $("body");
  var $info_part_item_d = $(".info_part-item-d")
  var $info1point4 = $("#main .content .first_info .subtitle")
  var $info1point3 = $("#main .content .ontology_ul ul li .text")
  var $download = $("#main .content .download_white_paper p.text")
  var $morepostion = $("#nav .content ul.menu .two")
  var $topnav = $("#nav .content ul.menu li a")
  var $mobiletopnav = $("#mobile_nav ul.menu>li>a")
  var $topnavlang = $("#nav .content ul.menu li span")
  var $nokoreanlang = $(".nokoreanlang")
  var $koreanlang = $(".koreanlang")
  init();

  $change_btn.click(function () {
    if ($(this).index() == 0) { // 英文
      eninit()
    } else { // 中文
      if ($(this).index() == 1) {
        cninit()
      } else {// 韩文
        if ($(this).index() == 2) {
          koinit()
        } else {// 韩文
          eninit()
        }
      }
    }
    console.log($(this).index() == 0)
  });

  function init() {
    var key = getCookie("lang");
    if (key == "cn" || key == "zh") {
      cninit()
    } else {
      if (key == "ko") {
        koinit()
      } else {
        eninit()
      }
    }
    console.log(key)
  }

  function cninit() {
    $body.css("font-family", '"OpenSans",sans-serif')
    $download.css("font-family", 'SourceHanSansCN-ExtraLight')
    $info_part_item_d.css("line-height", 1.3)
    $info1point4.css("line-height", 1.4)
    $info1point3.css("line-height", 1.3)
    $morepostion.css("left", "-88%")
    $topnav.css("font-family", '"OpenSans",sans-serif')
    $mobiletopnav.css("font-family", 'sans-serif')
    $topnavlang.css("font-family", '"OpenSans",sans-serif')
    $nokoreanlang.css("font-family", '"OpenSans",sans-serif')
    $koreanlang.css("font-family", '"NanumSquareR","OpenSans",sans-serif')
  }

  function eninit() {
    $body.css("font-family", '"OpenSans	,sans-serif')
    $download.css("font-family", 'SourceHanSansCN-ExtraLight')
    $info_part_item_d.css("line-height", 1.3)
    $info1point4.css("line-height", 1.4)
    $info1point3.css("line-height", 1.3)
    $morepostion.css("left", "-73%")
    $topnav.css("font-family", '"OpenSans",sans-serif')
    $mobiletopnav.css("font-family", 'sans-serif')
    $topnavlang.css("font-family", '"OpenSans",sans-serif')
    $nokoreanlang.css("font-family", '"OpenSans",sans-serif')
    $koreanlang.css("font-family", '"NanumSquareR","OpenSans",sans-serif')
  }

  function koinit() {
    $body.css("font-family", '"NanumSquareR","OpenSans",sans-serif')
    $download.css("font-family", '"NanumSquareR","OpenSans",sans-serif')
    $info_part_item_d.css("line-height", 1.5)
    $info1point4.css("line-height", 1.5)
    $info1point3.css("line-height", 1.5)
    $morepostion.css("left", "-51%")
    $topnav.css("font-family", '"NanumSquareR","OpenSans",sans-serif')
    $mobiletopnav.css("font-family", '"NanumSquareR","OpenSans",sans-serif')
    $topnavlang.css("font-family", '"NanumSquareR","OpenSans",sans-serif')
    $nokoreanlang.css("font-family", '"OpenSans",sans-serif')
    $koreanlang.css("font-family", '"NanumSquareR","OpenSans",sans-serif')
  }

  function getCookie(name) {
    var strcookie = document.cookie;
    var arrcookie = strcookie.split("; ");
    for (var i = 0; i < arrcookie.length; i++) {
      var arr = arrcookie[i].split("=");
      if (arr[0] == name && arr[1] != 'undefined' && arr[1] != 'null') {
        return unescape(arr[1]);
      }
    }
    return null;
  }
});
