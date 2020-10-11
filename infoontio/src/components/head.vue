<template>
  <div id="top">
    <nav id="head-navbar" class="navbar navbar-inverse navbar-fixed-top" style="width:100vw" >
        <div id="nav_container" class="content-container container-head">
		    <div class="navbar-header">
                <div id="logo_div" class="pull-left">
                    <a   @click="toHome()">
                        <img id="logoimg" class="head-logo" src="../assets/images/footerlogolight.png" />
                    </a>
			    </div>
				<button id="togglebutton" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="border:0px;">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
			<div id="collapse" class="mobile-collapse collapse navbar-collapse" aria-expanded="false" style="height: 0px;" >
                <ul id="menu_list" class="nav navbar-nav pull-right pop-menu t2-head head-font nav-stacked nav-ul">
                    <li class="menu-item menu-item-bottom"><a class="nav-ul-item-a" asp-area="" asp-controller="home" asp-action="index" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' "  @click="toHome()">{{head.home}}</a></li>
                    <li class="menu-item menu-item-bottom"><a class="nav-ul-item-a" asp-area="" asp-controller="home" asp-action="index" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " href="https://developer.ont.io/">{{head.develop}}</a></li>
                    <li class="menu-item menu-item-bottom"><a class="nav-ul-item-a" asp-area="" asp-controller="home" asp-action="index" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " href="https://bounty.ont.io/index.php/index/index">{{head.bounty}}</a></li>
                    <li class="menu-item menu-item-bottom"><a class="nav-ul-item-a" asp-area="" asp-controller="home" asp-action="index" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " @click="toTrust($route.params.lang)">{{head.trust}}</a></li>
                    <li class="menu-item menu-item-bottom"><a class="nav-ul-item-a" asp-area="" asp-controller="home"  asp-action="index" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " @click="toNode($route.params.lang)">{{head.node}}</a></li>
                    <li class="menu-item menu-item-bottom"><a class="nav-ul-item-a" asp-area="" asp-controller="home" asp-action="index" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' "  href="https://dapp.ont.io/" target="_blank">{{head.dapps}}</a></li>
                    <li class="menu-item menu-item-bottom"><a class="nav-ul-item-a" asp-area="" asp-controller="home" asp-action="index" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " href="https://explorer.ont.io/" target="_blank">{{head.explorer}}</a></li>
<!--                     <li class="menu-item menu-item-bottom"><a class="nav-ul-item-a" asp-area="" asp-controller="home"  asp-action="index" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " @click="toCooperation($route.params.lang)">{{head.cooperation}}</a></li> -->
                    <li class="menu-item menu-item-bottom nav-mobile-display"><a class="nav-ul-item-a" asp-area="" asp-controller="home" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " asp-action="index"  @click="toNews($route.params.lang)"  >{{head.News}}</a></li>
                    <li class="menu-item menu-item-bottom nav-mobile-display"><a class="nav-ul-item-a" asp-area="" asp-controller="home" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " asp-action="index"  @click="toontView($route.params.lang)" >{{head.ontView}}</a></li>
                    <li class="menu-item menu-item-bottom nav-mobile-display"><a class="nav-ul-item-a" asp-area="" asp-controller="home"  asp-action="index"  @click="toteam($route.params.lang)"  >{{head.team}}</a></li>
                    <li class="menu-item menu-item-bottom nav-mobile-display"><a class="nav-ul-item-a" asp-area="" asp-controller="home" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " asp-action="index"  href="https://ont.io/about"  >{{head.aboutus}}</a></li>
                    <li role="presentation " class="nav-pc-display dropdown" style="font-weight: 100;">
                        <a class="dropdown-toggle nav-ul-item-a" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' ">
                        {{head.documents}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-back" style="font-weight: 100;">
                           <li class="nav-ul-li"><a class=" nav-ul-a "style="font-weight: 100;" @click="toCooperation($route.params.lang)" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " >{{head.cooperation}}</a></li>
                           <li class="nav-ul-li"><a class=" nav-ul-a "style="font-weight: 100;" @click="toNews($route.params.lang)" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " >{{head.News}}</a></li>
                           <li class="nav-ul-li"><a class=" nav-ul-a " style="font-weight: 100;"@click="toontView($route.params.lang)" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' ">{{head.ontView}}</a></li>
                           <li class="nav-ul-li"><a class=" nav-ul-a " style="font-weight: 100;"@click="toteam($route.params.lang)"  >{{head.team}}</a></li>
                           <li class="nav-ul-li"><a class=" nav-ul-a " style="font-weight: 100;"href="https://ont.io/about" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' " >{{head.aboutus}}</a></li>
                           <div class="arrow_down"></div>
                        </ul>
                    </li>
                    <li role="presentation" class=" menu-item menu-item-bottom nav-mobile-display dropdown">
                        <a style="font-weight: 500;" class="dropdown-toggle head-font-EN nav-ul-item-a" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' ">
                          Language
                        </a>
                        <ul class="dropdown-menu dropdown-menu-back-lag">
                            <li class="menu-item " ><a class="head-font-EN mobile-lang font_nokorean" style="font-weight: 100;"  asp-area="" asp-controller="blog" asp-action="index" @click="toEnglish" >{{head.En}}</a></li>
                            <li class="menu-item "  ><a class="mobile-lang font_nokorean" style="font-weight: 100;"asp-area="" asp-controller="download" asp-action="index" @click="toChinese" >{{head.zh}}</a></li>
                            <li class="menu-item "  ><a class="mobile-lang font_korean" style="font-weight: 100;"asp-area="" asp-controller="download" asp-action="index" @click="toKorean" >{{head.ko}}</a></li>
                            <li class="menu-item "  ><a class="mobile-lang font_nokorean" style="font-weight: 100;"asp-area="" asp-controller="download" asp-action="index" @click="toJapanese" >{{head.jp}}</a></li>
                        </ul>
                    </li>
                    <li role="presentation" class=" nav-pc-display dropdown">
                        <a class="dropdown-toggle head-font-EN " style="padding:14px 12px;" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                          <img style="height:22px;margin-right:12px;" src="/static/img/languagebai.png" /><span style="padding:0 20px 0 0 " :class="$route.params.lang=='ko'?'font_korean':'font_nokorean' ">{{head.languagenow}}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-back-lag">
                            <li class="menu-item nav-ul-li" ><a class="head-font-EN nav-ul-a-lag font_nokorean" style="text-align:center;font-weight: 100;" asp-area="" asp-controller="blog" asp-action="index" @click="toEnglish" >{{head.En}}</a></li>
                            <li class="menu-item nav-ul-li" ><a class=" nav-ul-a-lag font_nokorean" style="text-align:center;font-weight: 100;" asp-area="" asp-controller="download" asp-action="index" @click="toChinese">{{head.zh}}</a></li>
                            <li class="menu-item nav-ul-li" ><a class="head-font-EN nav-ul-a-lag font_korean" style="text-align:center;font-weight: 100;" asp-area="" asp-controller="blog" asp-action="index" @click="toKorean">{{head.ko}}</a></li>
                            <li class="menu-item nav-ul-li" ><a class="head-font-EN nav-ul-a-lag font_nokorean" style="text-align:center;font-weight: 100;" asp-area="" asp-controller="blog" asp-action="index" @click="toJapanese">{{head.jp}}</a></li>
                            <div class="arrow_down1 nav-pc-display"></div>
                        </ul>
                    </li>
                </ul>
			</div>
        </div>
    </nav>
<!--     <div id="mobile_nav">
        <ul class="menu">
            <li><a @click="toHome()">{{head.home}}</a></li>
            <li><a href="https://ont.io/developer" >{{head.develop}}</a></li>
            <li><a @click="toCooperation($route.params.lang)">{{head.cooperation}}</a></li>
            <li><a @click="toNews($route.params.lang)"  >{{head.News}}</a></li>
            <li><a @click="toontView($route.params.lang)" >{{head.ontView}}</a></li>
            <li><a @click="toteam($route.params.lang)"  >{{head.team}}</a></li>
            <li><a href="https://ont.io/about"  >{{head.aboutus}}</a></li>
            <li @click="openmobilelang()">
                <a >language</a>
                <ul class="lang_menu">
                    <li><a @click="toChinese">English</a></li>
                    <li><a @click="toEnglish">中文</a></li>
                </ul>
            </li>
        </ul>
    </div> -->
  </div>
</template>

<script>  
  import '../assets/ebro/css/site1.css'
  import '../assets/ebro/css/navigation.css'
  import '../assets/ebro/css/common.css'
  import '../assets/ebro/css/homepage.css'
  import Global from './Global.vue'
  import { mapGetters, mapActions } from 'vuex'
  export default {
    mounted: function() {
/*         window.addEventListener('scroll', this.navColor)
        window.addEventListener('scroll', this.closecollapse) */
        jQuery(function($) {
          $("#menu_list").bootstrapDropdownOnHover();
          $("#menu-list").bootstrapDropdownOnHover();
/*           $(".nav > li > a").click(function(){  
                 $('#collapse').addClass("collapsed");  
                 $('#collapse').attr("aria-expanded",false);  
                 $("#navbar").removeClass("in");  
                 $("#navbar").attr("aria-expanded",false);  
          });  */
        });
    },
    computed: mapGetters({
        article: 'article',
    }),
    created() {
      this.timeoutBlock = setTimeout(() => {
        var path = this.$route.path
        var path = path.substr(0,4)
        var $nav = $(".navbar-inverse");
        var $logo = $("#logoimg");
        if(path !== '/hom'){
                      $nav.css("background-color", "#000000");   
                      $logo.css("opacity", 1);   
        }
        
      },100)
      var params = this.$route.params 
      var flang = params.lang
  　　var lang = (navigator.systemLanguage?navigator.systemLanguage:navigator.language);
  　　//获取浏览器配置语言 #括号内是个运算，运算过后赋值给lang，当?前的内容为true时把?后的值赋给lang，为False时把:后的值赋给lang
  　　var lang = lang.substr(0, 2);//获取lang字符串的前两位
      if(flang != undefined){
          if(flang == "zh"){
            this.toChinese()
          }else{
            if(flang == "ko"){
              this.toKorean()
            }else{
                if(flang == "jp"){
                  this.toJapanese()
                }else{
                  this.toEnglish()
                }
            }
          }          
      }else{
        if(Global.languageFlag){
          if(Global.language == 'zh'){
            this.toChinese()
          }else{
            if(flang == "ko"){
              this.toKorean()
            }else{
                if(flang == "jp"){
                  this.toJapanese()
                }else{
                  this.toEnglish()
                }
            }
          }  
        }else{
          if(lang == 'zh'){
            this.toChinese()
            this.language = true
            Global.language = 'zh'
            Global.languageFlag = true
          }else{
            if(flang == "ko"){
              this.toKorean()
              this.language = false
              Global.language = 'ko'
              Global.languageFlag = true
            }else{
                if(flang == "jp"){
                  this.toJapanese()
                  this.language = false
                  Global.language = 'jp'
                  Global.languageFlag = true
                }else{
                  this.toEnglish()
                  this.language = false
                  Global.language = 'en'
                  Global.languageFlag = true
                }
            }
          }        
        }        
      }
    },
    watch:{

      'article':function(){
         this.language = this.article.language;
      }
    },
    methods: {
      switchmobilebtn:function () {
              if(onOff){
                  $('#mobile_nav').css({
                      'z-index': '999',
                      'opacity': '1'
                  })
              }else{
                  $('#mobile_nav').css({
                      'z-index': '-1',
                      'opacity': '0'
                  })
              }
              this.onOff = !this.onOff;
      },
      openmobilelang:function(){
              if(offOn){
                  $(this).find('ul.lang_menu').addClass('active');
                  this.children[0].style.fontFamily = 'OpenSansBold';
              }else{
                  $(this).find('ul.lang_menu').removeClass('active');
                  this.children[0].style.fontFamily = 'not specified';
              }
              this.offOn = !this.offOn;        
      },
/*           $('#mobile_nav ul.menu>li').eq(7).find('ul.lang_menu>li>a').click(function(){
              $('#mobile_nav').css({'z-index': '-1','opacity': '0'});
          }); */
      closecollapse:function(){
                 $('#collapse').addClass("collapsed");  
                 $('#collapse').attr("aria-expanded",false);  
                 $("#collapse").removeClass("in");  
                 $("#collapse").css("height", 0);     

      },
      scrollTo:function(page){
          document.getElementById(page).scrollIntoView(true); 
      },
      toHome:function(){
         /* this.$router.push({'path': '/'}) */
         window.location.href="https://ont.io/"
      },
      toExplorer:function(){
         /* this.$router.push({'path': '/'}) */
         window.open="https://explorer.ont.io/"
      },
      toDapps:function(){
         /* this.$router.push({'path': '/'}) */
         window.open="https://dapp.ont.io/"
      },
      toteam:function(lang){
         this.$router.push({'path': '/team/'+lang})
      },
      toApp:function(lang){
         this.$router.push({'path': '/application/page0/'+lang})
      },
      toTech:function(lang){
         this.$router.push({'path': '/technology/'+lang})
      },
      toCooperation:function(lang){
         this.$router.push({'path': '/cooperation/'+lang})
      },
      toNode:function(lang){
         this.$router.push({'path': '/listtriones/'+lang})
      },
      toJoin:function(lang){
         this.$router.push({'path': '/joinus/'+lang})
      },
      toNews:function(lang){
         this.$router.push({'path': '/news/'+lang})
      },
      toDev:function(lang){
         this.$router.push({'path': '/developer/'+lang})
      },
      toTrust:function(lang){
         this.$router.push({'path': '/trust-anchor/'+lang})
      },
      toontView:function(lang){
        if(lang !="zh"){
           window.open("https://medium.com/ontologynetwork/tagged/tech")
        }else{
          window.open("https://ontfans.io/?/")
        }
/*          this.$router.push({'path': '/ont-view/'+lang}) */
      },
      toBounty:function(lang){
        this.$router.push({'path': '/bounty/'+lang})
      },
      toChinese:function(){
        var path = this.$route.path
        var path = path.substr(0,4)
        this.addCookie("lang","cn");
        switch(path)
        {
          case '/':
            window.location.href="https://ont.io/"
            break;
          case '/new':
            this.$router.push({'path': '/news/zh'})
            this.$store.dispatch('NewsFileZH')
            break;
          case '/coo':
            this.$router.push({'path': '/cooperation/zh'})
            this.$store.dispatch('CooperationZH')
            break;
          case '/tea':
            this.$router.push({'path': '/team/zh'})
            this.$store.dispatch('TeamFileZH')
            break;
          case '/tri':
            this.$router.push({'path': '/trionesintro/zh'})
            this.$store.dispatch('TrionesZH')
            break;
          case '/lis':
            this.$router.push({'path': '/listtriones/zh'})
            this.$store.dispatch('TrionesListZH')
            break;
          case '/dev':
            this.$router.push({'path': '/developer/zh'})
            /* this.$store.dispatch('developerZH') */
            break;
          case '/bou':
            this.$router.push({'path': '/bounty/zh'})
            /* this.$store.dispatch('developerJP') */
            break;
          case '/ont':
            this.$router.push({'path': '/ont-view/zh'})
            this.$store.dispatch('ontViewZH')
            this.language = true;
            this.search(2)
            this.search(1)
            break;
          default:      
        }
        this.language = true
        Global.language = 'zh'
        Global.languageFlag = true
        this.head = this.headZH
        this.closecollapse();
      },
      toEnglish:function(){
        var path = this.$route.path
        var path = path.substr(0,4)
        this.addCookie("lang","en");
        switch(path)
        {
          case '/':
            window.location.href="https://ont.io/"
            break;
          case '/new':
            this.$router.push({'path': '/news/en'})
            this.$store.dispatch('NewsFileEN')
            break;
          case '/coo':
            this.$router.push({'path': '/cooperation/en'})
            this.$store.dispatch('CooperationEN')
            break;
          case '/tea':
            this.$router.push({'path': '/team/en'})
            this.$store.dispatch('TeamFileEN')
            break;
          case '/tri':
            this.$router.push({'path': '/trionesintro/en'})
            this.$store.dispatch('TrionesEN')
            break;
          case '/lis':
            this.$router.push({'path': '/listtriones/en'})
            this.$store.dispatch('TrionesListEN')
            break;
          case '/dev':
            this.$router.push({'path': '/developer/en'})
            /* this.$store.dispatch('developerEN') */
            break;
          case '/bou':
            this.$router.push({'path': '/bounty/en'})
            /* this.$store.dispatch('developerJP') */
            break;
          case '/ont':
            this.$router.push({'path': '/ont-view/en'})
            this.$store.dispatch('ontViewEN')
            this.language = false;
            this.search(2)
            this.search(1)
            break;
          default:      
        }
        this.language = false
        Global.language = 'en'
        Global.languageFlag = true
        this.head = this.headEN
        this.closecollapse();
      },
      toKorean:function(){
        var path = this.$route.path
        var path = path.substr(0,4)
        this.addCookie("lang","ko");
        switch(path)
        {
          case '/':
            window.location.href="https://ont.io/"
            break;
          case '/new':
            this.$router.push({'path': '/news/ko'})
            this.$store.dispatch('NewsFileKO')
            break;
          case '/coo':
            this.$router.push({'path': '/cooperation/ko'})
            this.$store.dispatch('CooperationKO')
            break;
          case '/tea':
            this.$router.push({'path': '/team/ko'})
            this.$store.dispatch('TeamFileKO')
            break;
          case '/tri':
            this.$router.push({'path': '/trionesintro/ko'})
            this.$store.dispatch('TrionesEN')
            break;
          case '/lis':
            this.$router.push({'path': '/listtriones/ko'})
            this.$store.dispatch('TrionesListEN')
            break;
          case '/dev':
            this.$router.push({'path': '/developer/ko'})
            /* this.$store.dispatch('developerKO') */
            break;
          case '/bou':
            this.$router.push({'path': '/bounty/ko'})
            /* this.$store.dispatch('developerJP') */
            break;
          case '/ont':
            this.$router.push({'path': '/ont-view/ko'})
            this.$store.dispatch('ontViewKO')
            this.language = false;
            this.search(2)
            this.search(1)
            break;
          default:      
        }
        this.language = false
        Global.language = 'ko'
        Global.languageFlag = true
        this.head = this.headKO
        this.closecollapse();
      },
      toJapanese:function(){
        var path = this.$route.path
        var path = path.substr(0,4)
        var params = this.$route.params 
        this.addCookie("lang","jp");
        switch(path)
        {
          case '/':
            window.location.href="https://ont.io/"
            break;
          case '/new':
            this.$router.push({'path': '/news/jp'})
            params.pgname = "CooperationJP"
            this.$store.dispatch('pageDetail',params)
            break;
          case '/coo':
            this.$router.push({'path': '/cooperation/jp'})
            params.pgname = "CooperationJP"
            this.$store.dispatch('pageDetail',params)
            break;
          case '/tea':
            this.$router.push({'path': '/team/jp'})
            params.pgname = "TeamFileJP"
            this.$store.dispatch('pageDetail',params)
            break;
          case '/tri':
            this.$router.push({'path': '/trionesintro/jp'})
            this.$store.dispatch('TrionesEN')
            break;
          case '/lis':
            this.$router.push({'path': '/listtriones/jp'})
            this.$store.dispatch('TrionesListEN')
            break;
          case '/dev':
            this.$router.push({'path': '/developer/jp'})
            /* this.$store.dispatch('developerJP') */
            break;
          case '/bou':
            this.$router.push({'path': '/bounty/jp'})
            /* this.$store.dispatch('developerJP') */
            break;
          case '/ont':
            this.$router.push({'path': '/ont-view/jp'})
            params.pgname = "ontViewJP"
            this.$store.dispatch('pageDetail',params)
            this.language = false;
            this.search(2)
            this.search(1)
            break;
          default:      
        }
        this.language = false
        Global.language = 'jp'
        Global.languageFlag = true
        this.head = this.headJP
        this.closecollapse();
      },
      addCookie:function (name,value,expireHours){
          var cookieString=name+"="+escape(value)+"; path=/";
          //判断是否设置过期时间
          if( (name=='key' || name == 'username') && !expireHours){
              expireHours = 720;//30 days
          }
          if(expireHours>0){
              var date=new Date();
              date.setTime(date.getTime()+expireHours*3600*1000);
              cookieString=cookieString+";expires="+date.toGMTString();
          }
          document.cookie=cookieString;
      },
        search:function(category){
            
            var params = this.$route.params
            params.language = this.language?"cn":"en"
            params.category = category 
            params.pagesize = 20
            params.pagenumber = 1
            this.$store.dispatch('newslist',params)
        },
      navColor:function () {
          var scrnum = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
          var widthnum = document.body.clientWidth;
          var $nav = $(".navbar-inverse");
          var $logo = $("#logoimg");
          var path = this.$route.path
          var path = path.substr(0,4)
              if(path !== '/hom'){
                    $nav.css("background-color", "#000000");   
                    $logo.css("opacity", 1);   
              }else{
                if (scrnum <= 500) {
                    $nav.removeAttr('style');
                    if(scrnum >300){
                      var percent = (scrnum-300)/300
                      $logo.css("opacity", percent);            
                    }else{
                      $logo.css("opacity", 0); 
                    }
                } else {
                    $nav.css("background-color", "#000000");   
                    $logo.css("opacity", 1);   
                }
              }
      }
     },
    data() {
      return {
        icontest:'icon-shenfenzhengming ',
        language:false,
        onOff:true,
        offOn:true,
        scrnum:'',
        head:{},
        firstPage:{},
        valuePage:{},
        painPointPage:{},
        visionPage:{},
        ECOPage:{},
        applicationPage:{},
        footerPage:{},
        headEN:{
            contactUs:"Contact Us",
            home:"Home",
            trust:"Trust Anchor",
            OntScenarios:"Scenarios",
            OntTech:"Technology",
            language:"Language",
            languagenow:"English",
            zh:"中文",
            En:"English",
            ko:"한국어",
            jp:"日本語",
            documents:"More",
            team:"Team",
            node:"Node",
            cooperation:"Cooperation",
            OntIntroduction:"Introductory White Paper",
            OntECOWP:"Ecosystem White Paper",
            OntTechWP:"Technology White Paper",
            OntTechYP:"Technology Yellow Paper (TBA)",
            OntGoveYP:"Governance White Paper (TBA)",
            joinus:"Join Ontology",
            News:"Press",
            develop:"Developer",
            aboutus:"About Ontology",
            ontView:"Tech News",
            bounty:"Bounty",
            explorer:"Explorer",
            dapps:"dApps"
        },
        headZH:{
            contactUs:"找到我们",
            home:"主页",
            trust:"信任锚",
            OntScenarios:"本体场景",
            OntTech:"本体技术",
            language:"Language",
            languagenow:"中文",
            zh:"中文",
            En:"English",
            ko:"한국어",
            jp:"日本語",
            documents:"更多",
            team:"团队",
            node:"节点",
            cooperation:"机构合作",
            OntIntroduction:"白皮书概览",
            OntECOWP:"生态白皮书",
            OntTechWP:"技术白皮书",
            OntTechYP:"技术黄皮书（敬请期待）",
            OntGoveYP:"治理白皮书（敬请期待）",
            joinus:"加入本体",
            News:"新闻",
            develop:"开发者",
            aboutus:"关于本体",
            ontView:"本体视点",
            bounty:"激励",
            explorer:"浏览器",
            dapps:"dApps"
        },
        headKO:{
            contactUs:"找到我们",
            home:"홈",
            trust:"신뢰 앵커",
            OntScenarios:"本体场景",
            OntTech:"本体技术",
            language:"Language",
            languagenow:"한국어",
            zh:"中文",
            En:"English",
            ko:"한국어",
            jp:"日本語",
            documents:"더 보기",
            team:"팀",
            node:"노드",
            cooperation:"제휴/협력",
            OntIntroduction:"白皮书概览",
            OntECOWP:"生态白皮书",
            OntTechWP:"技术白皮书",
            OntTechYP:"技术黄皮书（敬请期待）",
            OntGoveYP:"治理白皮书（敬请期待）",
            joinus:"加入本体",
            News:"언론 보도",
            develop:"개발자",
            aboutus:"온톨로지에 대하여",
            ontView:"온톨로지 들여다보기",
            bounty:"현상금",
            explorer:"브라우저",
            dapps:"dApps"
        },
        headJP:{
            contactUs:"Contact Us",
            trust:"信託アンカー",
            home:"ホーム",
            OntScenarios:"Scenarios",
            OntTech:"Technology",
            language:"Language",
            languagenow:"日本語",
            zh:"中文",
            En:"English",
            ko:"한국어",
            jp:"日本語",
            documents:"その他",
            team:"チーム",
            node:"ノード",
            cooperation:"業務提携",
            OntIntroduction:"Introductory White Paper",
            OntECOWP:"Ecosystem White Paper",
            OntTechWP:"Technology White Paper",
            OntTechYP:"Technology Yellow Paper (TBA)",
            OntGoveYP:"Governance White Paper (TBA)",
            joinus:"Join Ontology",
            News:"ニュース",
            develop:"開発資料",
            aboutus:"オントロジーについて",
            ontView:"オントロジーの概要",
            bounty:"バウンティ",
            explorer:"ブラウザ",
            dapps:"dApps"
        },
      }
    },
    beforeDestroy() {
    }
  }
</script>

<style>
@media only screen and (max-width: 768px) {

  .mobile-lang{
    text-align:left !important;
    padding:5px 0px !important;
  }
  .nav-ul-item-a{
    padding-left:0 !important;
    color: #232323 !important;
  }
  .menu-item-bottom{
    border-bottom: 1px solid #d5d5d5;
  }
  #logo_div{
    padding:0 8px;
  }
  .t2-head{
    font-size:16px;
  }
  .container-head{
   padding:0   !important;
  } 
  .navbar-inverse{
   background-color:rgba(255,255,255, 0.9);
  }
  .dropdown-menu-back{
        width: 300px;
      transform: translate(0,0) !important;
  }
  .dropdown-menu-back-lag{
        width: 300px;
      transform: translate(0,0) !important;
   background-color:rgba(255,255,255, 0.9);
   color:#000 !important;
/*       background-image: linear-gradient(0deg, rgba(50,146,170,0.69) 0%, rgba(50,146,170,0.55) 100%); */

  }
  #menu_list{
  /*     position: absolute;
      right: 0; */
  /*     margin-top: 12px; */
      /* display: flex; */
      height:100vh;
      padding-top:20px;
      width:80%;
      margin:0 10% !important;
  }
}
#menu_list{
/*     position: absolute;
    right: 0; */
/*     margin-top: 12px; */
    /* display: flex; */
    /* margin-right:8px; */
}
  .content-container-head{
   position: relative;
    display: flex;
    margin: 0 auto;
    height: 100%;
  } 
a:hover{
  color:rgb(50,146,170);
}
 .container-head{
   padding:0;
   margin:auto;
 }
 .item-active{
  background-color:#dad7d7
 }
 .botton-active{
  background-color: #E8E6FF;
  color:rgb(107, 98, 205);
 }
  .wider{
    width:300px !important;
  }
  .header-monitor span{
    color: #C6C7CD;
    font-size: 20px;
  }
  .header-monitor span:hover{
  	cursor: pointer;
  }
  .header-monitor{
  padding: 10px;
  background-color: #25262C;
}
.logo{
  width: 100px;
  margin-left: 10px;
}
.navbar-collapse{
  overflow: hidden;
}
.search{
  top: 170px;
  width: 70%;
  left: 15%;
  position: absolute;
  z-index: 11;
}
.search input{
  font-size: 16px;
  width: 100%;
  padding:10px 60px 10px 20px;
  border-radius: 30px;
  border: 5px solid #6258c5;
  background-color: #E3E0F1;
  outline: none;
}
.search button{
  outline: none;
  font-size: 20px;
  position: absolute;
  background: #E3E0F1;
  border: none;
  right: 3%;
  top: 12px;
}
.dropdown-menu-back{
      width: 200px;
    transform: translate(-50%,0);
    left: 50%;
    background-color: #ffffff;
    color: #000;
    border: 1px solid #dbdada;
    border-radius: 3px;
    /* background-image: linear-gradient(0deg, rgba(50,146,170,0.69) 0%, rgba(50,146,170,0.55) 100%); */
}
@media only screen and (min-width:769px)  {
/*   .menu-item{
    height:22px;
  } */
  .nav-ul-item-a{
     padding:15px 20px !important;
  }
  #logo_div{
    padding:0 8px;
  }
  .t2-head{
    font-size:16px;
    font-weight: 100;
  }
  .dropdown-menu-back-lag{
        width: 92.76px !important;
      transform: translate(-50%,0);
      left: 50%;
    background-color: #ffffff;
    color: #000;
    /* background-image: linear-gradient(0deg, rgba(50,146,170,0.69) 0%, rgba(50,146,170,0.55) 100%); */
        border: 1px solid #dbdada;
    border-radius: 3px;
    padding-top: 10px;
  }
}
.nav-ul-a-top-border{
      border-top: 1px solid rgba(225,225,225,0.26);
}
.nav-ul-li{
  text-align: center;
}
.nav-ul-li:hover{
  background-color: rgba(225,225,225,0.26);
}
.nav-ul-li:hover > .nav-ul-a-top-border{
  border-top: 1px solid rgba(225,225,225,0);
}
.nav-ul-li:hover +.nav-ul-li > .nav-ul-a-top-border{
  border-top: 1px solid rgba(225,225,225,0);
}
#head-navbar{
  background-color: #000000;
}
.arrow_down{
	position: absolute;
	height: 25px;
	width: 100%;
	top: -15px;
}
.arrow_down::after{
      content: "";
    display: block;
    position: absolute;
    top: 7px;
    left: 45%;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: #fff solid 8px;
}
.arrow_down1{
	position: absolute;
	height: 25px;
	width: 100%;
	top: -15px;
}
.arrow_down1::after{
      content: "";
    display: block;
    position: absolute;
    top: 7px;
    left: 40%;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: #fff solid 8px;
}
/*公共样式--开始*/
#mobile_nav{
	display: none;
	height: 100vh;
	width:100vw;
	background-color: rgba(255,255,255,1);
	position: fixed;z-index: 998;
	top: 45px;
}
/*手机导航*/
#mobile_nav{
	display: none;
	opacity: 0;
	z-index: -1;
	transition: .4s cubic-bezier(0.03, 0.98, 0.52, 0.99);
}
#mobile_nav ul.menu{
	height: 100%;
	width: 80vw;
	padding-top: 20px;
	margin: 0 auto;
}
#mobile_nav ul.menu>li{
	border-bottom: 1px solid #d5d5d5;
	padding: 10px 0;
	cursor: pointer;
}
#mobile_nav ul.menu>li:hover>a{
	color: #46adc4;
}
#mobile_nav ul.menu>li>a{
	display: block;
	font-size: 16px;
	transition: .4s;
}
#mobile_nav ul.menu>li>ul.lang_menu{
	overflow: hidden;margin-top: 0;
	height: 0;transition: .4s cubic-bezier(0.03, 0.98, 0.52, 0.99);
}
#mobile_nav ul.menu>li>ul.active{
	height: 58px;margin-top: 15px;
}
#mobile_nav ul.menu>li>ul.lang_menu>li{
	padding: 5px 0;
}
#mobile_nav ul.menu>li>ul.lang_menu>li>a{
	display: block;
}

#nav{
    position: fixed;
    box-shadow: 0 3px 10px rgba(0,0,0,.3);
    background-color: #000;width: 100vw;
    z-index: 999;transition: .4s cubic-bezier(0.03, 0.98, 0.52, 0.99);
}
#nav .content{
    position: relative;
    display: flex;
    margin: 0 auto;
    height: 100%;
}
#nav .content a.logo{
    display: block;
	padding: 8px 16px;
	transition: .4s cubic-bezier(0.03, 0.98, 0.52, 0.99);
}
#nav .content a.logo img{
	display: block;
	height: 32px;
}
#nav .content ul.menu{
    position: absolute;right: 0;
    margin-top: 12px;display: flex;margin-right: 16px;
}
#nav .content ul.menu li{
	position: relative;
	margin-bottom: 10px;
}
#nav .content ul.menu li:hover ul{
	display: block;
}
#nav .content ul.menu li ul{
	position: absolute;
	top: 25px;
	left: 0;
	display: none;
	background: #fff;
	border: 1px solid #dbdada;
	border-radius: 3px;
	padding-top: 10px;
}
#nav .content ul.menu li ul li:last-child{
	position: absolute;
	top: -14px;
    left: 42px;
}
#nav .content ul.menu li ul li a{
	color: #908f8f;
	line-height: 19px;
	text-align: center;
}
#nav .content ul.menu li ul li a:hover{
	color: #99cbd9;
}
#nav .content ul.menu li a{
    display: block;
    padding: 0 20px;
    color: #fff;font-size: 16px;
    font-family: "OpenSansLight","Microsoft YaHei";
}
#nav .content ul.menu li>form>input{
    background: transparent;
    border: none;color: #fff;font-size: 12px;
    border-bottom: 1px solid #666;
}
#nav .content ul.menu li>form>i.icon_search{
    display: inline-block;width: 11px;height: 12px;
    /* background: url("../images/index/nav_icon_search_03.png")no-repeat; */
}
#nav .content ul.menu li a i.icon_arrow{
    display: inline-block;
    width: 12px;height: 7px;
    /* background: url("../images/index/nav_menu_arrow.png")no-repeat; */
    margin-left: 5px;
}
#nav .content ul.menu .one{
	left: -10px;
}
#nav .content ul.menu .two{
	left: -19px;
	width: 115px;
}
</style>