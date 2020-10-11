<template>
  <div id="browser" style="z-index: 1;    background-repeat: no-repeat;background-size: 100%;">
    <Top></Top>
   <div  id="toptarget" ></div>
    <div class="col-sm-12 kyc-first-margin"  ></div>
    
<!-- ONTOLOGY NETWORK -->
    <div id="Triones" class="home-page-content back-color container-padding-first container-val-background container-padding-first-kyc" style="z-index:10">
<!--         <div class="container home-detail zindex container-pos" >
            <div class="row">
                <div class="col-sm-12 margin1-bottom" style="padding:0;border-bottom:1px solid rgb(210, 208, 208);"></div>
                <div class="midpoint home-text-fir home-text-title" >
                    <div style="text-align:center;">
                        <div class="title-margin col-sm-3"></div>
                        <div class="title-margin col-sm-6" >
                            <h1 v-if="language"> 
                                <span >
                                    <span class="head-float">
                                        {{Triones.firstTitle1}}
                                    </span>
                                    <div class="clear"></div>
                                </span>
                            </h1>

                            <h1 v-else class="h1-EN" > 
                                <span >
                                    <span class="head-float">
                                        {{Triones.firstTitle1}}
                                    </span>
                                    <div class="clear"></div>
                                </span>
                            </h1>

                            <div v-if="language" class="text1 h2-padding margin3-top secondtitle-width">
                                <span >
                                    {{Triones.secondTitle1}}
                                </span>
                            </div>
                            <div v-else class="text1-EN h2-padding margin3-top secondtitle-width"> 
                                <span >
                                    {{Triones.secondTitle1}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="container home-detail zindex ">
            <div class="container-margin-ontdesc">
                <div class="row " style="color:black">
                        <div >
                            <div class="col-sm-12 padding0">
                                <div class="col-sm-12 padding0 ">
                                    <div class="col-sm-2 padding0"></div>
                                    <div class="col-sm-8  padding0">
                                            <div class="col-sm-12 padding0 "  v-for="(item,index) in Triones.list">
                                                <div v-if="item.title" class="text-center margin3-top margin3-bottom"  >
                                                    <span class="h2">{{item.title}}</span>
                                                </div>
                                                <div v-if="item.secondtitle" class="margin4-top">
                                                    <span class="h3 h3head">{{item.secondtitle}}</span>
                                                </div>
                                                <div v-if="item.item" class="margin4-top">
                                                    <span class="text2">{{item.item}}</span>
                                                </div>
                                                <div v-if="item.table" class="margin4-top tablescroll" >
                                                  <table class="table table-hover" rules="all" style="width:630px;">
                                                    <thead>
                                                      <tr class="tablehead">
                                                        <td v-for="(head,index) in item.table.head" >
                                                                {{head.headitem}}
                                                        </td>
                                                      </tr>
                                                    </thead>
                                                    <tbody class="tablecontent">
                                                      <tr v-for="(content,index) in item.table.content">
                                                        <td v-for="(content,index) in content" >
                                                                {{content.contentitem}}
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
<!--                             <div class="col-sm-12 padding0">
                                <div class="col-sm-12 padding0 ">
                                    <div class="col-sm-2 padding0"></div>
                                    <div class="col-sm-8  padding0 text-center margin3-top">
                                        <input id="check1" type='checkbox' class='input-checkbox'  v-model='checked' v-on:click='checkedAll'>
                                        <label for="check1 checkbox-size" style="color:#8E9496">{{Triones.checkbox}}</label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-sm-12 padding0 margin3-top">
<!--                                 <div class="col-sm-12 padding0 text-center">
                                    <a class="Triones-button-active process-label-active" href="https://goo.gl/forms/UuSf4YN0H3Y3dDqm2" target="_blank">{{Triones.send}}</a>
                                </div> -->
                                <div class="col-sm-12 padding0 text-center">
                                    <a class="Triones-button-active process-label-active" @click="toNode($route.params.lang)" >{{Triones.node}}</a>
                                </div>
                                <div v-if="warnMsgFlag" class="col-sm-12 padding0 margin4-top text-center">
                                    <span class="Triones-warnMsg text2">{{Triones.warnMsg}}</span>
                                </div>
                            </div>
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
  import '../assets/ebro/css/kyc.css'
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
        TrionesEN: 'TrionesEN',
        TrionesZH: 'TrionesZH'
      })
    },
    created() {
        if(this.$router.params.lang == undefined){
            debugger
            this.$store.dispatch('TrionesEN',this.params)
        }else{
            if(this.$router.params.lang =='zh'){
                this.$store.dispatch('TrionesZH',this.params)
            }else{
                this.$store.dispatch('TrionesEN',this.params)
            }
        }
      this.timeoutBlock = setTimeout(() => {
        this.scrollTo("toptarget")
        }
      ,100)
    },
    watch:{
      'TrionesEN':function(){
         this.Triones = this.TrionesEN.Triones
         this.error = this.TrionesEN.Error
         this.footerPage = this.TrionesEN.footerPage
         this.language = false;
      },
      'TrionesZH':function(){
         this.Triones = this.TrionesZH.Triones
         this.error = this.TrionesZH.Error
         this.footerPage = this.TrionesZH.footerPage
         this.language = true;
      }
    },
    methods: {
        toNode:function(lang){
            this.$router.push({'path': '/listtriones/'+lang})
        },
        tokyc1:function(){
            this.$router.push({'path': '/kyc1'})
        },
        tokyc0:function(){
            this.$router.push({'path': '/kyc0'})
        },
/* 报错系统 */        
        showError:function(id,act1,act2){ 
            this.errorTitle  = this.error["error"+id]
            this.errorMsg = this.error["errorMsg"+id]
            this.Close = this.error.buttonClose
            this.Save = this.error.buttonSave
            this.act1 = act1
            this.act2 = act2
            document.getElementById("errorMsg").click()
        },
        changeError:function(id,act1,act2){
            this.errorTitle  = this.error["error"+id]
            this.errorMsg = this.error["errorMsg"+id]
            this.Close = this.error.buttonClose
            this.Save = this.error.buttonSave
            this.act1 = act1
            this.act2 = act2            
        },
/* 定时系统 */
        setclock:function(){
            Global.starttime = Date.parse(new Date())/1000;
            this.cutdownTime = 600
            this.intervalid0 = setInterval(() => {
                this.cutdownTime = this.cutdownTime - 10
               /*  console.log(this.cutdownTime) */
                if(this.cutdownTime <10){
                    clearInterval(this.intervalid0)
                    this.cutdownTime = 600
                    this.showError("1",4,1)
                }
            }, 10000)
        },
        resetclock:function(){
            this.clearAll(this.intervalid0)
            this.setclock()
        },
        checktime:function(){
            var nowtime = Date.parse(new Date())/1000;
            var duringtime = nowtime - Global.starttime
            var result = true
            if(duringtime>600 && duringtime<900 ){
                result =  true
            }
            if(duringtime>900 ){
                result = false
            }      
            return  result
        },
        clearAll:function(array){
            for (var i = array ; i >= 0; i--) {
            // if (typeof array[i] !== 'undefined') {
                clearInterval(i);
            // };
            };
        },
/* 报错处理 */
        action:function(act){
          if(this.checktime()){
            if(act==1){
                this.continue()
            }
            if(act==2){
                this.overtime()
            }
            if(act==3){
                this.continue()
            }
            if(act==4){
                this.Destroy()
            }
          }else{
            this.Destroy()
          }
        },
        continue:function(){
            debugger
            document.getElementById("errorMsg").click()
            this.clearAll(this.intervalid0)
            this.setclock()
        },
        overtime:function(){     
            clearInterval(this.intervalid0)
            if($("#myModal").hasClass("in")){
                this.changeError("2",4,4)
            }else{
                this.showError("2",4,4)
            }
        },
        Destroy:function(){
            document.getElementById("errorMsg").click()
            document.cookie="kycphoneAuth="+escape(false);
            document.cookie="kycAuth="+escape(false);
            Global.Name =""
            Global.Phone =""
            Global.Nation =""
            Global.IdNumber =""
            Global.IdType =""
            Global.PictureFrontEnd =""
            Global.PictureBackEnd =""
            Global.PictureWithMan =""
            Global.WebChatName =""
            Global.WebChatId =""
            Global.QQ =""
            Global.Telegram =""
            Global.Weibo =""
            Global.NeoAddress =""
            Global.Slack =""
            Global.IdNumberEncrypt =""
            Global.NameEncrypt =""
            Global.NeoAddressEncrypt =""
            Global.PhoneEncrypt =""
            Global.QQEncrypt =""
            Global.SlackEncrypt =""
            Global.TelegramEncrypt =""
            Global.TwitterEncrypt =""
            Global.WebChatIdEncrypt =""
            Global.WebChatNameEncrypt =""
            Global.WeiboEncrypt =""
            Global.starttime = 0
/*             console.log(Global) */
            if(Global.EmailCode==""){
                this.$router.push({'path': '/kyc0'})
            }else{
                this.$router.push({'path': '/kyc0/'+Global.Email+'/'+Global.EmailCode})
            }
        },
        nextStep:function(){
            if(!this.checktime()){
                this.exit()
            }else{
                if(this.checked){
                    this.tokyc1()
                }else{
    /*                 alert("请阅读完隐私声明并点击已阅读按钮") */
                    this.showError("3",1,1)
                    return
                }
            }
        },
         inputWarn:function(id,boolean){
             var $target = $("#"+id);
             if(boolean){
                 $target.css("border","4px solid #324349")
             }else{
                 $target.css("border","2px solid #32A4BE")
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
        /*   console.log("num: "+num); */
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
         }
     },
    data() {
      return {
        submitSuccess:false,
        warnMsgFlag:false,
        Randomcode:'',
        checked:false,
        Email:'',
        EmailCode:'',
        name:'',
        contact:'',
        detail:'',
        icontest:'icon-shenfenzhengming ',
        language:false,
        scrnum:'',
        head:{},
        Triones:{},
        footerPage:{},
        errorTitle:'',
        errorMsg:'',
        close:'',
        Save:'',
        error:{},
        cutdownTime:600,
        exitTime:900,
        act1:'',
        act2:''
      }
    },
    components: {
      Bottom,
      Top,
      Global
    },
    beforeDestroy() {
        this.clearAll(this.intervalid0)
    }
  }
</script>

<style>
@media only screen and (max-width: 1000px) {
    .tablescroll {
        overflow-x: scroll;
    }
}
.tablehead{
    background-color: #32a4be;
    color: white;
    font-weight: bold;
}
.tablecontent{
    background-color: #f6f6f6;
}
td{
    border-color:white;
}
.Triones-button-active{
    height: 50px;
    width: 260px;
    font-family:var(--Light-font-ZH);
    color: white;
    font-size: 18px;
    border: 1px solid #32A4BE;
    border-radius: 5px;
    padding: 10px;
}
.Triones-button-active:focus{
    outline: none;
    color: white;
}
.Triones-button-active:hover{
    color: white;
}
@media only screen and (max-width: 768px) {
    .h3head {
        font-size: 16px !important;
    }
}
@media only screen and (min-width: 768px) {
    .h3head {
        font-size: 16px !important;
    }
}
</style>
