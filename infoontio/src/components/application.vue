<template>
  <div id="browser" style="z-index: 1;    background-repeat: no-repeat;background-size: 100%;">
    <Top></Top>

<!-- ONTOLOGY NETWORK APP-->
    <div  id="page0" class="home-page-content back-color container-padding container-val-background" style="z-index:10">
        <div class="container home-detail zindex container-pos" >
            <div class="row">
                <div class="midpoint home-text-fir home-text-title" >
                    <div>
                        <!-- <div class="item-icon"></div> -->
                        <div class="title-margin ">
                            <h1 v-if="language" class="h1-font"> 
                                <span >
                                    <span class="head-float" >
                                        {{appPage.firstTitle1}}
                                    </span>
                                    <div class="clear"></div>
                                </span>
                            </h1>
<!--  english -->
                            <h1 v-else class="h1-EN h1-font"> 
                                <span >
                                    <span class="head-float">
                                        {{appPage.firstTitle1}}
                                    </span>
                                    <div class="clear"></div>
                                </span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container home-detail zindex ">
            <div class="container-margin">
                <div class="row " style="color:black">
                        <div class="col-sm-12" style="padding:0" v-if="language">
                            <p class="p-font text2 " style="text-align:left">
                                <span v-for="(item,index) in appPage.descriptionlist" :class="item.blod?'text2-blod':''">{{item.description}}</span>
                            </p>
                        </div>
<!--  english -->       <div class="col-sm-12 col-sx-12" style="padding:0" v-else>
                            <p class="p-font text2-EN" style="text-align:left">
                                <span v-for="(item,index) in appPage.descriptionlist" :class="item.blod?'text2-blod-EN':''">{{item.description}}</span>
                            </p>
                        </div>
                    <div class="col-sm-12 margin1-top" style="padding:0;border-bottom:1px solid rgb(210, 208, 208);"></div>
                </div>
            </div>
        </div>
    </div>
<!--     applist -->
    <div v-for="(item,index) in applist" :id="item.id" class="home-page-content back-color container-padding container-val-background">
        <div class="container home-detail zindex container-pos">
            <div class="row">
                <div  class="midpoint home-text-fir home-text-title" >
                    <div>
                        <!-- <div class="item-icon"></div> -->
                        <div class="title-margin " >
                            <h1 v-if="language" class="h1-font"> 
                                <span >
                                    <span class="firstTitle-font">{{item.firstTitle1}}</span>
                                </span>
                            </h1>
<!--  english -->
                            <h1 v-else class="h1-EN h1-font"> 
                                <span >
                                    <span class="firstTitle-font-EN">{{item.firstTitle1}}</span>
                                </span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container home-detail zindex" >
            <div class="container-margin">
                <div class="row" style="color:black;text-align:left">
                    <div class="col-sm-12"  style="padding:0">
                        <div class="col-sm-1 mobile-display" ></div>
                        <div class="col-sm-6 app-img mobile-display" style="padding:0 20px 0 0">
                            <img :src="item.url" style="width: 100%;" />
                        </div> 
                        <div class="col-sm-1 mobile-display" ></div>
                        <div class="col-sm-4 app-desc-content" style="padding:0px" v-if="language">
                            <div  class="col-sm-12 vision-item-pic-right"  style="padding:0;text-align:left">
                                <p class="p-font text2">
                                {{item.mainDescription1}}   
                                </p>
                            </div>
                        </div> 
<!--  english -->
                        <div class="col-sm-4 app-desc-content" style="padding:0px" v-else>
                            <div class="col-sm-12 vision-item-pic-right"  style="padding:0;text-align:left">
                                <p class="p-font text2">
                                {{item.mainDescription1}}   
                                </p>
                            </div>
                        </div> 
                        <div class="col-sm-4 pc-display" ></div>
                        <div class="col-sm-1 pc-display" ></div>
                        <div class="col-sm-6 app-img pc-display" style="padding:0 20px 0 0">
                            <img :src="item.url" style="width: 100%;" />
                        </div> 
                        <div class="col-sm-1 pc-display" ></div>
                    </div>
 
                    <div class="col-sm-12"  style="padding:0" v-if="language">
                        <div v-for="(subitem,index) in item.list" v-if="index < 3 " class="col-sm-4 margin3-top item-padding">
<!--                             <div class="col-sm-12 icon-margin-bottom" style="padding:0">
                                <span :class="subitem.icon+'iconfont item-l-icon'"  ></span>
                            </div> -->
                            <div class="col-sm-12" style="padding:0">
                                <span class="head3">{{subitem.title}}</span>                                
                            </div>
                            <div class="col-sm-12" style="padding:0">
                                <p class="p-font text2 text2-margin-top">
                                    {{subitem.description}}
                                </p>
                            </div>
                        </div> 
                    </div>
<!--  english -->
                    <div class="col-sm-12"  style="padding:0" v-else>
                        <div v-for="(subitem,index) in item.list" v-if="index < 3 " class="col-sm-4 margin3-top item-padding">
<!--                             <div class="col-sm-12 icon-margin-bottom" style="padding:0">
                                <span :class="subitem.icon+'iconfont item-l-icon'"  ></span>
                            </div> -->
                            <div class="col-sm-12" style="padding:0">
                                <span class="head3-EN">{{subitem.title}}</span>                                
                            </div>
                            <div class="col-sm-12" style="padding:0">
                                <p class="p-font text2-EN text2-margin-top">
                                    {{subitem.description}}
                                </p>
                            </div>
                        </div> 
                    </div>
                    <div class="col-sm-12 margin1-top" style="padding:0;border-bottom:1px solid rgb(210, 208, 208);"></div>
                </div>
            </div>
        </div>
    </div>
<!-- MORE APP-->
    <div  id="pageMore" class="home-page-content back-color container-padding container-val-background" style="z-index:10">
        <div class="container home-detail zindex container-pos" >
            <div class="row">
                <div class="midpoint home-text-fir home-text-title" >
                    <div>
                        <!-- <div class="item-icon"></div> -->
                        <div class="title-margin ">
                            <h1 v-if="language" class="h1-font"> 
                                <span >
                                    <span class="head-float">
                                        <span class="firstTitle-font">{{morePage.title}}</span>
                                    </span>
                                    <div class="clear"></div>
                                </span>
                            </h1>
<!--  english -->
                            <h1 v-else class="h1-EN h1-font"> 
                                <span >
                                    <span class="head-float">
                                        <span class="firstTitle-font-EN">{{morePage.title}}</span>
                                    </span>
                                    <div class="clear"></div>
                                </span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container home-detail zindex ">
            <div class="container-margin">
                <div class="row " style="color:black">
                        <div class="col-sm-12" v-if="language">
                            <p class="p-font text2 " style="text-align:left">
                                <span >{{morePage.description}}</span>
                            </p>
                        </div>
<!--  english -->       <div class="col-sm-12 col-sx-12" v-else>
                            <p class="p-font text2-EN">
                                <span >{{morePage.description}}</span>
                            </p>
                        </div>
                    <div class="col-sm-12 margin1-top" style="padding:0;border-bottom:1px solid rgb(210, 208, 208);"></div>
                </div>
            </div>
        </div>
    </div>
    
    <Bottom></Bottom>
  </div>
</template>

<script>  
  import '../assets/ebro/css/site1.css'
  import '../assets/ebro/css/navigation.css'
  import '../assets/ebro/css/common.css'
  import '../assets/ebro/css/homepage.css'
  import { mapGetters, mapActions } from 'vuex'
  import Bottom from './bottom.vue'
  import Global from './Global.vue'
  import Top from './head.vue'

  export default {
    mounted: function() {
        window.addEventListener('scroll', this.navColor)
    },
    computed: mapGetters({
      AppFileZH: 'AppFileZH',
      AppFileEN: 'AppFileEN'
    }),
    created() {
        if(Global.language == 'zh'){
          this.language = true;
        }else{
          this.language = false;
        }
      this.timeoutBlock = setTimeout(() => {
        var params = this.$route.params
        this.scrollTo(params.page)
        }
      ,100)
    },
    watch:{
      'AppFileEN':function(){
         this.head = this.AppFileEN.head
         this.appPage = this.AppFileEN.appPage
         this.applist = this.AppFileEN.applist
         this.morePage = this.AppFileEN.morePage
         this.footerPage = this.AppFileEN.footerPage
          this.language = false;
      },
      'AppFileZH':function(){
          debugger
         this.head = this.AppFileZH.head
         this.appPage = this.AppFileZH.appPage
         this.applist = this.AppFileZH.applist
         this.morePage = this.AppFileZH.morePage
         this.footerPage = this.AppFileZH.footerPage
          this.language = true;
      }
    },
    methods: {
      scrollTo:function(page){
          debugger
          document.getElementById(page).scrollIntoView(true); 
      }
/*       toChinese:function(){
        this.$store.dispatch('FileZH')
        this.language = true
      },
      toEnglish:function(){
        this.$store.dispatch('FileEN')
        this.language = false
      },
      navColor:function () {
          var scrnum = document.documentElement.scrollTop;
          var widthnum = document.body.clientWidth;
          var $nav = $(".navbar-inverse");
          if (scrnum <= 500) {
              $nav.removeAttr('style');
          } else {
              if(widthnum>768){
                $nav.css("background-image", "linear-gradient(-180deg, rgba(255,255,255,1) 0%, rgba(255,255,255,0.50) 97%)");
                $nav.css("background-image", "-moz-linear-gradient(-180deg, rgba(255,255,255,1) 0%, rgba(255,255,255,0.50) 97%)");
                $nav.css("background-image", "-o-linear-gradient(-180deg, rgba(255,255,255,1) 0%, rgba(255,255,255,0.50) 97%)");
                $nav.css("background-image", "-webkit-gradient(-180deg, rgba(255,255,255,1) 0%, rgba(255,255,255,0.50) 97%)");
              }else{
                $nav.css("background-color", "rgba(255, 255, 255, 0.85)");   
              }
          }
      } */
     },
    data() {
      return {
        icontest:'icon-shenfenzhengming ',
        language:false,
        scrnum:'',
        head:{},
        appPage:{},
        applist:{},
        morePage:{},
        footerPage:{}
      }
    },
    components: {
      Bottom,
      Top,
      Global
    },
    beforeDestroy() {
    }
  }
</script>

<style>
@media only screen and (max-width: 400px) {
    .head-float{
        float:left;
        width: 100%;
    }    
}
</style>
