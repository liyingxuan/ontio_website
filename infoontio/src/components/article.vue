<template>
  <div id="browser" style="z-index: 1;    background-repeat: no-repeat;background-size: 100%;">
<!--     <div class="home-page-content" id="homeFri" style="background-image:url(static/img/backgroundimage.jpg) ;    height: -webkit-fill-available;z-index: -11111;position: absolute;width: 100%;    background-size: 100%;">
    </div> -->
    <Top></Top>
    <!-- for pic -->
<!--     <div class="home-page-content seperate-line margin1-bottom" id="cutoff" style="height:100px;background-image:url(static/img/cutoff.png) ;background-repeat: round;">
    </div> -->
<!-- ONTOLOGY NETWORK -->
   <div  id="toptarget" ></div>
    <div class="col-sm-12 margin1-top"  ></div>
<!--       <vue-tinymce
    ref="tinymce"
    v-model="content"
    :setting="setting">
  </vue-tinymce> -->

    <div  id="communityPage" class="home-page-content back-color container-padding-first container-val-background " style="z-index:10">
        <div class="container home-detail zindex container-pos" >
            <div class="row">
                <div class="midpoint home-text-fir home-text-title" >
                    <div style="text-align:center;">
                        <div class="title-margin col-sm-2"></div>
                        <div class="title-margin col-sm-8" >
                            <h2 v-if="language" style="text-align:left;font-weight: 300;"> 
                                <span >
                                    <span class="head-float">
                                        {{article.Title}}
                                    </span>
                                    <div class="clear"></div>
                                </span>
                            </h2>

                            <h2 v-else class="h2-EN" style="text-align:left;font-weight: 300;"> 
                                <span >
                                    <span  class="head-float">
                                        {{article.Title}}
                                    </span>
                                    <div class="clear"></div>
                                </span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container home-detail zindex ">
            <div class="container-margin-ontdesc">
                <div class="row " style="color:black">
                    <!-- <div class="col-sm-12 " style="padding:0;"> -->
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8 ">
                            <p class="p-font text2 val-img" style="text-align:left" v-if="language">
                                由 {{article.Author}} 发表于 {{article.NewsTime}}
                            </p>
                            <p class="p-font text2 val-img" style="text-align:left" v-else>
                                By {{article.Author}} | Updated {{article.NewsTime}}
                            </p>
                            </br>
<!--                             <p class="p-font text2 val-img" style="text-align:left">
                                {{item.newssummary.substr(0,100)}}...<a>查看全文</a>
                            </p> -->
                        </div>
                        <div v-for="(item,index) in article.Detail" class="col-sm-12" style="padding:0px;margin-bottom:32px;">
                            <div v-if="item.picurl" class="col-sm-12" style="padding:0px;">
                                <div class="col-sm-2"></div>
                                <div  v-if="!item.personPic"class="col-sm-8 " >
                                    <img :src="item.picurl" style="width:100%;border: 1px solid #e0dede;"/>
                                </div>
                                <div  v-else class="col-sm-8 " style="text-align:left">
                                    <img :src="item.picurl" style="height:300px;border: 1px solid #e0dede;"/>
                                </div>
                            </div>
                            <div v-if="item.content" class="col-sm-12" style="padding:0px;">
                                <div class="col-sm-2"></div>
                                <div  class="col-sm-8 " >
                                    <p class="p-font text2 val-img" style="text-align:left">
                                        {{item.content}}
                                    </p>
                                </div>
                            </div>
                            <div v-if="item.h3" class="col-sm-12" style="padding:0px;">
                                <div class="col-sm-2"></div>
                                <div  class="col-sm-8 " >
                                    <p class="head3 head3-color-news" style="text-align:left">
                                        {{item.h3}}
                                    </p>
                                </div>
                            </div>
                            <div v-if="item.h2" class="col-sm-12" style="padding:0px;">
                                <div class="col-sm-2"></div>
                                <div  class="col-sm-8 " >
                                    <p class="h2 head3-color-news" style="text-align:left">
                                        {{item.h2}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" style="padding:0px;">
                            <div class="col-sm-2"></div>
                            <div  class="col-sm-8 " >
                                <a @click="toNews()" v-if="returnlanguage" class="link" style="background: #F6F6F6;padding: 8px 32px;">
                                  返回新闻目录
                                </a>
                                <a @click="toNews()" v-else class="link" style="background: #F6F6F6;padding: 8px 32px;">
                                  return
                                </a>
                            </div>
                        </div>
                    <!-- </div> -->
                    <div class="col-sm-12 margin2-top" style="padding:0;border-bottom:1px solid rgb(210, 208, 208);"></div>
                </div>
            </div>
        </div>
    </div>
    <Bottom></Bottom>
  </div>
</template>
<script src="node_modules/tinymce/tinymce.min.js"></script>
<script>  
  import '../assets/ebro/css/site1.css'
  import '../assets/ebro/css/navigation.css'
  import '../assets/ebro/css/common.css'
  import '../assets/ebro/css/homepage.css'
  import { mapGetters, mapActions } from 'vuex'
  import Bottom from './bottom.vue'
  import Global from './Global.vue'
  import Top from './head.vue'
/*   import VueTinymce from './vue-tinymce.vue'; */

  export default {
    mounted: function() {
        window.addEventListener('scroll', this.chooseId)
    },
    computed: {
      ...mapGetters({
        newsdetail:'newsdetail',
      })
    },
    created() {
        var params = this.$route.params
        this.$store.dispatch('newsdetail', params)
      this.timeoutBlock = setTimeout(() => {
        this.scrollTo("toptarget")
        this.returnlanguage = this.newsdetail.language;
        }
      ,100)
    },
    watch:{
/*       'NewsFileEN':function(){
         this.head = this.NewsFileEN.head
         this.newslist = this.NewsFileEN.newslist
         this.language = false;
      },
      'NewsFileZH':function(){
         this.head = this.NewsFileZH.head
         this.newslist = this.NewsFileZH.newslist
         this.language = true;
      } */
      'newsdetail':function(){
          this.article = this.newsdetail.Result
      }
    },
    methods: {
        toNews:function(){
            this.$router.push({'path': '/news/'+this.$route.params.lang})
        },
         scrollTo:function(page){
/*                 debugger
                document.getElementById(page).scrollIntoView(true);  */
                window.scrollTo(0,0); 
         },
         chooseId:function(){
/*           this.changeopacity("ontology")
          this.changeopacity("painpoint")
          this.changeopacity("vision")
          this.changeopacity("eco")
          this.changeopacity("application") */
         
         },
         changeopacity:function(id){
          var $target = $("#"+id);
          var clientheight = document.body.clientHeight;
          var box = document.getElementById(id);
          var pos = box.getBoundingClientRect();
/*           console.log("top: "+pos.top);
          console.log("bottom: "+pos.bottom);
          console.log("clientheight: "+clientheight); */
          var height = pos.bottom - pos.top
          var num = pos.bottom/height;
          var num1 = (clientheight - pos.top)/height
          console.log("num: "+num);
          if(pos.top < 0 && pos.bottom >0){
            if(num < 0.4 && num >0){
                $target.css("opacity",num) 
            }else{
                $target.css("opacity","1") 
            }              
          }else{
            if(pos.top < clientheight && pos.bottom >clientheight && pos.top >0){
                if(num1 < 0.4 && num1 >0){
                    $target.css("opacity",num1) 
                }else{
                    $target.css("opacity","1") 
                }
            }
          }
         },
         toApp:function(id){
             this.$router.push({'path': '/application/'+id+'/'+Global.language})
         }
/*       navColor:function () {
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
      }, */
     },
    data() {
      return {
        icontest:'icon-shenfenzhengming ',
        returnlanguage:false,
        article:{},
        scrnum:'',
        head:{},
        newslist:[],
        teamPage:{},
        communityPage:{},
        partnerPage:{},
        footerPage:{},
        content: '<p>html content</p>',
        setting: {
            height: 200,
            language_url: "langs/zh_CN.js",
            block_formats: "Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;"
        }
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
