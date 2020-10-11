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
    <div class="home-page-content ontView-first-container " id="homeFri" >
        <div class="container home-detail zindex container-pos" >
            <!-- <div class="firstback-text"><h1 class="firstback-text-font">ONT</h1></div> -->
            <div class="row">
                <!-- <div class="back-mask"></div> -->
                <div class="midpoint home-text-fir home-text-fir-firstPage text-center" >
                    <!-- <div  class="item-icon"></div> -->
                    <div class="title-margin  margin2-top">
                        <h1> 
                            <span class="head-float">
                                <span class="view-title" style="color: #32a4be;" v-if="language ==1">本体视点</span>
                                <span class="view-title" style="color: #32a4be;" v-if="language ==0">Ontology View</span>
                                <span class="view-title font_korean" style="color: #32a4be;" v-if="language ==2">온톨로지 들여다보기</span>
                                <span class="view-title" style="color: #32a4be;" v-if="language ==3">オントロジーの概要</span>
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
<!-- pc display -->
    <div class="ontView-wrapper margin2-top pc-display" >
      <div :id="'topNews'+index" v-for="(item,index) in topnews" v-bind:style="{backgroundImage: 'url(' + item.PicUrl + ')'}" class=" topContent "  v-if="index < 1"  @click="toArticle(item.Id)">
        <div v-if="index < 1" style="margin-top: 290px;width: 939px;">
<!--             <div>
                <img :src="item.PicUrl" style="width:100%"/>
            </div> -->
            <div class="col-sm-12 pc-display topnewsWrapper padding0">
                <div class="col-sm-1 pc-display "></div>
                <div class=" col-sm-10 ">
                    <h3 class=" margin3-top pc-newtitle" style="line-height:1.4;color:#ffffff;font-weight:700;" v-if="language ==1">{{item.Title.substr(0,25)}}...</h3>
                    <h3 class=" margin3-top pc-newtitle" style="line-height:1.4;color:#ffffff;font-weight:700;" v-if="language !=1">{{item.Title.substr(0,40)}}...</h3>
                    <p class="news-item-t3" style="margin-top:8px;line-height:1.4;color:#ffffff" v-if="language ==1">由 {{item.Author}} 发表于 {{item.NewsTime}}</p>
                    <p class="news-item-t3" style="line-height:1.4;color:#ffffff" v-else>By {{item.Author}} | Updated {{item.NewsTime}}</p>
                    <p  class="news-item-t2" style="margin-top:20px;line-height:1.8;color:#ffffff;">{{item.Summary.substr(0,114)}}...</p>
                </div>
                <div class="col-sm-1 pc-display "></div>
            </div>
        </div>
      </div>
      <div :id="'topNews'+index" v-for="(item,index) in topnews" class="viewtopContent" v-bind:style="{backgroundImage: 'url(' + item.PicUrl + ')'}" v-if="index > 0" @click="toArticle(item.Id)">
<!--         <div>
                <img :src="item.PicUrl" style="width:100%"/>
        </div> -->
        <div class="toplistnewswrapper">
            <h3 class="news-item-h3 topnewsitemtitle" >{{item.Title.substr(0,11)}}...</h3>
            <p class="news-item-t3 topnewsitemauthor"  v-if="language ==1">由 <span class="bloded">{{item.Author}}</span> 发表于 <span class="bloded">{{item.NewsTime}}</span></p>
            <p class="news-item-t3 topnewsitemauthor"  v-else>By <span class="bloded">{{item.Author.length>10?item.Author.substr(0,9)+"...":item.Author}}</span> | Updated <span class="bloded">{{item.NewsTime}}</span></p>
            <p class="news-item-t3 topnewsitemcontent margin3-bottom" >{{language==1?item.Summary.substr(0,30):item.Summary.substr(0,60)}}...</p>
        </div>
 
      </div>
      <div class="col-sm-12 margin3-top margin3-bottom" style="padding:0;border-bottom:1px solid rgb(210, 208, 208);margin-left:10px;margin-right:10px;width:940px;"></div>
      <div class="viewWrapper">
        <div class="col-sm-12 padding0" >
            <div class="col-sm-10 news-item-h3 viewWrappertitle viewWrappertitle-pos" v-if="language ==1">文章列表</div>
            <div class="col-sm-10 news-item-h3 viewWrappertitle viewWrappertitle-pos" v-if="language ==0">Articles</div>
            <div class="col-sm-10 news-item-h3 viewWrappertitle viewWrappertitle-pos" v-if="language ==2">기사 목록</div>
            <div class="col-sm-10 news-item-h3 viewWrappertitle viewWrappertitle-pos" v-if="language ==3">記事</div>
            <div class="col-sm-2 viewWrapper-btn viewWrapper-btn-pos" style="text-align:right"></div>
        </div>
        <div v-for="(item,index) in Newslist" class="viewContent"  @click="toArticle(item.Id)">
            <div class="newestlistimg">
                <img :src="item.PicUrl" style="height:140px;width:140px;"/>
            </div>
            <div class=" newestlisttext">
                <h3 class="news-item-t3 viewitemtitle" style="line-height:1.5;color:#324349">{{item.Title}}</h3>
                <p class="news-item-t3 viewitemauthor" style="margin-top:8px;" v-if="language ==1">由 <span class="bloded">{{item.Author}}</span> 发表于 <span class="bloded">{{item.NewsTime}}</span></p>
                <p class="news-item-t3 viewitemauthor" style="margin-top:8px" v-else>By <span class="bloded">{{item.Author}}</span> | Updated <span class="bloded">{{item.NewsTime}}</span></p>
                <p class="news-item-t2" style="margin-top:16px;line-height:1.5;font-size:14px">{{item.Summary.substr(0,100)}}...</p>

            </div>
        </div>
        <div class="col-sm-12 padding0" >
            <div class="col-sm-12 viewWrapper-btn viewWrapper-btn-pos-bottom" style="text-align:right"></div>
        </div>
      </div>
    </div>
<!-- mobile display -->
    <div class="mobile-ontView-wrapper margin3-top mobile-display" >
      <div :id="'topNews0'+index" v-for="(item,index) in topnews" class=" mobile-topContent col-xs-12 padding0"  v-bind:style="{backgroundImage: 'url(' + item.PicUrl + ')'}"  @click="toArticle(item.Id)">
<!--             <div class="mobile-top-pic">
                <img :src="item.PicUrl" style="width:100%"/>
            </div>            --> 
            <div class="mobile-topnewsWrapper col-xs-12 ">
                <h3 class=" margin3-top pad-display-margin-bottom mobile-newtitle" style="line-height:1.4;color:#ffffff;font-weight:700;">{{item.Title}}</h3>
                <p class="news-item-t3 pad-display" style="margin-top:8px;line-height:1.4;color:#d8d8d8" v-if="language ==1">由 {{item.Author}} 发表于 {{item.NewsTime}}</p>
                <p class="news-item-t3 margin3-top pad-display" style="line-height:1.4;color:#d8d8d8" v-else>By {{item.Author}} | Updated {{item.NewsTime}}</p>
                <p class="pad-display"  style="margin-top:20px;line-height:1.8;color:#ffffff;">{{item.Summary.substr(0,114)}}</p>
            </div>
      </div>
      <div class="col-xs-12 margin3-top margin3-bottom" style="padding:0;border-bottom:1px solid rgb(210, 208, 208);"></div>
      <div class="mobile-viewWrapper">
        <div class="col-xs-12 padding0" >
            <div class="col-xs-7 news-item-h3 viewWrappertitle viewWrappertitle-pos" v-if="language ==1">文章列表</div>
            <div class="col-xs-7 news-item-h3 viewWrappertitle viewWrappertitle-pos" v-if="language ==0">Articles</div>
            <div class="col-xs-7 news-item-h3 viewWrappertitle viewWrappertitle-pos" v-if="language ==2">기사 목록</div>
            <div class="col-xs-7 news-item-h3 viewWrappertitle viewWrappertitle-pos" v-if="language ==3">記事</div>
            <div class="col-xs-5 viewWrapper-btn viewWrapper-btn-pos" style="text-align:right"></div>
        </div>
        <div v-for="(item,index) in Newslist" class="mobile-viewContent"  @click="toArticle(item.Id)">
            <div class="mobile-newestlistimg">
                <img :src="item.PicUrl" style="height:100%"/>
            </div>
            <div class=" mobile-newestlisttext">
                <h3 class="news-item-t3 mobile-viewitemtitle-cn" style="line-height:1.5;color:#324349;    height: 44px;" v-if="language ==1">
                    {{item.Title.length<20?item.Title:item.Title.substr(0,20)+"..."}}
                </h3>
                <h3 class="news-item-t3 mobile-viewitemtitle" style="line-height:1.5;color:#324349;    height: 44px;" v-else>
                    {{item.Title.length<40?item.Title:item.Title.substr(0,40)+"..."}}
                </h3>
                <p class="news-item-t3 viewitemauthor iphone5no" style="margin-top:4px;" v-if="language ==1">由 <span class="bloded">{{item.Author}}</span> 发表于 <span class="bloded">{{item.NewsTime}}</span></p>
                <p class="news-item-t3 viewitemauthor iphone5no" style="margin-top:4px" v-else>By <span class="bloded">{{item.Author}}</span> | Updated <span class="bloded">{{item.NewsTime}}</span></p>
            </div>
        </div>
        <div class="col-xs-12 padding0" >
            <div class="col-xs-12 viewWrapper-btn viewWrapper-btn-pos-bottom" style="text-align:right"></div>
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
        newslist:'newslist',
        ontViewEN: 'ontViewEN',
        ontViewKO: 'ontViewKO',
        ontViewZH: 'ontViewZH',
        pageDetail:'pageDetail'
      })
    },
    created() {
      this.timeoutBlock = setTimeout(() => {
        this.scrollTo("toptarget")
        }
      ,100)
/*       this.timeoutBlock1 = setTimeout(() => {
        this.imgInit()
        }
      ,500) */
    },
    watch:{
      'ontViewEN':function(){
         this.head = this.ontViewEN.head
         this.language = 0;
/*          this.search(1)
         this.search(2) */
      },
      'ontViewZH':function(){
          debugger
         this.head = this.ontViewZH.head
         this.language = 1;
      },
      'ontViewKO':function(){
          debugger
         this.head = this.ontViewKO.head
         this.language = 2;
      },
      'pageDetail':function(){
         this.head = this.pageDetail.head
         this.language = 3;
      },
      'newslist':function(){
          debugger
         var flagitem = this.newslist.Result.NewsList[0]
         var flag = flagitem.Category
         if(flag==2){
             this.topnews = this.newslist.Result.NewsList
             this.topnewslist = this.newslist.Result.NewsList
             
         /* this.imgInit() */
         }else{
             this.Newslist = this.newslist.Result.NewsList
         }
      }
    },
    methods: {
        imgInit:function(){
            debugger
            $('#topNews0').attr("style","background-image:url("+this.topnews[0].PicUrl+")")
            $('#topNews1').attr("style","background-image:url("+this.topnews[1].PicUrl+")")
            $('#topNews2').attr("style","background-image:url("+this.topnews[2].PicUrl+")")
            $('#topNews3').attr("style","background-image:url("+this.topnews[3].PicUrl+")")
            $('#topNews00').attr("style","background-image:url("+this.topnews[0].PicUrl+")")
            $('#topNews01').attr("style","background-image:url("+this.topnews[1].PicUrl+")")
            $('#topNews02').attr("style","background-image:url("+this.topnews[2].PicUrl+")")
            $('#topNews03').attr("style","background-image:url("+this.topnews[3].PicUrl+")")
        },
        search:function(category){
            
            var params = this.$route.params
            params.language = this.language?"cn":"en"
            params.category = category 
            params.pagesize = 20
            params.pagenumber = 1
            this.$store.dispatch('newslist',params)
        },
         toArticle:function(ip){
           this.$router.push({'path': '/view-point/'+ip+'/'+this.$route.params.lang})
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
        Newslist:[],
        topnews:[],
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
@media only screen and (max-width: 360px){
    .iphone5no{
      display: none;
    }
}
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
    .mobile-newtitle{
        font-size: 24px;
    }
}
@media only screen and (min-width: 769px) {
    .news-item-h3{
        font-size:20px;
        color: #324349;
    }   
    .news-item-t2{
        font-size:18px;
        color: #8E9496;
    }  
    .news-item-t3{
        font-size:14px;
        color: #324349;
    }  
    .pc-newtitle{
        font-size: 32px;
    }
}
@media only screen and (min-width: 970px){
    .ontView-wrapper{
      width:940px
    }
    .viewWrapper{
      width:940px
    }
}
@media only screen and (min-width: 650px) and (max-width: 970px){
    .ontView-wrapper{
      width:640px
    } 
    .viewWrapper{
      width:640px
    }
}
@media only screen and (min-width: 330px) and (max-width: 650px){
    .ontView-wrapper{
      width:320px
    }
    .viewWrapper{
      width:320px
    }
}
@media only screen and (max-width: 330px) {
    .ontView-wrapper{
      width:320px
    }
    .viewWrapper{
      width:320px
    }
}
.ontView-wrapper{
    margin-left: auto;
    margin-right: auto;
    display: table;
    cursor: pointer;
}
.mobile-ontView-wrapper{
    margin-left: auto;
    margin-right: auto;
    cursor: pointer;
    width:95%;
}
.viewContent{
    width:892px;
    height:140px;
    background:#ffffff;
    float:left;
    margin:8px 24px;
    border:1px solid #F6F6F6;
}
.mobile-viewContent{
    width:96%;
    background:#ffffff;
    float:left;
    margin-top:8px;
    margin-bottom:8px;
    margin-left:2%;
    margin-right:2%;
    border:1px solid #F6F6F6;
    display: inline-flex;
}
.viewtopContent{
/*     padding:21px 24px 0; */
    width:300px;
    background:#32a4be;
    float:left;
    margin:10px 10px 0 10px;
    border:1px solid #F6F6F6;
    background-repeat: no-repeat;
    background-size:100%;
}
.viewtopContent:hover > .topnewsitemauthor {
    color:#ffffff;
}
.viewtopContent:hover >  .topnewsitemcontent {
    color:#ffffff;
}
.topContent{
    background:round;
    width:940px;
    height:525px;
    background:#F6F6F6 no-repeat;
    float:left;
    margin:10px 10px;
    border:1px solid #F6F6F6;
    background-position-x: center;
    background-position-y: center;
    background-size: 100%;
}
.mobile-topContent{

    width:100%;
    height: 100%;
    background:#F6F6F6 no-repeat;
    float:left;
    margin:10px 0px;
    border:1px solid #F6F6F6;
    background-position-x: center;
    background-position-y: center;
    background-size: cover;
}
.topnewsWrapper{
    height: 235px;
    background-color: rgba(50,164,190, 0.8);
}
.topnewsWrapper:hover{
    height: 235px;
    background-color: rgba(50,164,190, 0.9);
}
.mobile-topnewsWrapper{
    margin-top: 200px;
    background-color:  rgba(50,164,190, 0.8);
}
.view-title{
    color:#324349;
}
.bloded{
    font-weight:700
}
.topnewsitemtitle{
    line-height:1.4;
    color:#ffffff  !important;
    font-weight:700;
}
.topnewsitemauthor{
    margin-top:16px;
    line-height:1.4;
    color:#ffffff !important;
}

.topnewsitemcontent{
    margin-top:20px;
    line-height:1.4;
    color: #ffffff !important;
}
.viewWrapper{
    background-color:  #F6F6F6;
    display: table;
    margin:0 10px;
}
.mobile-viewWrapper{
    background-color:  #F6F6F6;
    display: table;
    margin:0;
    width: 100%;
}
.viewWrappertitle{
    line-height:1.5;
    color:#8E9496;
    font-weight:700;
}
.viewWrappertitle-pos{
    padding-left:24px !important;
    margin:24px 0 16px;
}
.viewWrapper-btn{
    color: #324349;
    font-weight: Bold;
    font-size: 18px
}
.viewWrapper-btn-pos{
    padding-right:24px !important;
    margin:25px 0 17px;
}
.viewWrapper-btn-pos-bottom{
    padding-right:24px !important;
    margin:17px 0 25px;    
}
.viewitemtitle{
    line-height:1.5;
    color:#8E9496;
    font-weight:700;
    font-size: 18px
}
.mobile-viewitemtitle{
    line-height:1.4;
    color:#8E9496;
    font-weight:700;
    font-size: 15px;
}
.mobile-viewitemtitle-cn{
    line-height:1.4;
    color:#8E9496;
    font-weight:700;
    font-size: 15px;
    padding-right:30px;
}
.viewitemauthor{
    margin-top:16px;
    line-height:1.5;
    color: #8E9496
}
.viewitemcontent{
    margin-top:20px;
    line-height:1.5;
    color: #8E9496
}
.newestlistimg{
    height: 140px;
    width: 140px;
    float: left;
}
.newestlisttext{
    height: 140px;
    width: 750px;
    padding:16px 24px ;
    float: left;
}
.mobile-newestlistimg{
    width: 80px;
    height: 80px;
    float: left;
}
.mobile-newestlisttext{
    width: 80%;
    padding:7px 8px 7px 12px;
    float: left;
}
.mobile-top-pic{
        height: 100%;
    position: absolute;
    left: 50%;
    transform: translate(-50% );
    max-height:400px;
}
@media only screen and (max-width: 520px) {
    .pad-display{
      display: none;
    }
    .pad-display-margin-bottom{
        margin-bottom:16px !important;
    }
}
@media only screen and (min-width: 521px) and (max-width: 768px){
    .pad-display{
      display: block;
    }
}
.toplistnewswrapper{
    padding:21px 24px 0;    
    height: 100%;
    background: rgba(50, 164, 190, 0.8);
}
.toplistnewswrapper:hover{
    padding:21px 24px 0;    
    height: 100%;
    background: rgba(50, 164, 190, 0.9);
}
</style>
