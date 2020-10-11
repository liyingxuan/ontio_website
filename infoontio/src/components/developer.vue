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
    
<!-- ONTOLOGY NETWORK -->
    <div id="developer" class="home-page-content back-color container-padding-first-dev container-val-background " style="z-index:10">
        <div  class="developer-banner-wrapper" >
            <div id="developer-banner" class=" home-detail zindex container-pos" >
                <div class="dev-content-container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1 class="dev-head">{{developer.head}}</h1>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-8 doc-wrapper">
                                <div class="col-sm-12 ">
                                    <span class="dev-doc-title">{{developer.Documentations}}</span>
                                </div>
                                <div class="col-sm-12 dev-doc-text-wrapper">
                                    <p class="dev-doc-text">{{developer.Docdesc}}</p>
                                </div>
   <!--                              <div class="col-sm-12 dev-letter-title-wrapper">
                                    <span class="dev-letter-title">{{developer.read}}:</span>
                                </div>
                                <div class="col-sm-12 doc-link-wrapper">
                                    <a class="dev-link" href="https://info.ont.io/view-point/E00007/en" target="_blank">{{developer.letter}}</a>
                                </div> -->
                                <div class="col-sm-12 ">
                                    <a href="https://ontio.github.io/documentation/" target="_blank"><div class="dev-btn-size dev-btn-w">{{developer.enter}}</div></a>
                                </div>
                                <div class="col-sm-12 wp-link-wrapper">
                                    <!-- <a class="dev-link" href="https://ontio.github.io/documentation/wp_download_zh.html" target="_blank">{{developer.readwp}}</a> -->
                                    <a class="dev-link" :href="developer.wpurl" target="_blank">{{developer.readwp}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="developer-content-wrapper" >
            <div  class=" home-detail zindex container-pos" >
                <div class="dev-content-container">
                    <div class="row">

                        <div class="col-sm-12 dev-hr-warpper-warpper">
                            <div class="col-sm-12 dev-tool-warpper-hr">
                                <div class="col-sm-12  dev-sf-content" style="    background-color: #32a4be;">
                                    <div class="col-sm-2 text-center pc-display">
                                        <h2 ><img  src="/static/img/developer/招聘 洽谈@2x.png"/></h2>
                                    </div>
                                    <div class="col-sm-8 dev-sf-text-wrapper text-center">
                                        <p class="dev-sf-text">{{developer.sfopening}}</p>
                                    </div>
                                    <div class="col-sm-2 padding0 text-center">
                                        <a href="/static/file/SF_opening_1808.pdf" target="_blank" class="text-center"><div class="dev-btn-size-sf dev-btn-d" style="margin:auto;margin:12px 0;    margin-left: auto;margin-right: auto;">{{developer.detail}}</div></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 dev-tool-warpper-warpper">
                            <div class="col-sm-6 dev-tool-warpper-left">
                                <div class="col-sm-12  dev-tool-content">
                                    <div class="col-sm-12 dev-tool-title-wrapper">
                                        <h2 class="dev-tool-title"><img class="tool-img" src="/static/img/developer/icon/smartx.png"/>{{developer.smartx}}</h2>
                                    </div>
                                    <div class="col-sm-12 dev-tool-text-wrapper">
                                        <p class="dev-tool-text">{{developer.smartxdesc}}</p>
                                    </div>
                                    <div class="col-sm-12 padding0">
                                        <a href="http://smartx.ont.io/#/" target="_blank"><div class="dev-btn-size dev-btn-b" style="margin:auto">{{developer.open}}</div></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 dev-tool-warpper-right">
                                <div class="col-sm-12  dev-tool-content">
                                    <div class="col-sm-12 dev-tool-title-wrapper">
                                        <h2 class="dev-tool-title"><img class="tool-img" src="/static/img/developer/icon/github.png"/>{{developer.github}}</h2>
                                    </div>
                                    <div class="col-sm-12 dev-tool-text-wrapper">
                                        <p class="dev-tool-text">{{developer.githubdesc}}</p>
                                    </div>
                                    <div class="col-sm-12 padding0">
                                        <a href="https://github.com/ontio" target="_blank"><div class="dev-btn-size dev-btn-g" style="margin:auto">{{developer.go}}</div></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 dev-apply-warpper-warpper"style="display:none;">
                            <div class="col-sm-5 dev-apply-warpper-left text-center">
                                <img src="/static/img/developer/Testing_ONT img.png" />
                            </div>
                            <div class="col-sm-7 dev-apply-warpper-right">
                                <div class="col-sm-12 padding0">
                                    <div class="col-sm-12 dev-apply-title-wrapper">
                                        <h2 class="dev-apply-title">{{developer.testapply}}</h2>
                                    </div>
                                    <div class="col-sm-12 dev-apply-text-wrapper">
                                        <h2 class="dev-apply-text">{{developer.testapplydesc}}</h2>
                                    </div>
                                    <div class="col-sm-12 padding0">
                                        <a href="" target="_blank"><div class="dev-btn-size dev-btn-o" style="margin:auto">{{developer.apply}}</div></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-12 dev-apply-warpper-warpper cutline"></div> -->
                    </div>
                </div>
            </div>
        </div>
        <div  class="developer-Bounty-wrapper" >
            <div  class=" home-detail zindex container-pos" >
                <div class="dev-content-container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1 class="dev-bounty-head">{{developer.Bountyhead}}</h1>
                        </div>
                        <div class="col-sm-12 text-center">
                            <p class="dev-bountydesc-text">{{developer.Bountytext}}</p>
                        </div>
                        <div class="col-sm-12 text-center">
                            <div class="col-sm-3 bounty-claim-item-wrapper" v-for="(item,index) in BountyContent">
                              <div class="bounty-claim-item">
                                  <img :src="item.picurl" class="bounty-claim-img" />
                                  <div class="col-sm-12 bounty-claim-text-wrapper" >
                                      <p class="bounty-claim-text">{{item.head}}</p>
                                  </div>
                                  <div class="col-sm-12 bounty-claim-bouns-wrapper" >
                                      <p class="bounty-claim-bouns">{{item.bouns}}</p>
                                  </div>
                              </div>
                              <div class="bounty-claim-item-hide">
                                    <div class="hiden-desc">{{item.desc}}</div>
                              </div>
                              <div class="bounty-claim-btn-wrapper" >
                                  <div v-if="item.able">
                                      <a :href="item.googleformurl" target="_blank"><div class="bounty-claim-btn">Claim it</div></a>
                                  </div>
                                  <div v-else>
                                      <div class="bounty-claim-btn-disable">Closed</div>
                                  </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center bounty-more-warpper" >
                            <div @click="gotobountypage()" style="cursor:pointer" class="bounty-more-warpper-warpper">
                                <img class="bounty-more-img"  src="/static/img/developer/icon/star_l.png" />
                                <div class="bounty-more-text"  style="margin:auto;">{{developer.Bountymore}}</div>
                            </div>
                            <div class="bounty-more-text1" >{{developer.Bountycontact1}}<a :href="developer.Bountysuggesturl" target="_blank" class="bounty_contact_url"><span > {{developer.Bountycontact2}}</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container home-detail zindex ">
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
  import Bottom from './bottomdev.vue'
  import Global from './Global.vue'
  import Top from './head.vue'

  export default {
    mounted: function() {
        window.addEventListener('scroll', this.chooseId)
    },
    computed: {
      ...mapGetters({
        CooperationZH: 'CooperationZH',
        CooperationEN: 'CooperationEN',
        CooperationKO: 'CooperationKO',
        cooperationsubmit:'cooperationsubmit',
        pageDetail:'pageDetail'
      })
    },
    created() {
      if(this.$route.params.lang == "zh"){
         this.developer = this.developerZH
      }else{
         this.developer = this.developerEN
      }
      console.log(this.$route.params.lang)
      this.timeoutBlock = setTimeout(() => {
        this.scrollTo("toptarget")
        }
      ,100)
    },
    watch:{
      'CooperationEN':function(){
         this.cooperation = this.CooperationEN.Cooperation
         this.footerPage = this.CooperationEN.footerPage
         this.language = 0;
      },
      'CooperationZH':function(){
         this.cooperation = this.CooperationZH.Cooperation
         this.footerPage = this.CooperationZH.footerPage
         this.language = 1;
      },
      'CooperationKO':function(){
         this.cooperation = this.CooperationKO.Cooperation
         this.footerPage = this.CooperationKO.footerPage
         this.language = 2;
      },
      'cooperationsubmit':function(){
          if(this.cooperationsubmit.Result){
             this.submitSuccess = true;
          }
      },
      'pageDetail':function(){
         this.cooperation = this.pageDetail.Cooperation
         this.footerPage = this.pageDetail.footerPage
         this.language = 0;
      },
      "$route.params.lang":function(){
            if(this.$route.params.lang == "zh"){
                this.developer = this.developerZH
            }else{
                this.developer = this.developerEN
            }
      }
    },
    methods: {
/*       enter:function(){
         alert("1111")
      }, */
      leave:function(){

      },
      back:function(){
         this.$router.push({'path': '/'})
      },
      gotobountypage:function(){
         this.$router.push({'path': '/bounty/'+this.$route.params.lang})
      },
         submit:function(){
            debugger
            if(this.name==""||this.contact==""||this.detail==""||this.field==""||this.phone==""){
                this.warnMsgFlag = true
                if(this.name==""){
                   this.inputWarn("cooname",true)
                }
                if(this.contact==""){
                   this.inputWarn("coocontact",true)
                }
                if(this.field==""){
                   this.inputWarn("coofield",true)
                }
                if(this.phone==""){
                   this.inputWarn("coophone",true)
                }
                if(this.detail==""){
                   this.inputWarn("coodetail",true)
                }
                return
            }else{
                this.warnMsgFlag = false
                this.inputWarn("cooname",false)
                this.inputWarn("coocontact",false)
                this.inputWarn("coodetail",false)
                this.inputSuccess()
                var params = this.$route.params 
                params.name = this.name 
                params.contact =this.contact
                params.field = this.field 
                params.phone =this.phone
                params.detail =this.detail
                this.$store.dispatch('cooperationsubmit',params)
            }
         },
         inputWarn:function(id,boolean){
             var $target = $("#"+id);
             debugger
             if(boolean){
                 $target.css("border","4px solid #324349")
             }else{
                 $target.css("border","2px solid #32A4BE")
             }             
         },
         inputSuccess:function(){
             $("#cooname").css("border","0px solid #324349")
             $("#cooname").attr("readonly","true")
             $("#coocontact").css("border","0px solid #324349")
             $("#coocontact").attr("readonly","true")
             $("#coophone").css("border","0px solid #324349")
             $("#coophone").attr("readonly","true")
             $("#coofield").css("border","0px solid #324349")
             $("#coofield").attr("readonly","true")
             $("#coodetail").css("border","0px solid #324349")
             $("#coodetail").attr("readonly","true")
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
        submitSuccess:false,
        warnMsgFlag:false,
        name:'',
        field:'',
        phone:'',
        contact:'',
        detail:'',
        icontest:'icon-shenfenzhengming ',
        language:false,
        scrnum:'',
        head:{},
        cooperation:{},
        footerPage:{},
        developer:{},
        developerZH:{
            head:"开发者中心",
            Documentations:"文档中心",
            Docdesc:"本体所有的技术文档可通过点击下方链接查看。",
            read:"阅读",
            letter:"一封给技术社区的公开信",
            enter:"进入",
            readwp:"阅读白皮书",
            wpurl:"https://ontio.github.io/documentation/wp_download_zh.html",
            smartx:"SmartX",
            smartxdesc:"SmartX是一个可用于编译、部署和调用智能合约的一站式IDE，提供丰富的智能合约模板以及强大的在线编辑器。",
            github:"GitHub",
            githubdesc:"本体项目已在GitHub开源，欢迎开发人员加入我们的GitHub技术社区。",
            go:"Go",
            open:"Open",
            detail:"Detail",
            testapply:"Developer Centre",
            testapplydesc:"Developer Centre",
            apply:"Developer Centre",
            Bountyhead:"激励计划",
            Bountytext:"欢迎领取激励任务赢得奖赏。",
            Bountymore:"查看更多",
            Bountycontact1:"如果您有新的需求及建议,",
            Bountycontact2:"敬请联系 ",
            Bountysuggesturl:"https://docs.google.com/forms/d/e/1FAIpQLSeowE6jO0xpQzgyZkB0I7C2CeNdK5t1r5-Jd3J3kZKxGoO-_Q/viewform?usp=pp_url",
            sfopening:"本体旧金山办公室开放招聘!"
        },
        developerEN:{
            head:"Developer Center",
            Documentations:"Documentation",
            Docdesc:"Click the link below to access all technical documentation.",
            read:"Read",
            letter:"Open Letter to the Technical Community",
            enter:"Enter",
            readwp:"Read our White Papers",
            wpurl:"https://ontio.github.io/documentation/wp_download_en.html",
            smartx:"SmartX",
            smartxdesc:"SmartX is a one-stop IDE that can be used to compile, deploy, and invoke smart contracts. It provides a range of smart contract templates and a powerful online editor.",
            github:"GitHub",
            githubdesc:"Ontology is now open-source on GitHub. We welcome developers to join our technical community.",
            go:"Go",
            open:"Open",
            detail:"Detail",
            testapply:"Developer Centre",
            testapplydesc:"Developer Centre",
            apply:"Developer Centre",
            Bountyhead:"Bounty Program",
            Bountytext:"Join us on various missions to get rewards.",
            Bountymore:"Learn More",
            Bountycontact1:"New requests or bounty ideas?",
            Bountycontact2:"Let us know.",
            Bountysuggesturl:"https://docs.google.com/forms/d/e/1FAIpQLSeowE6jO0xpQzgyZkB0I7C2CeNdK5t1r5-Jd3J3kZKxGoO-_Q/viewform?usp=pp_url",
            sfopening:"San Francisco office is recruiting!"
        },
        BountyContent:[
            {
                head:"Javascript Debug Tools",
                bouns:"3000 ONT +",
                picurl:"/static/img/developer/icon/jstest.png",
                googleformurl:"https://docs.google.com/forms/d/1eDV4sC5i1V8cdOlTZvOVvz_IqNBbfoXV5m_cRBWu_Rk",
                desc:"could be integrated with SmartX, supporting online debugging，like Remix.",
                able:true
            },
            {
                head:"KeepKey Integration",
                bouns:"800 ONT +",
                picurl:"/static/img/developer/icon/nex_wallet_support_l.png",
                googleformurl:"https://docs.google.com/forms/d/17WHOQIhVYW0jf4E5w5jDt1CPaSqdk1qecGLJ6qdmZQ",
                desc:"integration with KeepKey.",
                able:true
            },
            {
                head:"Smart Contract Test Framework",
                bouns:"1000 ONT +",
                picurl:"/static/img/developer/icon/test_framwork_l.png",
                googleformurl:"https://docs.google.com/forms/d/e/1FAIpQLSd4I_CTGFQQ8xr5Y3e6G8d8z6TmJ07PVE7dKIuFxbWfvBBHJA/viewform?usp=pp_url",
                desc:"Built-in smart contract compilation, deployment, and management.  Automated contract testing for development.",
                able:true
            },
            {
                head:"SDKs",
                bouns:"1000 ONT +",
                picurl:"/static/img/developer/icon/sdk_l.png",
                googleformurl:"https://docs.google.com/forms/d/e/1FAIpQLSfXXZYL95G3vkjZ4yVWgA2_mpJEwQV-lUCzkjQ7EKIrVHoW4g/viewform?usp=pp_url",
                desc:"We are using Java/TS SDK, Python, and C++.Swift/Kotlin and other SDKs are welcome.",
                able:true
            },
        ],
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
.cooperation-wrapper{
    max-width: 930px;
    margin: auto;
    display: block;
}
.cooperation-input:focus{
    border:2px solid #32A4BE;
}
.cooperation-textarea:focus{
    border:2px solid #32A4BE;
}
.cooperation-button{
    height: 50px;
    width: 260px;
    font-family:var(--Light-font-ZH);
    color: #32A4BE;
    background-color: white;
    font-size: 22px;
    border: 1px solid #32A4BE;
    border-radius: 25px;
}
.cooperation-button:focus{
    outline: -webkit-focus-ring-color auto 0px;
}
.cooperation-text{

}
.cooperation-warnMsg{
    color: #324349;
    font-weight: 700;
}
.cooperation-thank{
/*     font-size: 46px; */
    text-align: center;
}
    .cooperation-textarea:focus{
            outline: -webkit-focus-ring-color auto 0px;
    }
@media only screen and (min-width: 768px) {
    .cooperation-input{
        padding: 0 8px;
        height: 50px;
        max-width:480px;
        width: 100%;
        background-color:  #EDF8FF ;
        border:1px solid #8E9496;
    }  
    .cooperation-textarea{
        padding: 8px 8px;
        height: 240px;
        max-width:620px;
        background-color:  #EDF8FF ;
        border:1px solid #8E9496;
        width: 100%;
    }
    .padding0-left{
        padding-left:0px !important;
        padding-right:10px !important;
    }
    .padding0-right{
        padding-left:10px !important;
        padding-right:0px !important;
    }
}
@media only screen and (max-width: 768px) {
    .cooperation-input{
        padding: 0 8px;
        height: 50px;
        width: 100%;
        background-color:  #EDF8FF ;
        border:1px solid #8E9496;
    }  
    .cooperation-textarea{
        padding: 8px 8px;
        height: 240px;
            width: 100%;
        background-color:  #EDF8FF ;
        border:1px solid #8E9496;
        width: 100%;
    }
    .padding0-left{
        padding:0 !important;
    }
    .padding0-right{
        padding:0 !important;
    }
    .margin3-top-m{
        margin-top:24px !important;
    }
}
input:focus{
    border:2px solid #32A4BE;
}
:focus {
    outline: -webkit-focus-ring-color auto 0px;
}

#developer-banner{
    background-position-x: 100%;
    background-position-y: 50%;
    background-repeat: no-repeat;
}
@media screen and (max-width: 768px){
    #developer-banner{
    }
    .container-padding-first-dev{
        padding-top: 44px;
    }
    .developer-banner-wrapper{
        background-image: linear-gradient(-180deg, #3FB7C8 2%, #0F89A2 68%, #057A94 100%);
        padding-bottom:32px;
    }
    .dev-tool-warpper-left{
        padding: 0 32px 20px !important;
    }
    .dev-tool-warpper-right{
        padding: 0 32px 20px !important;
    }
    .bounty-claim-item-wrapper{
        padding: 0 32px 20px !important;
    }
    .dev-tool-warpper-hr{
        padding: 0 0px 20px !important;
    }
}
@media screen and (min-width: 768px){
    #developer-banner{
        background-image: url("/static/img/developer/banner_bg.png");
    }
    .container-padding-first-dev{
        padding-top: 50px;
    }
    .developer-banner-wrapper{
        background-image: linear-gradient(-180deg, #3FB7C8 2%, #0F89A2 68%, #057A94 100%);
    }
    .dev-tool-warpper-left{
        padding:0 10px 0 0 ;
    }
    .dev-tool-warpper-right{
        padding:0 0 0 10px;
    }
    .dev-tool-warpper-hr{
        padding:0 10px 0 0 ;
    }
    .bounty-claim-item-wrapper{
        padding-bottom:  20px !important;
    }
}
.dev-content-container {
		margin-left: auto;
		margin-right: auto;
}
@media screen and (max-width: 1200px){
	.dev-content-container {
		width: 100%;
	}
}
@media screen and (min-width: 1200px){
	.dev-content-container {
		width: 1200px;
	}
}
@media screen and (min-width: 1000px){
    .dev-tool-text-wrapper{
        padding-bottom:32px;
        min-height:120px;
    }
}
@media screen and (max-width: 1000px)and (min-width: 768px){
    .dev-tool-text-wrapper{
        padding-bottom:32px;
        min-height:165px;
    }
}
@media screen and (max-width: 768px){
    .dev-tool-text-wrapper{
        padding-bottom:32px;
        min-height:120px;
    }
}
@media screen and (max-width: 1000px) and (min-width: 768px){
    .dev-sf-text{
        font-size: 24px;
        color:#ffffff;
        font-family: SourceSansPro-Regular;
        line-height: 2;
    }
}
@media screen and (min-width: 1000px){
    .dev-sf-text{
        font-size: 32px;
        color:#ffffff;
        font-family: SourceSansPro-Regular;
        line-height: 2;
    }
}
@media screen and (max-width: 768px){
    .dev-sf-text{
        font-size: 24px;
        color:#ffffff;
        font-family: SourceSansPro-Regular;
        line-height: 1.6;
    }
    .dev-sf-text-wrapper{
        margin:20px 0;
    }
}
.dev-head{
  color: #FFFFFF;
  font-family: SourceSansPro-light;
   font-size: 40px;
   padding: 32px 0;
}
.dev-doc-title{
  color: #FFFFFF;
  font-family: SourceSansPro-Semibold;
   font-size: 24px;
   font-weight: 500;
}

.dev-doc-text{
  color: #C2E7F3;
  font-family: SourceSansPro-Regular;
   font-size: 22px;
   line-height: 1.4;
}
.dev-doc-text-wrapper{
   padding-top: 12px;
   padding-bottom: 102px;
}
.dev-letter-title{
  color: #FFFFFF;
  font-family: SourceSansPro-Regular;
   font-size: 16px;
}
.dev-letter-title-wrapper{
   padding-top: 32px;
}
.doc-link-wrapper{
   padding-top: 8px;
   padding-bottom: 32px;
}
.wp-link-wrapper{
   padding-top: 12px;
}
.dev-link{
  color: #FFFFFF;
  font-family: SourceSansPro-Regular;
   font-size: 16px;
   font-weight: 600;
}
.dev-link:hover{
  color: #32A4BE;
  font-family: SourceSansPro-Regular;
   font-size: 16px
}
.dev-link:visited{
  color: #C2E7F3;
  font-family: SourceSansPro-Regular;
   font-size: 16px
}
.dev-btn-size{
    height: 40px;
    width: 200px;
    cursor: pointer;
}
.dev-btn-size:active{
    background-color: #c2e7f3;
}
.dev-btn-size-sf{
    height: 40px;
    width: 128px;
    cursor: pointer;
}
.dev-btn-size-sf:hover{
    background-color: #ffffff1a;
}
.dev-btn-w{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#32A4BE;
    background-color: #ffffff;
    text-align: center;
    line-height: 38px;
   font-weight: 600;
}
.dev-btn-b{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#ffffff;
    background-color: #32A4BE;
    text-align: center;
    line-height: 38px;
   font-weight: 600;
}
.dev-btn-g{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#ffffff;
    background-color: #2cbe4e;
    text-align: center;
    line-height: 38px;
   font-weight: 600;
}
.dev-btn-o{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#cb7e00;
    border: 1px solid #cb7e00;
    text-align: center;
    line-height: 36px;
   font-weight: 600;
}
.dev-btn-s{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#cb7e00;
    border: 1px solid #32A4BE;
    text-align: center;
    line-height: 36px;
   font-weight: 600;
}
.dev-btn-d{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#ffffff;
    border: 1px solid #ffffff;
    text-align: center;
    line-height: 36px;
   font-weight: 600;
}
.doc-wrapper{
    padding:0 32px 72px;
}
/* content */
.developer-content-wrapper{
    background-color:#001b1e; 
}

.dev-tool-content{
    padding-top:48px;
    padding-left:32px !important;
    padding-right:32px !important;
    padding-bottom:48px;
    border:2px solid white;
}
.dev-tool-title{
    font-size: 24px;
    color:#ffffff;
    font-family: SourceSansPro-Semibold;
    text-align: center;
   font-weight: 500;
}
.dev-tool-title-wrapper{
    padding-bottom:16px;
}
.dev-tool-text{
    font-size: 16px;
    color:#C2E7F3;
    font-family: SourceSansPro-Regular;
    line-height: 1.6;
}
/* .dev-tool-text-wrapper{
    padding-bottom:32px;
    min-height:120px;
} */
.dev-apply-warpper-warpper{
    padding:0 0 96px 0;
}
.dev-apply-warpper-left{
    padding:41px 10px 0 0 ;
}
.dev-apply-warpper-right{
    padding:0 0 0 10px;
}
.dev-apply-title{
    font-size: 24px;
    color:#ffffff;
    font-family: SourceSansPro-Semibold;
    text-align: center;
   font-weight: 500;
}
.dev-apply-title-wrapper{
    padding-bottom:24px;
}
.dev-apply-text{
    font-size: 22px;
    color:#c2e7f3;
    font-family: SourceSansPro-Regular;
    line-height: 30px;
}
.dev-apply-text-wrapper{
    padding-bottom:32px;
}
.cutline{
    padding-bottom: 96px;
    border-top: 2px solid #c2e7f3;
    background-attachment: #001b1e;
}
.tool-img{
    padding: 2px 16px 8px 0;
}
/* bounty */
.developer-Bounty-wrapper{
    background-color:#06262B; 

}
.dev-bountydesc-text{
  color: #C2E7F3;
  font-family: SourceSansPro-Regular;
   font-size: 18px;
   line-height: 30px;
   padding-bottom: 56px;
}
.bounty-claim-img{
    padding-top:32px;
    padding-bottom:16px;
    width: 121px;
}
.bounty-claim-text{
    font-family: SourceSansPro-Bold;
    font-size: 18px;
    color: #FFFFFF;
    text-align: center;
    max-width: 170px;
    margin:auto;
}
.bounty-claim-text-wrapper{
    text-align: center;
    min-height:65px;
}
.bounty-claim-bouns-wrapper{
    text-align: center;
    padding-top:32px;
    padding-bottom:24px;
}
.bounty-claim-bouns{
    font-family: SourceSansPro-Semibold;
    font-size: 24px;
    color: #CB7E00;
    text-align: center;
    line-height: 18px;    
    font-weight: 500;
}
.bounty-claim-btn-wrapper{
    background-color: #32A4BE;
    height: 40px;
}
.bounty-claim-btn{
    font-family: SourceSansPro-Semibold;
    font-size: 18px;
    color: #FFFFFF;
    text-align: center;
    font-weight: 600;
    line-height: 40px;
}
.bounty-claim-btn-disable{
    font-family: SourceSansPro-Semibold;
    font-size: 18px;
    color: #9e9e9e;
    text-align: center;
    font-weight: 600;
    line-height: 40px;
}
.bounty-more-warpper{
     padding-bottom:72px;
     padding-top:40px;
     /* cursor:pointer; */
}
/* .bounty-more-warpper:hover{
     color:#32a4be;
} */
.bounty-more-img{
    padding-bottom:16px;
}
.bounty-more-text{
    font-family: SourceSansPro-Regular;
    font-size: 22px;
/*     color: #FFFFFF; */
    text-align: center;
    line-height: 22px;
}
.dev-bounty-head {
    color: #FFFFFF;
    font-family: SourceSansPro-light;
    font-size: 40px;
    padding: 40px 0 32px;
}
.hiden-desc{
    padding:32px 16px;
    font-family: SourceSansPro-Regular;
    font-size: 16px;
    color: #FFFFFF;
    line-height: 25px;
    text-align: left;
}
.bounty-more-text1{
    font-family: SourceSansPro-Regular;
    font-size: 16px;
    color: #C2E7F3;
    text-align: center;
    line-height: 22px;    
    margin-top: 16px;
}
@media screen and (max-width: 768px){
    .bounty-claim-item-hide{
        z-index: -1;
        position: absolute;
        transform: translate(0,-100%);
        min-height: 350px;
        border: 2px solid #32A4BE;
        width: calc(100% - 64px);
        background-color: rgba(0, 0, 0,0.94);
        max-height:350px;
    }
    .bounty-claim-item{
        border: 2px solid #32A4BE;
        min-height:350px;
        background-color: #001b1e;
    }
    .bounty-claim-item:hover{
    opacity: 0.1;
    }
    .dev-tool-warpper-warpper{
        padding:0px 0 72px;
    }

    .dev-hr-warpper-warpper{
        padding:56px 0 0px;
        padding-left:0 !important;
        padding-right:0 !important;
    }

    .dev-sf-content{
        padding-top:32px;
        padding-left:32px !important;
        padding-right:32px !important;
        padding-bottom:32px;
    }
}
@media screen and (min-width: 768px){
    .bounty-claim-item-hide{
        z-index: -1;
        position: absolute;
        transform: translate(0,-100%);
        min-height: 350px;
        border: 2px solid #32A4BE;
        width: calc(100% - 20px);
        background-color: rgba(0, 0, 0,0.94);
        max-height:350px;
    }
    .bounty-claim-item{
        border: 2px solid #32A4BE;
        min-height:350px;
        background-color: #001b1e;
    }
    .bounty-claim-item:hover{
    opacity: 0.1;
    }
    .dev-tool-warpper-warpper{
        padding:56px 0 72px;
    }

    .dev-hr-warpper-warpper{
        padding:56px 0 0px;
    }

    .dev-sf-content{
        padding-top:19px;
        padding-left:32px !important;
        padding-right:32px !important;
        padding-bottom:19px;
    }
}
.bounty_contact_url{
   font-weight:600;
   color:#ffffff;
}
.bounty_contact_url:hover{
   color:#32A4BE;
}
.bounty_contact_url:visited{
   color:#C2E7F3;
}
.bounty-more-warpper-warpper{
   color:white;
}
.bounty-more-warpper-warpper:hover{
   color: #32a4be;;
}
</style>
