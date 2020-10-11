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
                    <div class="title-margin  margin3-top">
                        <h1> 
                            <span class="head-float">
                                <span class="view-title" style="color: #32a4be;" v-if="language ==1">本体候选节点列表</span>
                                <span class="view-title" style="color: #32a4be;" v-if="language ==0">Ontology Triones Candidate List</span>
                                <span class="view-title font_korean" style="color: #32a4be;" v-if="language ==2">온톨로지 노드 목록</span>
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
    <div class="ontView-wrapper margin3-top " >
      <div class=" nodetopContent " >
        <div class="col-sm-1 padding0"></div>
        <div class="col-sm-10 padding0">
          <img src="/static/img/节点地图.png" class="node-map"/>
        </div>
        <div class="col-sm-1 padding0"></div>
      </div>
<!--       <div class="col-sm-12 node-region-pc-display" >
        <div class="col-sm-1 " ></div>
        <div class="col-sm-10 col-xs-12 padding0 nodechauwrapper node-region-pc-display" >
            <div  v-for="(item,index) in area" class=" col-sm-3 padding0"   @click="toChaulist(item.region,index)">
                <div :id="'chau'+index" class="nodetoplistnewswrapper">
                    <h3 class="node-chau-h3 " >● <span :id="'chautext'+index" style="color:#3f3f3f">{{item.name}}</span></h3>
                </div>
            </div>
        </div>
      </div>
      <div class="col-sm-12 col-xs-12 padding0 nodechauwrapper node-region-mobile-display">
        <div  v-for="(item,index) in area" class=" col-xs-6 padding0"   @click="toChaulist(item.region,index)">
            <div :id="'mchau'+index" class="nodetoplistnewswrapper">
                <h3 class="node-chau-h3 " >● <span :id="'mchautext'+index" style="color:#3f3f3f">{{item.name}}</span></h3>
            </div>
        </div>
      </div> -->
      <div class="col-sm-12 node-region-pc-display" >
        <div class="col-sm-1 " ></div>
        <div class="col-sm-10 col-xs-12 padding0 nodechauwrapper node-region-pc-display" >
            <div   class=" col-sm-6 padding0"   @click="swtichlist(1)">
                <div v-if="candornodeflag ==0 " id="Candidateback" class="nodetoplistnewswrapper">
                    <h3 class="node-chau-h3 " >● <span  style="color:#3f3f3f">{{node2.Candidate}}</span></h3>
                </div>
                <div v-else id="Candidateback" class="nodetoplistnewswrapper nodetoplistnewswrapperback">
                    <h3 class="node-chau-h3 " >● <span  style="color:#3f3f3f">{{node2.Candidate}}</span></h3>
                </div>
            </div>
            <div  class=" col-sm-6 padding0"   @click="swtichlist(0)">
                <div v-if="candornodeflag ==1 " id="Candidateback" class="nodetoplistnewswrapper">
                    <h3 class="node-chau-h3 " >● <span  style="color:#3f3f3f">{{node2.node}}</span></h3>
                </div>
                <div v-else id="Candidateback" class="nodetoplistnewswrapper nodetoplistnewswrapperback">
                    <h3 class="node-chau-h3 " >● <span  style="color:#3f3f3f">{{node2.node}}</span></h3>
                </div>
            </div>
        </div>
      </div>
      <div class="col-sm-12 col-xs-12 padding0 nodechauwrapper node-region-mobile-display">
        <div   class=" col-xs-6 padding0"   @click="swtichlist(1)">
                <div v-if="candornodeflag ==0 " id="Candidateback" class="nodetoplistnewswrapper">
                    <h3 class="node-chau-h3 " >● <span  style="color:#3f3f3f">{{node2.Candidate}}</span></h3>
                </div>
                <div v-else id="Candidateback" class="nodetoplistnewswrapper nodetoplistnewswrapperback">
                    <h3 class="node-chau-h3 " >● <span  style="color:#3f3f3f">{{node2.Candidate}}</span></h3>
                </div>
        </div>
        <div   class=" col-xs-6 padding0"   @click="swtichlist(0)">
                <div v-if="candornodeflag ==1 " id="Candidateback" class="nodetoplistnewswrapper">
                    <h3 class="node-chau-h3 " >● <span  style="color:#3f3f3f">{{node2.node}}</span></h3>
                </div>
                <div v-else id="Candidateback" class="nodetoplistnewswrapper nodetoplistnewswrapperback">
                    <h3 class="node-chau-h3 " >● <span  style="color:#3f3f3f">{{node2.node}}</span></h3>
                </div>
        </div>
      </div>
<!--       <div class="col-sm-12 " >
        <div class="col-sm-1 " ></div>
        <div class="col-sm-10 col-xs-12 padding0 nodechauwrapper " >
            <p>{{secondperiod1}}</p>
            <p style="margin-top:8px">{{secondperiod2}}</p>
        </div>
      </div> -->
      <div class="col-sm-12 col-xs-12" >
          <div class="col-sm-12 col-xs-12 margin6-top margin3-bottom " style="padding:0 10px;border-bottom:1px solid rgb(210, 208, 208);"></div>
      </div>
<!-- pc display -->
      <div class="nodeviewWrapper nodepc-display">
        <div v-for="(item,index) in Trionesshow" class="col-sm-12 node-wrapper"  >
            <div class="col-sm-1"></div>
            <div class="col-sm-2 node-head">
                <div class="col-sm-12" >
                    <div class="node-logo" v-bind:style="{backgroundImage: 'url(' + item.Logo + ')'}"></div>
                </div>
                <div class="col-sm-12 text-center" >
                    <h4 class="node-chauno" v-if="index == 0">{{index+1}}st</h4>
                    <h4 class="node-chauno" v-if="index == 1">{{index+1}}nd</h4>
                    <h4 class="node-chauno" v-if="index == 2">{{index+1}}rd</h4>
                    <h4 class="node-chauno" v-if="index >2">{{index+1}}th</h4>
                </div>
                <div class="col-sm-12 text-center" >
                    <!-- <span class="node-chau">{{getRegion(item.Region)}}</span> -->
                    <span class="node-chau">{{item.Region}}</span>
                </div>
            </div>
            <div class="col-sm-8 node-content-wrapper padding0">
                <div class="col-sm-12 node-content" >
                    <div class="col-sm-12 padding0" >
                        <h4 class="node-name" >{{item.Name}}</h4>
                    </div>
                    <div class="col-sm-12 padding0" >
                        <p class="node-intro">{{item.Introduce}}</p>
                    </div>
                    <div class="col-sm-12 padding0" >
                        <span class="node-value node-value7 col-sm-7 padding0"><span class="node-address">{{nodecommon.address}}</span>: <span class="node-address-value"> {{item.OntAddress}}</span></span>
                        <!-- <span class="node-value node-value5 col-sm-5 padding0 text-right node-balance-value node-balance-value-swap">{{toMoney(item.Balance)}} ONT {{item.SwapState == 1?' '+nodecommon.swap:''}}</span> -->
                        <span class="node-value node-value5 col-sm-5 padding0 text-right node-balance-value node-balance-value-swap">{{toMoney(item.Balance)}} ONT </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
      </div>
<!-- mobile -->
      <div class="nodeviewWrapper nodemobile-display">
        <div v-for="(item,index) in Trionesshow" class="col-xs-12 node-wrapper" >
            <div class="col-xs-12 node-head">
                <div class="col-xs-12 text-center" >
                    <div class="node-logo" v-bind:style="{backgroundImage: 'url(' + item.Logo + ')'}"></div>
                </div>
                <div class="col-xs-12 text-center" >
                    <h4 class="node-chauno" v-if="index == 0">{{index+1}}st</h4>
                    <h4 class="node-chauno" v-if="index == 1">{{index+1}}nd</h4>
                    <h4 class="node-chauno" v-if="index == 2">{{index+1}}rd</h4>
                    <h4 class="node-chauno" v-if="index >2">{{index+1}}th</h4>
                </div>
                <div class="col-xs-12 text-center" >
                    <span class="node-chau">{{item.Region}}</span>
                </div>
            </div>
            <div class="col-xs-12 node-content-wrapper padding0">
                <div class="col-xs-12 node-content" >
                    <div class="col-xs-12 padding0" >
                        <h4 class="node-name" >{{item.Name}}</h4>
                    </div>
                    <div class="col-xs-12 padding0" >
                        <p class="node-intro">{{item.Introduce}}</p>
                    </div>
                    <div class="col-xs-12 padding0" >
                        <p class="node-value col-xs-12 padding0" style="word-break: break-all;"><span class="node-address col-xs-12 padding0">{{nodecommon.address}}: </span><span class="node-address-value col-xs-12 "> {{item.OntAddress}}</span></p>
                        <p  class="node-value col-xs-12 padding0 "><span class="node-balance col-xs-12 padding0">{{nodecommon.balance}}: </span><span class="node-balance-value col-xs-12 padding0">{{toMoney(item.Balance)}} ONT</span></p>
                        <!-- <p v-else class="node-value col-xs-12 padding0 "><span class="node-balance col-xs-12 padding0">{{nodecommon.balance}}: </span><span class="node-balance-value-swap col-xs-12 padding0">{{toMoney(item.Balance)}} ONT {{nodecommon.swap}}</span></p> -->
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="margin2-top col-sm-12 col-xs-12"></div>
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
        TrionesListEN: 'TrionesListEN',
        TrionesListZH: 'TrionesListZH',
        trioneslist:'trioneslist'
      })
    },
    created() {
      this.timeoutBlock = setTimeout(() => {
        this.scrollTo("toptarget")
        this.toChaulist("All",0)
        }
      ,100)
      this.intervalBlock1 = setInterval(() => {
        this.$store.dispatch('trioneslist',this.params)
      }, 30000)
/*       this.timeoutBlock1 = setTimeout(() => {
        this.imgInit()
        }
      ,500) */
    },
    watch:{
      'TrionesListEN':function(){
         this.head = this.TrionesListEN.head
         this.area = this.nodeEN.area
         this.nodecommon = this.nodeEN
         this.language = 0;
         this.node2= this.node2EN
         this.secondperiod1 = "It’s been nearly two months since we started our seed node recruitment process on June 1st, 2018. below is an overview of the complete first Ontology node candidate list.";
         this.secondperiod2 = "This recruitment has attracted 47 candidate teams from countries over six continents, countries including China, Japan, Singapore, Australia, USA, Canada, Brazil, Netherlands, UAE, Israel, and more. 28 teams have entered the final recruitment and the total stake has reached 14,388,807 ONT.";
      },
      'TrionesListZH':function(){
         this.head = this.TrionesListZH.head
         this.area = this.nodeZH.area
         this.nodecommon = this.nodeZH
         this.language = 1;
         this.node2= this.node2ZH
         this.secondperiod1 = "从6月1日起，我们进行了为期近2个月的种子节点招募，现对正式入选的总名单进行公示。";
         this.secondperiod2 = "本次招募总计吸引来自6大洲，包含中国、日本、新加坡、澳大利亚、美国、加拿大、巴西、荷兰、阿联酋、以色列等国家在内的47支队伍参与，28支队伍进入最终评选。覆盖，抵押总额达14,388,807 ONT。";
      },
      'trioneslist':function(){
          debugger
          this.Triones = []
          this.Candidate = []
         /* this.Triones = this.trioneslist.Result */
         for(var i=0;i<this.trioneslist.Result.length;i++){
             if(this.trioneslist.Result[i].SwapState == "0"){
                 this.Triones.push(this.trioneslist.Result[i])
             }else{
                 this.Candidate.push(this.trioneslist.Result[i])
             }
         }
         if(this.candornodeflag == 0){
             this.Trionesshow = this.Triones
         }else{
             this.Trionesshow = this.Candidate
         }
      }
    },
    methods: {
        getRegion:function(region){
            var str = region.substr(0,2)
            var showregion = ''
            if(str == "No"){
                showregion = "North America"
            }else{
                if(str == "So"){
                    showregion = "South America"
                }else{
                    showregion = region
                }
            }
            return showregion
        },
        toChaulist:function(region,index){
            this.activeChau(index)
            this.params = this.$route.params
            this.params.region = region
            this.$store.dispatch('trioneslist',this.params)
        },
        swtichlist:function($index){
            this.candornodeflag = $index
            this.$store.dispatch('trioneslist',this.params)
        },
        activeChau:function(index){
            for(var i=0;i<8;i++){
                var n = '#chautext'+i
                var m = '#mchautext'+i
                $(n).css("color","#3F3F3F")
                $(m).css("color","#3F3F3F")
            }
            $('#chautext'+index).removeAttr("style")
            $('#mchautext'+index).removeAttr("style")
        },
            toMoney:function (num){
                num = parseFloat(num)
                num = num.toLocaleString();
                return num;//返回的是字符串23,245.12保留2位小数
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
        timer:0,
        params:[],
        candornodeflag:1,
        setting: {
            height: 200,
            language_url: "langs/zh_CN.js",
            block_formats: "Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;"
        },
        Trionesshow:[],
        Triones:[],
        Candidate:[],
        node2:[],
        node2ZH:{
            Candidate:"候选节点",
            node:"节点"
        },
        node2EN:{
            Candidate:"Candidate Node",
            node:"Node"
        },
        nodeZH:{
            address:"地址",
            balance:"余额",
            area:[
               {
                 name:"所有",
                 region:"All"
               },
               {
                 name:"北美洲",
                 region:"NorthAmerica"
               },
               {
                 name:"南美洲",
                 region:"SouthAmerica"
               },
               {
                 name:"欧洲",
                 region:"Europe"
               },
               {
                 name:"亚洲1",
                 region:"Asia1"
               },
               {
                 name:"大洋洲",
                 region:"Oceania"
               },
               {
                 name:"非洲",
                 region:"Africa"
               },
               {
                 name:"亚洲2",
                 region:"Asia2"
               }
            ],
            swap:"置换中",
        },
        nodeEN:{
            address:"Address",
            balance:"Balance",
            area:[
               {
                 name:"All",
                 region:"All"
               },
               {
                 name:"North America",
                 region:"NorthAmerica"
               },
               {
                 name:"South America",
                 region:"SouthAmerica"
               },
               {
                 name:"Europe",
                 region:"Europe"
               },
               {
                 name:"Asia Ⅰ",
                 region:"Asia1"
               },
               {
                 name:"Oceania",
                 region:"Oceania"
               },
               {
                 name:"Africa",
                 region:"Africa"
               },
               {
                 name:"Asia Ⅱ",
                 region:"Asia2"
               }
            ],
            swap:"Swapping",
        },
        area:[]
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
    .node-logo{
        width: 63px;
        height: 70px;
        margin-top: 24px;
        margin-bottom: 24px;
        background-size: 100%;
        background-repeat: no-repeat;
        margin-left: auto;
        margin-right: auto;
    }
    .node-wrapper{
        margin-bottom: 16px;
    }
    .node-chau-h3{
        font-weight: 700;
        line-height: 1.4;
        text-align: left;
        padding-left: 8px;
    }   

}
@media only screen and (min-width: 768px) {
    .node-chau-h3{
        font-size: 18px;
        font-weight: 700;
        line-height: 1.4;
        text-align: left;
        padding-left: 24px;
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
    .node-logo{
        margin-top: 24px;
        height: 100px;
        width: 90px;
        background-size: 100%;
        background-repeat: no-repeat;
        margin-left: auto;
        margin-right: auto;
    }
    .node-wrapper{
        margin-bottom: 16px;
    }
}
@media only screen and (min-width: 970px){
    .ontView-wrapper{
      width:940px
    }
    .nodeviewWrapper{
      width:940px
    }
    .node-region-pc-display{
        display: block;
    }
    .node-region-mobile-display{
        display: none;
    }
    .nodemobile-display{
        display: none;
    }
    .nodepc-display{
        
        display: block;
    }
    .nodechauwrapper{
        margin-bottom: 16px;
    }
    .node-content-wrapper{
        background-color: #F1F3F3;
        height: 188px;
    }
    .node-intro{
        height: 90px;
        overflow:hidden;
    }
}
@media only screen and (max-width: 970px){
    .node-region-mobile-display{
        display: block;
    }
    .node-region-pc-display{
        display: none;
    }
    .nodemobile-display{
        display: block;
    }
    .nodepc-display{
        
        display: none;
    }
    .node-content-wrapper {
        background-color: #F1F3F3;
        height: 230px;
    }
    .nodechauwrapper{
        margin-bottom: 0px;
    }
    .node-content-wrapper{
        background-color: #F1F3F3;
        display: table;
    }
}
@media only screen and (min-width: 650px) and (max-width: 970px){
    .ontView-wrapper{
      width:640px
    } 
    .nodeviewWrapper{
      width:640px
    }
}
@media only screen and (min-width: 330px) and (max-width: 650px){
    .ontView-wrapper{
      width:320px
    }
    .nodeviewWrapper{
      width:320px
    }
}
@media only screen and (max-width: 330px) {
    .ontView-wrapper{
      width:320px
    }
    .nodeviewWrapper{
      width:320px
    }
}
.ontView-wrapper{
    margin-left: auto;
    margin-right: auto;
    display: table;
}
.mobile-ontView-wrapper{
    margin-left: auto;
    margin-right: auto;
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
    font-weight:700;
}
.topnewsitemauthor{
    margin-top:16px;
    line-height:1.4;
    color:#ffffff !important;
}

.nodeviewWrapper{
    margin:10px 0;
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
.nodeviewWrapper-btn{
    color: #324349;
    font-weight: Bold;
    font-size: 18px
}
.nodeviewWrapper-btn-pos{
    padding-right:24px !important;
    margin:25px 0 17px;
}
.nodeviewWrapper-btn-pos-bottom{
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
.nodetoplistnewswrapper{
/*     margin:0px 10px 8px; */
    padding:8px 5px;
    height: 100%;
/*     border:2px solid #E4E4E4; */
    text-align: center;
    color:black;
    cursor: pointer;
}
.nodetoplistnewswrapper:hover{
    background: #EDF8FF !important;
}
.nodetoplistnewswrapperback{
    background: #EDF8FF !important;
}
.node-head{
    padding:0px;
    background-color: #EDF8FF ;
    height: 188px;
}
.node-chau{
    margin-top: 8px;
}
.node-chauno{
    margin-top: 8px;
    color: #32A4BE;
}
.node-content{
    padding-top:30px;
    padding-left: 24px !important;
    padding-right: 24px !important;
    font-size: 14px;
    line-height: 1.3;
}

.node-name{
    color:#3f3f3f;
    font-size:18px;
    font-weight: 700;
    margin-top: 0px;
    margin-bottom:12px;
}
#chau0{
    color:#3f3f3f;
}
#chau1{
    color:#CF9AE8;
}
#chau2{
    color:#CCC240;
}
#chau3{
    color:#3CB2D6;
}
#chau4{
    color:#D6A167;
}
#chau5{
    color:#E5767E;
}
#chau6{
    color:#3C58A0;
}
#chau7{
    color:#4EC689;
}
#mchau0{
    color:#3f3f3f;
}
#mchau1{
    color:#CF9AE8;
}
#mchau2{
    color:#CCC240;
}
#mchau3{
    color:#3CB2D6;
}
#mchau4{
    color:#D6A167;
}
#mchau5{
    color:#E5767E;
}
#mchau6{
    color:#3C58A0;
}
#mchau7{
    color:#4EC689;
}
.node-map{
    width: 100%;
}
.node-address{
    margin-top:8px;
    font-weight: 700;
}
.node-balance{
    margin-top:8px;
    font-weight: 700;
}
.node-address-value{
    margin-top:8px;
    font-size: 10px;
    color: #4A4A4A;
    background-color: #D8D8D8;
    padding: 2px 12px;
}
.node-balance-value{
    margin-top:8px;
    color: #32A4BE;
    font-weight: 700;
    margin-bottom:16px;
}
.node-balance-value-swap{
    margin-top:8px;
    color: #32A4BE;
    font-weight: 700;
    margin-bottom:16px;
}
.node-value{
    margin-top:8px;
}
.node-value7{
    width: 63%;
}
.node-value5{
    width: 37%;
}
</style>
