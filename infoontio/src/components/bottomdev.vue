<template>
  <div id="bottom">
    <footer class="container-val-background container-val-background-color">
        <div class="container footer-container" style="padding:0px">
            <div class="container-margin-footer">
                <div class="row copyright" style="color:grey">
                    <div class="col-sm-6 footer-mail-margin" style="padding:0px"> 
                        <img @click="toHome()" style="width:219px;" src="../assets/images/footerlogolight.png" />
                        <p class="margin3-top">E-mail: contact@ont.io</p>
                        <p class="margin4-top">Copyright © 2018 The Ontology Team</p>
                    </div>
                    <div class="col-sm-2" style="padding:0px"> </div>
                    <div class="col-sm-2" style="padding:0px" v-if="!language"> </div>
                    <div class="col-sm-2 " style="padding:0px"> 
                        <div class="col-sm-12 col-xs-0 footer-text" style="padding:0;line-height: 3em;">
                            <div class="col-sm-12 col-xs-6 footer-icon-lineheight margin4-bottom" style="padding:0" v-if="language ==1">
                                <a class="footer-icon-EN" target="view_window"  href="https://t.me/OntologyNetworkCN" ><span class=" col-sm-2 iconfont footer-title"  >&#xe715;</span>  <span class="margin4-left">Telegram</span></a>
                            </div>
                            <div class="col-sm-12 col-xs-6 footer-icon-lineheight margin4-bottom" style="padding:0" v-if="language ==0">
                                <a class="footer-icon-EN" target="view_window"  href="https://t.me/OntologyNetwork" ><span class=" col-sm-2 iconfont footer-title"  >&#xe715;</span>  <span class="margin4-left">Telegram</span></a>
                            </div>
                            <div class="col-sm-12 col-xs-6 footer-icon-lineheight margin4-bottom" style="padding:0" v-if="language ==2">
                                <a class="footer-icon-EN" target="view_window"  href="https://t.me/OntologyNetworkKO" ><span class=" col-sm-2 iconfont footer-title"  >&#xe715;</span>  <span class="margin4-left">Telegram</span></a>
                            </div>
                            <div class="col-sm-12 col-xs-6 footer-icon-lineheight margin4-bottom" style="padding:0" v-if="language==2">
                                <a class="footer-icon-EN" target="view_window" href="https://discord.gg/4TQujHj"><span class=" col-sm-2 iconfont footer-title " >&#xe66e;</span>  <span class="margin4-left">Discord</span></a>
                            </div> 
                            <div class="col-sm-12 col-xs-6 footer-icon-lineheight margin4-bottom" style="padding:0" v-else>
                                <a class="footer-icon-EN" target="view_window" href="https://discord.gg/4TQujHj"><span class=" col-sm-2 iconfont footer-title " >&#xe66e;</span>  <span class="margin4-left">Discord</span></a>
                            </div> 
                            <div class="col-sm-12 col-xs-6 footer-icon-lineheight margin4-bottom" style="padding:0">
                                <a class="footer-icon-EN" target="view_window" href="https://twitter.com/OntologyNetwork"><span class=" col-sm-2 iconfont footer-title" >&#xec9c;</span>  <span class="margin4-left">Twitter</span></a>
                            </div> 
                            <div class="col-sm-12 col-xs-6 footer-icon-lineheight margin4-bottom" style="padding:0">
                                <a class="footer-icon-EN"  target="view_window" href="https://www.facebook.com/Ontology-Network-468098413590227/"><span class=" col-sm-2 iconfont footer-title" >&#xe601;</span>  <span class="margin4-left">Facebook</span></a>
                            </div> 
                            <div class="col-sm-12 col-xs-6 footer-icon-lineheight margin4-bottom" style="padding:0">
                                <a class="footer-icon-EN" target="view_window" href="https://old.reddit.com/r/OntologyNetwork/" ><span class=" col-sm-2 iconfont footer-title"  >&#xe7d9;</span>  <span class="margin4-left">Reddit</span></a>
                            </div> 
                            <div class="col-sm-12 col-xs-6 footer-icon-lineheight margin4-bottom" style="padding:0">
                                <a class="footer-icon-EN" target="view_window" href="https://medium.com/ontologynetwork" ><span class=" col-sm-2 iconfont footer-title"  >&#xe9b5;</span>  <span class="margin4-left">Medium</span></a>
                            </div> 
                        </div>
                    </div>
                    <div class="col-sm-2" style="padding:0px" v-if="language ==1"> 
                        <div class="col-sm-12 col-xs-12 footer-text" style="padding:0;line-height: 3em;">     
                            <div class="col-sm-6 col-xs-6 footer-icon-lineheight margin4-bottom content-align" style="padding:0">
                                <div class="margin4-bottom footer-content-padding"><a class="footer-icon-EN" target="view_window"  ><span class="iconfont footer-title"  >&#xe630;</span>  <span class="margin5-left">WeChat</span></a></div>
                                <img class="margin4-bottom footer-content-padding" src="/static/img/wechat.jpg" style="width:100px"/>
                                <div class="footer-content-padding" style="font-size:10px">公众号:ONT本体</div>
                            </div>  
<!--                             <div class="col-sm-1" style="padding:0px"> </div> -->
<!--                             <div class="col-sm-5 col-xs-6 footer-icon-lineheight content-align" style="padding:0">
                                <div class="margin4-bottom footer-content-padding"><a class="footer-icon-EN "  target="view_window"   ><span class="iconfont footer-title"  >&#xe69d;</span>  <span class="margin5-left">QQ</span></a></div>
                                <img class="margin4-bottom footer-content-padding" src="static/img/qq5qun.png" style="width:100px"/>
                                <div class="footer-content-padding" style="font-size:10px">QQ 5群:652097017</br>（1,2,3,4群已满）</div>
                            </div>   -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 margin2-top" style="padding:0;"></div>
        </div>

    </footer>
  </div>
</template>

<script>
  $(function () { 
    $("[data-toggle='popover']").popover();
  });
  import { mapGetters, mapActions } from 'vuex'
  import Global from './Global.vue'
  export default {
    computed: mapGetters({
      FileZH: 'FileZH',
      FileEN: 'FileEN',
      AppFileZH: 'AppFileZH',
      AppFileEN: 'AppFileEN',
      NewsFileZH:'NewsFileZH',
      NewsFileEN:'NewsFileEN',
        article: 'article',

    }),
    created() {
      var lang = (navigator.systemLanguage?navigator.systemLanguage:navigator.language);
      var lang = lang.substr(0,2)
      if(this.$route.params.lang == 'zh'){
        this.language = 1;
      }else{
          if(this.$route.params.lang == 'ko'){
            this.language = 2;
          }else{
            this.language = 0;
          }
      }    
    },
    watch:{
      'FileEN':function(){
         this.footerPage = this.FileEN.footerPage
         this.language = false;
      },
      'FileZH':function(){
         this.footerPage = this.FileZH.footerPage
         this.language = true;
      },
      'AppFileEN':function(){
         this.footerPage = this.AppFileEN.footerPage
         this.language = false;
      },
      'AppFileZH':function(){
         this.footerPage = this.AppFileZH.footerPage
         this.language = true;
      },
      'NewsFileZH':function(){
         this.footerPage = this.AppFileZH.footerPage
         this.language = true;
      },
      'NewsFileEN':function(){
         this.footerPage = this.AppFileZH.footerPage
         this.language = false;
      },
      'article':function(){
         this.language = this.article.language;
      },
      '$route':function(){
        if(this.$route.params.lang == 'zh'){
            this.language = 1;
        }else{
            if(this.$route.params.lang == 'ko'){
              this.language = 2;
            }else{
              this.language = 0;
            }
        }  
      }
    },
    methods: {      
      toHome:function(){
         this.$router.push({'path': '/home'})
      },
      toHome:function(){
         this.$router.push({'path': '/home'})
      },
      toApp:function(){
         this.$router.push({'path': '/application/'+'page0'})
      },
      toTech:function(){
         this.$router.push({'path': '/technology'})
      }
     },
    data() {
      return {
        language:false,
        footerPage:{}
      }
    },
    beforeDestroy() {
    }
  }
</script>

<style>
 .logo{
   width: 100px;
 }
 .bottom-content{
   /*position: fixed;
   bottom: 0;*/
   width: 100%;
   height: 50px;
   text-align: center;
   padding-top: 10px;
   padding-bottom: 10px;
   color: gray;
   /*background-color: #25262C;*/
 }
 .container-val-background-color{
     background-color: #001b1e;
 }

</style>