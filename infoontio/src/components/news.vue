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
<!--     <div class="col-sm-12 margin1-top"  ></div> -->
<!--       <vue-tinymce
    ref="tinymce"
    v-model="content"
    :setting="setting">
  </vue-tinymce> -->
<!-- ONTOLOGY NETWORK -->
    <div class="home-page-content news-first-container " id="homeFri" >
        <div class="container home-detail zindex container-pos" >
            <!-- <div class="firstback-text"><h1 class="firstback-text-font">ONT</h1></div> -->
        <div class="row">
            <!-- <div class="back-mask"></div> -->
            <div class="midpoint home-text-fir home-text-fir-firstPage text-center" >
                  <!-- <div  class="item-icon"></div> -->
                  <div class="title-margin margin2-top">
                      <h1> 
                          <span class="head-float">
                              <span class="firstTitle-font " v-if="language == 0">Press Releases</span>
                              <span class="firstTitle-font " v-if="language == 1">新闻列表</span>
                              <span class="firstTitle-font font_korean" v-if="language == 2">언론 보도</span>
                              <span class="firstTitle-font" v-if="language == 3">ニュース一覧</span>
                          </span>
<!--                           <span class="head-float h1-EN">
                               {{firstPage.titleEN}}
                          </span> -->
                          <div class="clear"></div>
                      </h1>
                  </div>
            </div>
        </div>
        </div>
    </div>
    <div class="news-wrapper  margin2-top" >
      <div  v-for="(item,index) in presslist"  class="newsContent" v-bind:style="{backgroundImage: 'url(' + item.PicUrl + ')'}" @click="toArticle(item.OutLineFlag,item.Id,item.OutLine)">
        <div  class=" newtoppic "></div>
        <div v-if="!item.outLineFlag" class="newtoptext">
            <h3 class="news-item-h3" style="line-height:1.3">
                <span v-if="language == 1" style="color: #ffffff;">
                    {{item.Title.substr(0,20)}}...
                </span>
                <span v-else style="color: #ffffff;">
                    {{item.Title.substr(0,35)}}...
                </span>
            </h3>
            <!-- <h3 class="news-item-h3" style="line-height:1.3" >{{item.newtitle.substr(0,24)}}</h3> -->
            <p class="news-item-t3" style="margin-top:8px;color: #ffffff;" v-if="language ==1">由 {{item.Author}} 发表于 {{item.NewsTime}}</p>
            <p class="news-item-t3" style="margin-top:8px;color: #ffffff;" v-else-if="item.Author.length > 10">
                By {{item.Author.substr(0,10)}}... | Updated {{item.NewsTime}}
            </p>
            <p class="news-item-t3" style="margin-top:8px;color: #ffffff;" v-else>
                By {{item.Author}} | Updated {{item.NewsTime}}
            </p>
<!--             <p class="news-item-t2" style="margin-top:12px;line-height:1.5" v-if="language">{{item.Summary.substr(0,30)}}...</p>
            <p class="news-item-t2" style="margin-top:12px;line-height:1.5" v-else>{{item.Summary.substr(0,50)}}...</p> -->
        </div>
        <div v-else  >
            <h3 class="news-item-h3" style="line-height:1.3">
                <span v-if="item.newtitle.length >36">
                    {{item.newtitle}}
                </span>
                <span v-else>
                    {{item.newtitle}}
                </span>
            </h3>
            <p class="news-item-t3" style="margin-top:16px;" v-if="language == 1">由 {{item.Author}} 发表于 {{item.NewsTime}}</p>
            <p class="news-item-t3" style="margin-top:16px" v-else>By {{item.Author}} | Updated {{item.NewsTime}}</p>
            <p class="news-item-t2" style="margin-top:20px;line-height:1.5">{{item.Summary.substr(0,100)}}...</p>
        </div> 
      </div>
    </div>
    <div  id="communityPage" class="home-page-content back-color container-padding-first container-val-background " style="z-index:10;">
        <div class="container home-detail zindex ">
            <div class="container-margin-ontdesc">
                <div class="row " style="color:black">
                    <div class="col-sm-12" style="padding:0;border-bottom:1px solid rgb(210, 208, 208);"></div>
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
        NewsFileEN: 'NewsFileEN',
        NewsFileZH: 'NewsFileZH',
        NewsFileKO: 'NewsFileKO',
        newslist:'newslist',
        pageDetail:'pageDetail'
      })
    },
    created() {
      this.timeoutBlock = setTimeout(() => {
        this.scrollTo("toptarget")
        }
      ,100)
    },
    watch:{
      'NewsFileEN':function(){
         this.head = this.NewsFileEN.head
         this.language = 0;
         this.search(0)
      },
      'NewsFileZH':function(){
         this.head = this.NewsFileZH.head
         this.language = 1;
         this.search(0)
      },
      'NewsFileKO':function(){
         this.head = this.NewsFileKO.head
         this.language = 2;
         this.search(0)
      },
      'pageDetail':function(){
         this.head = this.pageDetail.head
         this.language = 3;
         this.search(0)
      },
      'newslist':function(){
          debugger
          this.presslist = this.newslist.Result.NewsList
      }
    },
    methods: {        
        search:function(category){
            
            var params = this.$route.params
            params.language = (this.language == 1)?"cn":"en"
            params.category = category 
            params.pagesize = 100
            params.pagenumber = 1
            this.$store.dispatch('newslist',params)
        },
         toArticle:function(flag,ip,url){
             if(!flag){
                 this.$router.push({'path': '/press/'+ip+'/'+this.$route.params.lang})
             }else{
                 window.location.href=url;
             }
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
        language:false,
        scrnum:'',
        head:{},
        presslist:[],
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
@media only screen and (max-width: 768px) {
    .news-item-h3{
        font-size:16px;
        color: #324349;
    }  
    .news-item-t2{
        font-size:16px;
        color: #8E9496;
    }    
    .news-item-t3{
        font-size:12px;
        color: #324349;
    }  
    .newtoppic{
        height:202px;
    }
    .newtoptext{
        height:97px;
    }
}
@media only screen and (min-width: 769px) {
    .news-item-h3{
        font-size:20px;
        color: #324349;
    }   
    .news-item-t2{
        font-size:16px;
        color: #8E9496;
    }  
    .news-item-t3{
        font-size:14px;
        color: #324349;
    }  
    .newtoppic{
        height:188px;
    }
}
@media only screen and (min-width: 970px){
    .news-wrapper{
      width:960px
    }
}
@media only screen and (min-width: 650px) and (max-width: 970px){
    .news-wrapper{
      width:640px
    } 
}
@media only screen and (min-width: 330px) and (max-width: 650px){
    .news-wrapper{
      width:320px
    }
}
@media only screen and (max-width: 330px) {
    .news-wrapper{
      width:320px
    }
}
.news-wrapper{
    margin-left: auto;
    margin-right: auto;
    /* border-top:1px solid #8E9496; */
    display: table;
    cursor: pointer;
}
.newsContent{
    width:300px;
    height:300px;
/*     background:#F6F6F6; */
    float:left;
    margin:10px 10px;
    border:1px solid #F6F6F6;
    padding:0;
    background-size:100%;
}
.newsContent:hover{
    border:1px solid #3292AA;
}
.newtoppic{
    padding-left: -16px;
    padding-right: -16px;
    background-size: 100%;
}
.newtoptext{
    padding:16px;
    background-color: rgba(50,164,190,.8);
}
</style>
