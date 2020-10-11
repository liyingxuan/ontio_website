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
    
<!-- ONTOLOGY NETWORK -->
    <div id="cooperation" class="home-page-content back-color container-padding-first container-val-background " style="z-index:10">
        <div class="container home-detail zindex container-pos" >
            <div class="row">
<!--                 <div class="col-sm-12 margin1-bottom" style="padding:0;border-bottom:1px solid rgb(210, 208, 208);"></div> -->
                <div class="midpoint home-text-fir home-text-title" >
                    <div style="text-align:center;">
                        <div class="title-margin col-sm-3"></div>
                        <div class="title-margin col-sm-6" >
                            <h1 v-if="language ==1"> 
                                <span >
                                    <span class="head-float" style="color: #32a4be;">
                                        {{cooperation.firstTitle1}}
                                    </span>
                                    <div class="clear"></div>
                                </span>
                            </h1>

                            <h1 v-if="language ==0" class="h1-EN" > 
                                <span >
                                    <span class="head-float" style="color: #32a4be;">
                                        {{cooperation.firstTitle1}}
                                    </span>
                                    <div class="clear"></div>
                                </span>
                            </h1>
                            <h1 v-if="language ==2" class="font_korean" > 
                                <span >
                                    <span class="head-float" style="color: #32a4be;">
                                        {{cooperation.firstTitle1}}
                                    </span>
                                    <div class="clear"></div>
                                </span>
                            </h1>
                            <div v-if="language ==1" class="text1 h2-padding margin4-top secondtitle-width">
                                <span >
                                    {{cooperation.secondTitle1}}
                                </span>
                            </div>
                            <div v-if="language ==0" class="text1-EN h2-padding margin4-top secondtitle-width"> 
                                <span >
                                    {{cooperation.secondTitle1}}
                                </span>
                            </div>
                            <div v-if="language ==2" class="text1-KO h2-padding margin4-top secondtitle-width font_korean"> 
                                <span >
                                    {{cooperation.secondTitle1}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container home-detail zindex ">
            <div class="container-margin-ontdesc">
                <div class="row " style="color:black">
                    <div class="text-left cooperation-wrapper "> 
                            <div class="col-sm-12 padding0">
                                <div class="col-sm-6 padding0">
                                    <div class="col-sm-12 padding0 ">
                                        <div class="col-sm-4 padding0"></div>
                                        <div class="col-sm-8  padding0-left">
                                            <span class="cooperation-text text2 font_korean" v-if="language ==2">{{cooperation.name}}</span>
                                            <span class="cooperation-text text2" v-else>{{cooperation.name}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 padding0 margin4-top">
                                        <div class="col-sm-4 padding0"></div>
                                        <div class="col-sm-8  padding0-left">
                                            <input maxlength="128" id="cooname" v-model="name" class="cooperation-input"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 padding0" >
                                    <div class="col-sm-12 padding0 margin3-top-m">
                                        <div class="col-sm-8  padding0-right">
                                            <span class="cooperation-text text2 font_korean" v-if="language ==2">{{cooperation.field}}</span>
                                            <span class="cooperation-text text2" v-else>{{cooperation.field}}</span>
                                        </div>
                                        <div class="col-sm-4 padding0"></div>
                                    </div>
                                    <div class="col-sm-12 padding0 margin4-top">
                                        <div class="col-sm-8  padding0-right">
                                            <input maxlength="128" id="coofield" v-model="field" class="cooperation-input"/>
                                        </div>
                                        <div class="col-sm-4 padding0"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 padding0">
                                <div class="col-sm-6 padding0">
                                    <div class="col-sm-12 padding0 margin3-top">
                                        <div class="col-sm-4 padding0"></div>
                                        <div class="col-sm-8  padding0-left">
                                            <span class="cooperation-text text2 font_korean" v-if="language ==2">{{cooperation.phone}}</span>
                                            <span class="cooperation-text text2" v-else>{{cooperation.phone}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 padding0 margin4-top">
                                        <div class="col-sm-4 padding0"></div>
                                        <div class="col-sm-8  padding0-left">
                                            <input maxlength="128" id="coophone" v-model="phone" class="cooperation-input"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 padding0" >
                                    <div class="col-sm-12 padding0 margin3-top ">
                                        <div class="col-sm-8  padding0-right">
                                            <span class="cooperation-text text2 font_korean" v-if="language ==2">{{cooperation.contact}}</span>
                                            <span class="cooperation-text text2" v-else>{{cooperation.contact}}</span>
                                        </div>
                                        <div class="col-sm-4 padding0"></div>
                                    </div>
                                    <div class="col-sm-12 padding0 margin4-top">
                                        <div class="col-sm-8  padding0-right">
                                            <input maxlength="128" id="coocontact" v-model="contact" class="cooperation-input"/>
                                        </div>
                                        <div class="col-sm-4 padding0"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 padding0">
                                <div class="col-sm-12 padding0 margin3-top">
                                    <div class="col-sm-2 padding0"></div>
                                    <div class="col-sm-8  padding0">
                                        <span class="cooperation-text text2_KO font_korean" v-if="language ==2">{{cooperation.detail}}</span>
                                        <span class="cooperation-text text2_KO" v-else>{{cooperation.detail}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 padding0 margin4-top">
                                    <div class="col-sm-2 padding0"></div>
                                    <div class="col-sm-8 padding0 ">
                                        <textarea maxlength="2000" id="coodetail" v-model="detail" class="cooperation-textarea"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 padding0">
                                <div class="col-sm-12 padding0 margin3-top">
                                    <div class="col-sm-2 padding0"></div>
                                    <div class="col-sm-8  padding0 text-center" >
                                        <span class="cooperation-text text2_KO font_korean" v-if="language ==2" style="color:#afacac;text-align:centert">{{cooperation.helpmsg}}</span>
                                    </div>
                                </div>
                            </div>
                        <div v-if="!submitSuccess">
                            <div class="col-sm-12 padding0 margin2-top">
                                <div class="col-sm-12 padding0 text-center">
                                    <button class="cooperation-button" @click="submit()">{{cooperation.send}}</button>
                                </div>
                                <div v-if="warnMsgFlag" class="col-sm-12 padding0 margin4-top text-center">
                                    <span class="cooperation-warnMsg text2 font_korean" v-if="language ==2">{{cooperation.warnMsg}}</span>
                                    <span class="cooperation-warnMsg text2" v-else>{{cooperation.warnMsg}}</span>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="col-sm-12 padding0">
                                <div class="col-sm-12 padding0 margin3-top">
                                    <h2 v-if="language ==1" class="cooperation-thank"> 
                                        <span >
                                            <span class="head-float">
                                                {{cooperation.thanksword}}
                                            </span>
                                            <div class="clear"></div>
                                        </span>
                                    </h2>
                                    <h2 v-if="language == 0" class="cooperation-thank"> 
                                        <span >
                                            <span class="head-float">
                                                {{cooperation.thanksword}}
                                            </span>
                                            <div class="clear"></div>
                                        </span>
                                    </h2>
                                    <h2 v-if="language ==2" class="cooperation-thank" > 
                                        <span >
                                            <span class="head-float font_korean">
                                                {{cooperation.thanksword}}
                                            </span>
                                            <div class="clear"></div>
                                        </span>
                                    </h2>
                                </div>
                            </div> 
                            <div class="col-sm-12 padding0 margin3-top">
                                <div class="col-sm-12 padding0 text-center">
                                    <a v-if="language ==2" class="font_korean" @click="back()">{{cooperation.back}}</a>
                                    <a v-else  @click="back()">{{cooperation.back}}</a>
                                </div>
                            </div>                           
                        </div>
                    </div>
<!--                     <div class="col-sm-6 col-sx-12" v-else>
                        <p class="p-font text2-EN val-img" style="text-align:left">
                            {{cooperation.description}}
                        </p>
                    </div> -->
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
      }
    },
    methods: {

      back:function(){
         this.$router.push({'path': '/'})
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
</style>
