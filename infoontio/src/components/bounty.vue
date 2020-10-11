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
    <div id="bounty" class="home-page-content back-color container-padding-first-dev container-val-background " style="z-index:10">
        <div  class="bounty-banner-wrapper" >
            <div id="bounty-banner" class=" home-detail zindex container-pos" >
                <div class="dev-content-container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1 class="bou-head">{{bounty.Bountyhead}}</h1>
                        </div>
                        <div class="pc-display">
                            <div class="col-sm-12 text-center">
                                <p class="bountydesc-text-banner">{{bounty.Bountytext}}</p>
                            </div>
                            <div class="col-sm-12 text-center">
                                <p class="bountydesc-text-banner1">{{bounty.Bountycontact1}}<a :href="bounty.Bountysuggesturl" target="_blank" class="bounty_contact_url"><span > {{bounty.Bountycontact2}}</span></a></p>
                            </div>
                        </div>
                        <div class="mobile-display">
                            <div class="col-sm-12 text-center">
                                <p class="bountydesc-text-banner1">{{bounty.Bountycontactmobile}}<a :href="bounty.Bountysuggesturl" target="_blank" class="bounty_contact_url"><span > {{bounty.Bountycontact2}}</span></a></p>
                            </div>                            
                        </div>
<!--                         <div class="col-sm-12 text-center ">
                            <div class="bountydesc-text-banner2">
                                <a :href="bounty.Bountysuggesturl" target="_blank"><div class="dev-btn-size dev-btn-b" style="margin:auto">Tell Us</div></a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div  class="Bounty-active-wrapper" >
            <div  class=" home-detail zindex container-pos" >
                <div class="dev-content-container">
                    <div class="row">

                        <div class="col-sm-12 bounty-new-warpper-warpper">
                            <div class="col-sm-12 bounty-tool-warpper-new">
                                <div class="col-sm-12  bounty-new-content" >
                                    <div class="col-sm-2 text-center ">
                                        <h2 ><img  src="/static/img/bounty/icon_test_framwork_l@2x.png" class="bounty-new-img"/></h2>
                                    </div>
                                    <div class="col-sm-8 bounty-new-text-wrapper text-center">
                                        <p class="bounty-new-text">{{bounty.newbounty}}</p>
                                    </div>
                                    <div class="col-sm-2 padding0 text-center">
                                        <a href="https://docs.google.com/forms/d/1s9jUWaNw0LsqNTwiP9H4zZBq6RUsoey31aK5FfR8omE" target="_blank" class="text-center"><div class="dev-btn-size-sf bou-btn-d" style="margin:auto;margin:12px 0;    margin-left: auto;margin-right: auto;">{{bounty.submit}}</div></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 text-left bounty-head-wrapper">
                            <span class=" col-sm-12 bounty-head">{{bounty.active}}</span>
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
                    </div>
                </div>
            </div>
        </div>
        <div  class="Bounty-progress-wrapper" v-if="BountyContentprogress.length > 0" >
            <div  class=" home-detail zindex container-pos" >
                <div class="dev-content-container">
                    <div class="row">
                        <div class="col-sm-12 text-left bounty-head-wrapper">
                            <span class=" col-sm-12 bounty-head-progerss">{{bounty.progress}}</span>
                        </div>
                        <div class="col-sm-12 col-xs-12 text-center bounty-progress-item-warpper-wrapper">
                            <div class="col-sm-6 col-xs-12 bounty-progress-item-warpper" v-for="(item,index) in BountyContentprogress">
                              <div class="bounty-progress-item">
                                  <div class="col-sm-12 col-xs-12 bounty-progress-text-wrapper" >
                                      <p class="bounty-progress-text">{{item.head}}</p>
                                  </div>
                                  <div class="col-sm-12 col-xs-12 bounty-progress-bouns-wrapper" >
                                      <p class="col-sm-5 col-xs-12 bounty-progress-bouns">{{item.bouns}}</p>
                                      <p class="col-sm-7 col-xs-12 bounty-progress-by-wrapper">by <span class="bounty-progress-by">{{item.by}}</span></p>
                                  </div>
                                  <div class="col-sm-12 col-xs-12  bou-cutline"></div>
                                  <div class="col-sm-12 col-xs-12 bounty-progress-btn-wrapper" >
                                      <div v-if="item.giturl != undefined" >
                                          <a :href="item.giturl" target="_blank"><p  class="bounty-btn-text">See Progress</p></a>
                                      </div>
                                      <div v-else>
                                          <p  class="bounty-btn-text-disable">See Progress</p></a>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 bounty-cut-wrapper">
                                <div class="col-sm-12  col-xs-12  bou-cutline-progress"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="Bounty-progress-wrapper" v-if="BountyContentdone.length > 0" >
            <div  class=" home-detail zindex container-pos" >
                <div class="dev-content-container">
                    <div class="row">
                        <div class="col-sm-12 text-left bounty-head-wrapper">
                            <span class=" col-sm-12 bounty-head-progerss">{{bounty.Done}}</span>
                        </div>
                        <div class="col-sm-12 text-center bounty-progress-item-warpper-wrapper">
                            <div class="col-sm-6 bounty-progress-item-warpper" v-for="(item,index) in BountyContentdone">
                              <div class="bounty-progress-item">
                                  <div class="col-sm-12 bounty-progress-text-wrapper" >
                                      <p class="bounty-progress-text">{{item.head}}</p>
                                  </div>
                                  <div class="col-sm-12 bounty-progress-bouns-wrapper" >
                                      <p class="col-sm-5 bounty-done-bouns">{{item.bouns}}</p>
                                      <p class="col-sm-7 bounty-progress-by-wrapper">by <span class="bounty-progress-by">{{item.by}}</span></p>
                                  </div>
                                  <div class="col-sm-12 dev-apply-warpper-warpper bou-cutline"></div>
                                  <div class="col-sm-12 bounty-progress-btn-wrapper" >
                                      <div v-if="item.giturl != undefined" >
                                          <a :href="item.giturl" target="_blank"><p  class="bounty-btn-text">See Progress</p></a>
                                      </div>
                                      <div v-else>
                                          <p  class="bounty-btn-text-disable">See Progress</p></a>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="col-sm-12 bounty-cut-wrapper">
                                <!-- <div class="col-sm-12 dev-apply-warpper-warpper bou-cutline-done"></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--         <div  class="Bounty-progress-wrapper" >
            <div  class=" home-detail zindex container-pos" >
                <div class="dev-content-container">
                    <div class="row">
                        <div class="col-sm-12 text-center bounty-more-warpper" >
                            <img class="bounty-more-img"  src="/static/img/developer/icon/star_l.png" />
                            <div class="bounty-more-text1" >{{bounty.Bountycontact1}}<a :href="bounty.Bountysuggesturl" target="_blank" class="bounty_contact_url"><span > {{bounty.Bountycontact2}}</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
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
         this.bounty = this.bountyZH
      }else{
         this.bounty = this.bountyEN
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
                this.bounty = this.bountyEN
            }else{
                this.bounty = this.bountyEN
            }
      }
    },
    methods: {

      back:function(){
         this.$router.push({'path': '/'})
      },
      gotobountypage:function(){
         this.$router.push({'path': '/bounty/'+this.$route.params.lang})
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
        bounty:{},
        bountyZH:{
            Bountyhead:"Bounty Program",
            Bountytext:"Join us in various types of missions to gain rewards.",
            Bountycontact1:"如果您有新的建议,",
            newbounty:"Got ideas for our bounty program?",
            submit:"Let us know",
            Bountycontact2:"敬请联系.",
            Bountysuggesturl:"https://docs.google.com/forms/d/e/1FAIpQLSeowE6jO0xpQzgyZkB0I7C2CeNdK5t1r5-Jd3J3kZKxGoO-_Q/viewform?usp=pp_url",
        },
        bountyEN:{
            Bountyhead:"Bounty Program",
            Bountytext:"Join us in various types of missions to gain rewards,",
            active:"Active",
            progress:"In Progress",
            Done:"Done",
            newbounty:"Got ideas for our bounty program?",
            submit:"Let us know",
            Bountycontact1:"or let us know if you have ",
            Bountycontact2:" suggestions.",
            Bountycontactmobile:"Join us in various types of missions to gain rewards, or let us know if you have ",
            Bountysuggesturl:"https://docs.google.com/forms/d/e/1FAIpQLSeowE6jO0xpQzgyZkB0I7C2CeNdK5t1r5-Jd3J3kZKxGoO-_Q/viewform?usp=pp_url",

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
                googleformurl:"https://docs.google.com/forms/d/17WHOQIhVYW0jf4E5w5jDt1CPaSqdk1qecGLJ6qdmZQs",
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
            {
                head:"Chrome Plug-In",
                bouns:"500 ONT +",
                picurl:"/static/img/developer/icon/chrome_plug_in_l.png",
                googleformurl:"https://docs.google.com/forms/d/e/1FAIpQLSfGnIWJPmZVlejm0udUIlhNq7hIwy_0vKo1V70h9iaVZrBJWQ/viewform?usp=pp_url",
                desc:"Support digital assets management, ONT ID management, and so on. ",
                able:false
            },
/*             {
                head:"Stable nodes",
                bouns:"120 ONT",
                picurl:"/static/img/developer/icon/stable_node_l.png",
                googleformurl:"https://docs.google.com/forms/d/e/1FAIpQLSdZhei8b8_f_8qkt4enVFy9A8XLqsPEqVQYKk5dr6I46fE4Iw/viewform?usp=pp_url"
            }, */
            {
                head:"Anonymous Credential",
                bouns:"500 ONT +",
                picurl:"/static/img/developer/icon/signiture_l.png",
                googleformurl:"https://docs.google.com/forms/d/e/1FAIpQLSfqHCl4x0cJ-r52h3mdbvvf_fKpaQFcTlMKht2yuVzls5yRaw/viewform?usp=pp_url",
                desc:"Implementing anonymous credential scheme in different languages and integrating it in SDKs. Moreover, it consists of credential issuance protocol and credential presentation protocol.",
                able:true
            },
            {
                head:"Hardware acceleration",
                bouns:"2000 ONT +",
                picurl:"/static/img/developer/icon/acceleration_l.png",
                googleformurl:"https://docs.google.com/forms/d/e/1FAIpQLScXsiRKMyV_WqG-jvAXdNLyVudpoDImGHTEiPIGSwDJ30xsMw/viewform?usp=pp_url",
                desc:"Use FPGAs to parallel verify ECDSA signatures with curve NIST P-256.",
                able:true
            },
            {
                head:"One-click blockchain",
                bouns:"500 ONT +",
                picurl:"/static/img/developer/icon/one_click_l.png",
                googleformurl:"https://docs.google.com/forms/d/e/1FAIpQLScoCUJc07aPJ6opDds-e06qKOajd-dWrB1JrUOGBJwFKBlSHQ/viewform?usp=pp_url",
                desc:"Quickly fire up a personal Ontology blockchain which you can use to run tests, execute commands, and inspect state while controlling how the chain operates. ",
                able:true
            },
            {
                head:"Trezor integration",
                bouns:"800 ONT +",
                picurl:"/static/img/developer/icon/nex_wallet_support_l.png",
                googleformurl:"https://docs.google.com/forms/d/e/1FAIpQLScXWOgJ7Fr-8kbylC_emiC7KZ9KAN1KKkhK6RczIiDp70b-yg/viewform?usp=pp_url",
                desc:"Integration with Trezor ONE and model T.",
                able:true
            },
        ],
        BountyContentprogress:[
            {
                head:"SDK(Kotlin)",
                bouns:"1000 ONT +",
                by:"N.Perevozchikov Team",
            },
            {
                head:"SDK(Swift)",
                bouns:"1000 ONT +",
                by:"R.Rao B Team",
            },
            {
                head:"Chrome Plug-In",
                bouns:"500 ONT +",
                by:"M.Zamborsky Team",
                giturl:"https://github.com/OntologyCommunityDevelopers/ontology-plugin-wallet"
            },
            {
                head:"Chrome Plug-In",
                bouns:"500 ONT +",
                by:"O3 Labs",
            },
/*             {
                head:"Chrome Plug-In",
                bouns:"500 ONT +",
                by:"B.Hu Team",
            }, */
            {
                head:"Anonymous Credential(Python)",
                bouns:"500 ONT +",
                by:"B.Anastasiia Team",
            },
            {
                head:"Anonymous Credential",
                bouns:"500 ONT +",
                by:"Y.Mari Team",
            },
            {
                head:"Hardware acceleration",
                bouns:"2000 ONT +",
                by:"X.Dong Team",
            },
            {
                head:"Trezor integration",
                bouns:"800 ONT +",
                by:"M.Zamborsky Team",
            },
            {
                head:"One-click blockchain",
                bouns:"500 ONT +",
                by:"G.Y.Yin Team",
            },

        ],
        BountyContentdone:[
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

#bounty-banner{
    background-position-x: 90%;
    background-position-y: 100%;
    background-repeat: no-repeat;
}
@media screen and (max-width: 768px){
    #bounty-banner{
    }
    .container-padding-first-dev{
        padding-top: 45px;
    }
}
@media screen and (min-width: 768px){
    #bounty-banner{
        background-image: url("/static/img/developer/star.png");
    }
    .container-padding-first-dev{
        padding-top: 50px;
    }
}
.bounty-banner-wrapper{
    background-color: #06262b;
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
.bou-head{
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
  color: #FFFFFF;
  font-family: SourceSansPro-Regular;
   font-size: 22px;
   line-height: 30px;
   padding-top: 12px;
}
.dev-doc-text-wrapper{
   padding-top: 12px;
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
   text-decoration: underline;
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
.dev-btn-w{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#32A4BE;
    background-color: #ffffff;
    text-align: center;
    line-height: 38px;
   font-weight: 500;
}
.dev-btn-b{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#ffffff;
    background-color: #32A4BE;
    text-align: center;
    line-height: 38px;
   font-weight: 500;
}
.dev-btn-g{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#ffffff;
    background-color: #2cbe4e;
    text-align: center;
    line-height: 38px;
   font-weight: 500;
}
.dev-btn-o{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#cb7e00;
    border: 1px solid #cb7e00;
    text-align: center;
    line-height: 36px;
   font-weight: 500;
}
.dev-btn-s{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#cb7e00;
    border: 1px solid #32A4BE;
    text-align: center;
    line-height: 36px;
   font-weight: 500;
}
.doc-wrapper{
    padding:0 32px 72px;
}
/* bounty */
.Bounty-active-wrapper{
    background-color:#001B1E; 
    padding-bottom:96px;

}
.bountydesc-text-banner{
    font-family: SourceSansPro-Regular;
    font-size: 18px;
    color: #FFFFFF;
    text-align: center;
   padding-top: 12px;
}
.bountydesc-text-banner1{
    font-family: SourceSansPro-Regular;
    font-size: 18px;
    color: #FFFFFF;
    text-align: center;
   padding-bottom: 64px;
}
.bountydesc-text-banner2{
    font-family: SourceSansPro-Regular;
    font-size: 18px;
    color: #FFFFFF;
    text-align: center;
   padding-top: 12px;
   padding-bottom: 12px;
}
.bounty-claim-item{
    border: 2px solid #32A4BE;
    min-height:350px;
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
    cursor: pointer;
}
.bounty-claim-btn{
    font-family: SourceSansPro-Semibold;
    font-size: 18px;
    color: #FFFFFF;
    text-align: center;
    font-weight: 500;
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
     padding-top:64px;
     padding-bottom:96px;
     cursor:pointer;
}
.bounty-more-warpper:hover{
     color:#32a4be;
}
.bounty-more-img{
    padding-bottom:16px;
}
.bounty-more-text{
    font-family: SourceSansPro-Bold;
    font-size: 18px;
    color: #FFFFFF;
    text-align: center;
    line-height: 18px;
}
.bounty-head{
    font-family: SourceSansPro-Semibold;
    font-size: 24px;
    color: #32A4BE;
    font-weight: 500;
}
.bounty-head-wrapper{
    padding-top:32px;
    padding-bottom:24px;
}
.bounty-claim-item-warpper{
    padding-bottom:20px;
}

/* progress */
.bounty-head-progerss{
    font-family: SourceSansPro-Semibold;
    font-size: 24px;
    color: #2CBE4E;
    font-weight: 500;
}
.Bounty-progress-wrapper{
    background-color:#06262b;
}
 .bounty-progress-item-warpper{
     padding-bottom:20px;
 }



.bounty-progress-by{
    font-family: SourceSansPro-Bold;
    font-size: 14px;
    color: #ffffff;
    text-align: right;
    line-height: 14px;
    font-weight: 700;
}
.bou-cutline{
    padding-bottom: 24px;
    margin-top: 24px;
    border-top: 2px solid #ffffff;
    background-attachment: #001b1e;
}
.bounty-btn-text{
    font-family: SourceSansPro-Bold;
    font-size: 14px;
    color: #FFFFFF;
    text-align: center;
    line-height: 14px;    
    font-weight: 700;
}
.bounty-btn-text:hover{
    color: #32a4be;
}
.bounty-btn-text-disable{
    font-family: SourceSansPro-Bold;
    font-size: 14px;
    color: #888888;
    text-align: center;
    line-height: 14px;    
    font-weight: 700;
}
.bounty-progress-btn-wrapper{
    padding-bottom:24px;
}
.bou-cutline-progress{
    padding-bottom: 24px;
    margin-top: 48px;
/*     border-top: 2px solid #ffffff; */
    background-attachment: #001b1e;
}
/* done */
.bounty-done-bouns{
    font-family: SourceSansPro-Semibold;
    font-size: 24px;
    color: #32A4BE;
    line-height: 18px;  
    font-weight: 500;
    text-align: left;
    padding-left:0 !important;
}
.bounty-head-progerss{
    font-family: SourceSansPro-Semibold;
    font-size: 24px;
    color: #ffffff;
    font-weight: 500;    
}
.bou-cutline-done{
    padding-bottom: 96px;
    margin-top: 48px;
    border-top: 2px solid #ffffff;
    background-attachment: #001b1e;    
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
    .bounty-claim-item-wrapper{
        padding: 0 32px 20px !important;
    }
    .bounty-progress-item-warpper{
        padding: 0 32px 20px !important;
    }
    .bounty-cut-wrapper{
        padding: 0 32px !important;
    }
    .bounty-progress-item{
        border: 1px solid #ffffff;
        min-height:243px;
        padding:24px;
    }
    .bounty-progress-bouns-wrapper{
        padding:20px 0 0
    }
    .bounty-progress-by-wrapper{
        text-align: center;
        padding-top:10px;
    }
    .bounty-progress-text-wrapper{
        text-align: center ;
        min-height:65px;
    }
}
@media screen and (min-width: 768px){
    .bounty-progress-text-wrapper{
        text-align: left ;
        min-height:65px;
    }
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
    .bounty-claim-item-wrapper{
        padding-bottom:  20px !important;
    }
    .bounty-progress-item-warpper{
        padding: 20px !important;
    }
    .bounty-progress-item-warpper-wrapper{
        padding-left:0px !important;
        padding-right:0px !important;
    }
    .bounty-cut-wrapper{
        padding: 0 20px !important;
    }
    .bounty-progress-item{
        border: 1px solid #ffffff;
        min-height:203px;
        padding:24px;
    }
    .bounty-progress-by-wrapper{
        text-align: right;
    }
}
@media screen and (min-width: 940px){
    .bounty-progress-bouns{
        font-family: SourceSansPro-Semibold;
        font-size: 24px;
        color: #2CBE4E;
        line-height: 18px;  
        font-weight: 500;
        text-align: left;
        padding-left:0 !important;
    }
    .bounty-progress-text{
        font-family: SourceSansPro-Bold;
        font-size: 18px;
        color: #FFFFFF;
        font-weight: 700;
    }
}
@media screen and (max-width: 940px) and (min-width: 768px){
    .bounty-progress-bouns{
        font-family: SourceSansPro-Semibold;
        font-size: 18px;
        color: #2CBE4E;
        line-height: 18px;  
        font-weight: 500;
        text-align: left;
        padding-left:0 !important;
    }
    .bounty-progress-text{
        font-family: SourceSansPro-Bold;
        font-size: 16px;
        color: #FFFFFF;
        font-weight: 700;
    }
}
@media screen and (max-width: 768px){
    .bounty-progress-bouns{
        font-family: SourceSansPro-Semibold;
        font-size: 24px;
        color: #2CBE4E;
        line-height: 18px;  
        font-weight: 500;
        text-align: center;
        padding-left:0 !important;
    }
    .bounty-progress-text{
        font-family: SourceSansPro-Bold;
        font-size: 18px;
        color: #FFFFFF;
        font-weight: 700;
    }
}
.bounty-more-text1{
    font-family: SourceSansPro-Regular;
    font-size: 16px;
    color: #C2E7F3;
    text-align: center;
    line-height: 22px;    
    margin-top: 16px;
}
.hiden-desc{
    padding:32px 16px;
    font-family: SourceSansPro-Regular;
    font-size: 16px;
    color: #FFFFFF;
    line-height: 25px;
    text-align: left;
}
@media screen and (max-width: 350px){
    .bounty-progress-item{
        border: 1px solid #ffffff;
        min-height:291px !important;
        padding:24px;
    }
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
.bounty_contact_url{
   font-weight:600;
   color:#32A4BE;
}
.bounty_contact_url:hover{
   color:#32A4BE;
   opacity: 0.8;
}
/* .bounty_contact_url:visited{
   color:#C2E7F3;
} */
@media screen and (max-width: 1000px) and (min-width: 768px){
    .bounty-new-text{
        font-size: 24px;
        color:#ffffff;
        font-family: SourceSansPro-Regular;
        line-height: 2;
    }
}
@media screen and (min-width: 1000px){
    .bounty-new-text{
        font-size: 32px;
        color:#ffffff;
        font-family: SourceSansPro-Regular;
        line-height: 2;
    }
}
@media screen and (max-width: 768px){
    .bounty-new-text{
        font-size: 24px;
        color:#ffffff;
        font-family: SourceSansPro-Regular;
        line-height: 1.6;
    }
    .bounty-new-text-wrapper{
        margin:20px 0;
    }
}
@media screen and (max-width: 768px){

    .bounty-new-warpper-warpper{
        padding:56px 0 0px;
        padding-left:0 !important;
        padding-right:0 !important;
    }

    .bounty-new-content{
        padding-top:32px;
        padding-left:32px !important;
        padding-right:32px !important;
        padding-bottom:32px;
    }
    .bounty-tool-warpper-new{
        padding: 0 0px 20px !important;
    }
}
@media screen and (min-width: 768px){

    .bounty-new-warpper-warpper{
        padding:56px 0 0px;
    }

    .bounty-new-content{
        padding-top:19px;
        padding-left:32px !important;
        padding-right:32px !important;
        padding-bottom:19px;
    }
    .bounty-tool-warpper-new{
        padding:0 10px 0 0 ;
    }
}
.bou-btn-d{
    font-size: 18px;
    font-family: SourceSansPro-Semibold;
    color:#ffffff;
    border: 1px solid #ffffff;
    text-align: center;
    line-height: 36px;
   font-weight: 600;
}
.bounty-new-img{
    height:62px;
}
.dev-btn-size-sf{
    height: 40px;
    width: 128px;
    cursor: pointer;
}
.dev-btn-size-sf:hover{
    background-color: #ffffff1a;
}
.bounty-new-content{
    background-image: url("/static/img/bounty/Group 16@2x.png");
    background-size: cover;
}
</style>
