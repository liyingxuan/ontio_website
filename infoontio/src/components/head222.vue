<template>
  <div id="top">
    <nav class="navbar navbar-inverse navbar-fixed-top" >
        <div id="nav_container" class="container container-head">
		    <div class="navbar-header">
                <div id="logo_div" class="pull-left">
                    <a   @click="toHome()">
                        <img id="logoimg" class="head-logo" src="../assets/images/footerlogo.png" />
                    </a>
			    </div>
				<button id="togglebutton" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="border:0px;">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
			<div id="collapse" class="collapse navbar-collapse" aria-expanded="false" style="height: 0px;" >
                <ul id="menu_list" class="nav navbar-nav pull-right pop-menu t2 head-font nav-stacked nav-ul">
                    <li class="menu-item"><a class="nav-ul-item-a" asp-area="" asp-controller="home" asp-action="index"  @click="toHome()">{{head.home}}</a></li>
                    <li class="menu-item"><a class="nav-ul-item-a" asp-area="" asp-controller="home" asp-action="index"  @click="toApp()">{{head.OntScenarios}}</a></li>
                    <!-- <li class="menu-item"><a class="nav-ul-item-a" asp-area="" asp-controller="home" asp-action="index" @click="toTech()">{{head.OntTech}}</a></li> -->
<!--                     <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle nav-ul-item-a" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" @click="scrollTo('bottom')">
                        {{head.contactUs}}
                        </a>
                    </li> -->
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle nav-ul-item-a" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{head.documents}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-back">
<!--                            <li class="nav-ul-li"><a class=" nav-ul-a ">{{head.OntIntroduction}}</a></li> -->
                           <li class="nav-ul-li"><a class=" nav-ul-a " :href='language?"/static/wp/本体白皮书概览.pdf":"/static/wp/Ontology Introductory White Paper.pdf" ' target="view_window" >{{head.OntIntroduction}}</a></li>
                           <li class="nav-ul-li"><a class=" nav-ul-a nav-ul-a-top-border" :href='language?"/static/wp/Ontology-technology-white-paper-ZH.pdf":"/static/wp/Ontology-technology-white-paper-EN.pdf" '  target="view_window" >{{head.OntTechWP}}</a></li>
                           <li class="nav-ul-li"><a class=" nav-ul-a nav-ul-a-top-border" :href='language?"/static/wp/Ontology-Ecosystem-White-Paper-ZH.pdf":"/static/wp/Ontology-Ecosystem-White-Paper-EN.pdf" ' target="view_window" >{{head.OntECOWP}}</a></li>
                           <li class="nav-ul-li"><a class=" nav-ul-a nav-ul-a-top-border head-icon-disable" style="font-size:12px" target="view_window" >{{head.OntTechYP}}</a></li>
                           <li class="nav-ul-li"><a class=" nav-ul-a nav-ul-a-top-border head-icon-disable" style="font-size:12px" target="view_window" >{{head.OntGoveYP}}</a></li>
<!--                            <li><a class=" nav-ul-a"><span class="iconfont footer-title  head-icon" >&#xe79b;</span> {{head.OntTechWP}}</a></li>
                           <li><a class=" nav-ul-a"><span class="iconfont footer-title  head-icon" >&#xe79b;</span> {{head.OntTechYP}}</a></li> -->
                        </ul>
                    </li>
<!--                     <li class="menu-item"><a class="nav-ul-item-a" asp-area="" asp-controller="home"  asp-action="index"  @click="toJoin()">{{head.joinus}}</a></li> -->
                    <li class="menu-item"><a class="nav-ul-item-a" asp-area="" asp-controller="home"  asp-action="index"  @click="toCooperation()">{{head.cooperation}}</a></li>
                    <li class="menu-item"><a class="nav-ul-item-a" asp-area="" asp-controller="home"  asp-action="index"  @click="toteam()">{{head.team}}</a></li>
                    <li class="menu-item"><a class="nav-ul-item-a" asp-area="" asp-controller="home"  asp-action="index"  @click="toNews()">{{head.News}}</a></li>
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle head-font-EN nav-ul-item-a" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                          <!-- <span class="iconfont icon-lang-size" style="padding:0" >&#xe6e3;</span> -->
                          {{head.language}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-back-lag">
                            <li class="menu-item nav-ul-li" ><a class=" nav-ul-a-lag " style="text-align:center" asp-area="" asp-controller="download" asp-action="index" @click="toChinese">{{head.zh}}</a></li>
                            <li class="menu-item nav-ul-li" ><a class="head-font-EN nav-ul-a-lag nav-ul-a-top-border" style="text-align:center" asp-area="" asp-controller="blog" asp-action="index" @click="toEnglish">{{head.En}}</a></li>
                        </ul>
                    </li>
                </ul>
			</div>
        </div>
    </nav>
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
        window.addEventListener('scroll', this.navColor)
        window.addEventListener('scroll', this.closecollapse)
        jQuery(function($) {
          $("#menu_list").bootstrapDropdownOnHover();
          $("#menu-list").bootstrapDropdownOnHover();
          $(".nav > li > a").click(function(){  
                 $('#collapse').addClass("collapsed");  
                 $('#collapse').attr("aria-expanded",false);  
                 $("#navbar").removeClass("in");  
                 $("#navbar").attr("aria-expanded",false);  
          }); 
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
                      $nav.css("background-color", "rgba(255, 255, 255, 0.9)");   
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
            this.toEnglish()
          }          
      }else{
        if(Global.languageFlag){
          if(Global.language == 'zh'){
            this.toChinese()
          }else{
            this.toEnglish()
          }  
        }else{
          if(lang == 'zh'){
            this.toChinese()
            this.language = true
            Global.language = 'zh'
            Global.languageFlag = true
          }else{
            this.toEnglish()
            this.language = false
            Global.language = 'en'
            Global.languageFlag = true
          }        
        }        
      }
    },
    watch:{

      'article':function(){
        debugger
         this.language = this.article.language;
      }
    },
    methods: {
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
         this.$router.push({'path': '/'})
      },
      toteam:function(){
         this.$router.push({'path': '/team'})
      },
      toApp:function(){
         this.$router.push({'path': '/application/'+'page0'})
      },
      toTech:function(){
         this.$router.push({'path': '/technology'})
      },
      toCooperation:function(){
         this.$router.push({'path': '/cooperation'})
      },
      toJoin:function(){
         this.$router.push({'path': '/joinus'})
      },
      toNews:function(){
         this.$router.push({'path': '/news'})
      },
      toChinese:function(){
        var path = this.$route.path
        var path = path.substr(0,4)
        debugger
        switch(path)
        {
          case '/':
            this.$store.dispatch('FileZH')
            break;
          case '/hom':
            this.$store.dispatch('FileZH')
            break;
          case '/app':
            this.$store.dispatch('AppFileZH')
            break;
          case '/tec':
            this.$store.dispatch('TechFileZH')
            break;
          case '/joi':
            this.$store.dispatch('JoinUsFileZH')
            break;
          case '/new':
            this.$store.dispatch('NewsFileZH')
            break;
          case '/coo':
            this.$store.dispatch('CooperationZH')
            break;
          case '/tea':
            this.$store.dispatch('TeamFileZH')
            break;
          case '/kyc':
            this.$store.dispatch('kycZH')
            break;
          case '/FAQ':
            this.$store.dispatch('KYCFAQZH')
            break;
          case '/ont':
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
        switch(path)
        {
          case '/':
            this.$store.dispatch('FileEN')
            break;
          case '/hom':
            this.$store.dispatch('FileEN')
            break;
          case '/app':
            this.$store.dispatch('AppFileEN')
            break;
          case '/tec':
            this.$store.dispatch('TechFileEN')
            break;
          case '/joi':
            this.$store.dispatch('JoinUsFileEN')
            break;
          case '/new':
            this.$store.dispatch('NewsFileEN')
            break;
          case '/coo':
            this.$store.dispatch('CooperationEN')
            break;
          case '/tea':
            this.$store.dispatch('TeamFileEN')
            break;
          case '/kyc':
            this.$store.dispatch('kycEN')
            break;
          case '/FAQ':
            this.$store.dispatch('KYCFAQEN')
            break;
          case '/ont':
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
/*           if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
                  $nav.css("background-color", "rgba(255, 255, 255, 0.9)");   
                  $logo.css("opacity", 1);
          } else {
              if(path !== '/hom'){
                    $nav.css("background-color", "rgba(255, 255, 255, 0.9)");   
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
                    $nav.css("background-color", "rgba(255, 255, 255, 0.9)");   
                    $logo.css("opacity", 1);   
                }
              }
          } */
              if(path !== '/hom'){
                    $nav.css("background-color", "rgba(255, 255, 255, 0.9)");   
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
                    $nav.css("background-color", "rgba(255, 255, 255, 0.9)");   
                    $logo.css("opacity", 1);   
                }
              }
      }
     },
    data() {
      return {
        icontest:'icon-shenfenzhengming ',
        language:false,
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
            OntScenarios:"Scenarios",
            OntTech:"Technology",
            language:"语言",
            zh:"中",
            En:"En",
            documents:"Documents",
            team:"Team",
            cooperation:"Cooperation",
            OntIntroduction:"Introductory White Paper",
            OntECOWP:"Ecosystem White Paper",
            OntTechWP:"Technology White Paper",
            OntTechYP:"Technology Yellow Paper (TBA)",
            OntGoveYP:"Governance White Paper (TBA)",
            joinus:"Join Ontology",
            News:"Press"
        },
        headZH:{
            contactUs:"找到我们",
            home:"首页",
            OntScenarios:"本体场景",
            OntTech:"本体技术",
            language:"Language",
            zh:"中",
            En:"En",
            documents:"文档",
            team:"团队",
            cooperation:"机构合作",
            OntIntroduction:"白皮书概览",
            OntECOWP:"生态白皮书",
            OntTechWP:"技术白皮书",
            OntTechYP:"技术黄皮书（敬请期待）",
            OntGoveYP:"治理白皮书（敬请期待）",
            joinus:"加入本体",
            News:"新闻"
        },
      }
    },
    beforeDestroy() {
    }
  }
</script>

<style>
@media only screen and (max-width: 768px) {
  .container-head{
   padding:0  22px !important;
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
      background-image: linear-gradient(0deg, rgba(50,146,170,0.69) 0%, rgba(50,146,170,0.55) 100%);
  }
}
a:hover{
  color:rgb(50,146,170);
}
 .container-head{
   padding:0 32px;
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
      width: 300px;
    transform: translate(-50%,0);
    left: 50%;
    background-image: linear-gradient(0deg, rgba(50,146,170,0.69) 0%, rgba(50,146,170,0.55) 100%);
}
@media only screen and (min-width:769px)  {
  .dropdown-menu-back-lag{
        width: 100px !important;
      transform: translate(-50%,0);
      left: 50%;
      background-image: linear-gradient(0deg, rgba(50,146,170,0.69) 0%, rgba(50,146,170,0.55) 100%);
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
</style>