<template>
  <div id="browser" style="z-index: 1;    background-repeat: no-repeat;background-size: 100%;">
    <Top></Top>
    <!-- for pic -->
    <!-- ONTOLOGY NETWORK -->
   <div  id="toptarget" ></div>
    <!-- ONTOLOGY NETWORK -->
    <div id="cooperation" class="home-page-content back-color container-padding-first container-val-background " style="z-index:10">
      <h1 class="margin2-top" style="color: #32a4be;text-align: center;">{{head.intro}}</h1>
      <div class="container home-detail zindex" >
          <p class="team-line margin3-top"></p>
          <div class="team-container margin2-top">
            <!--&lt;!&ndash;图片切换&ndash;&gt;-->
            <!--<div class="swiper-container">-->
              <!--<div class="swiper-wrapper">-->
                <!--<div class="swiper-slide">-->
                  <!--<img src="../../static/img/team1.jpg">-->
                <!--</div>-->
              <!--</div>-->
            <!--</div>-->
            <div class="team-all-intro">
              <p> {{head.teamIntroF}}</p>
              <p> {{head.teamIntroS}}</p>
              <!-- <p> {{head.teamIntroL}}</p> -->
            </div>

          </div>
        </div>
        <div class="container home-detail zindex ">
          <div class="team-container margin2-top">
            <p class="text-left head2 light-text">{{head.elite}}</p>
            <ul class="team-member margin3-top">
              <li v-for="(item,index) in teamList" @click="switchSelect(index)" t-city="0">
                <a class="img-content">
                  <span class="img-cover"><img :src=item.image></span>
                  <p class="head3 margin4-top">{{item.name}}</p>
                  <p class="text2 margin4-top">{{item.duty}}</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      <div class="container home-detail zindex ">
        <div class="team-container margin3-top">
          <!--<h2 class="text1 light-text margin3-top">{{head.expertTeam}}</h2>-->
          <ul class="team-member margin3-top">
            <li v-for="(item,index) in expertList" @click="switchSelect()" t-city="1">
              <a class="img-content">
                <span class="img-cover"><img :src=item.image></span>
                <p class="head3 margin4-top">{{item.name}}</p>
                <p class="text2 margin4-top">{{item.duty}}</p>
              </a>
            </li>
          </ul>
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
  import '../assets/ebro/css/team.css'
  import { mapGetters, mapActions } from 'vuex'
  import Bottom from './bottom.vue'
  import Global from './Global.vue'
  import Top from './head.vue'

  export default {
    mounted () {
      window.onresize = () => {
        this.addDetail();
      }
    },
    computed: {
      ...mapGetters({
        TeamFileEN: 'TeamFileEN',
        TeamFileZH: 'TeamFileZH',
        TeamFileKO: 'TeamFileKO',
        pageDetail: 'pageDetail'
      }),
      watchWidth:function () {
        this.fullWidth = window.innerWidth
      }
    },
    created() {
      console.log("fullwidth",this.fullWidth)
    //  new Swiper('.swiper-container', {autoplay: 5000, speed:500});
    },
    watch:{
      'TeamFileZH':function(){
        this.head = this.TeamFileZH.head;
        this.expertList = this.TeamFileZH.expertList;
        this.teamList = this.TeamFileZH.teamList;
        this.language = false;
        if(this.SelectFlag){
            this.addDetail()
        }
      },
      'TeamFileEN':function(){
        this.head = this.TeamFileEN.head;
        this.expertList = this.TeamFileEN.expertList;
        this.teamList = this.TeamFileEN.teamList;
        this.language = true;
        if(this.SelectFlag){
            this.addDetail()
        }
      },
      'TeamFileKO':function(){
        this.head = this.TeamFileKO.head;
        this.expertList = this.TeamFileKO.expertList;
        this.teamList = this.TeamFileKO.teamList;
        this.language = true;
        if(this.SelectFlag){
            this.addDetail()
        }
      },
      'pageDetail':function(){
        this.head = this.pageDetail.head;
        this.expertList = this.pageDetail.expertList;
        this.teamList = this.pageDetail.teamList;
        this.language = true;
        if(this.SelectFlag){
            this.addDetail()
        }
      }
    },
    methods: {
      switchSelect:function(ele){
        this.SelectFlag = true
        var select = "selected";
        var $this = $(".team-member li:eq("+ele+")");
        if($this.hasClass(select)){
          $this.removeClass(select);
          $("#teamDetail").remove();
        }else{
          $(".selected").removeClass(select);
          $this.addClass(select);
          this.addDetail();
        }
      },
      addDetail:function(){
        var obj = $(".selected");
        var objParent = obj.parent("ul");
        if(!obj) return;
        var city = obj.attr("t-city");
        var data;
/*         if (city==1){data = this.teamListBJ[obj.index()];}
        else {data = this.teamList[obj.index()];} */

        $("#teamDetail").remove();
        var _allNum = obj.siblings("li").length+1;
        var _num = Math.floor(objParent.width()/(obj.width()+20));
        var _line = Math.ceil((obj.index()+1)/_num);
        var liNum = _line*_num-1;
        var insertLi;
        if(_line <= this.lasttimeline ){
          if (city==1){
            data = this.teamListBJ[obj.index()];
          }else {
            data = this.teamList[obj.index()];
          }          
        }else{
          if (city==1){
            data = this.teamListBJ[obj.index()];
          }else {
            data = this.teamList[obj.index()]
          }               
        }
        if (liNum>=_allNum){
          insertLi = objParent.find("li:last");
        }else {
          insertLi = objParent.find("li:eq("+liNum+")");
        }
        var html = '<div class="team-detail margin4-bottom" id="teamDetail">' +
          '<div class="detail-img"><img src='+
          data.image+'></div>' +
          '<div class="detail-intro"><p class="text1 dark-text">'
          +data.name+'</p><p class="text2 margin4-top dark-text">'
          +data.duty+'</p><p class="text3 margin4-top">' +
         /*  '<span>'+this.head.exp+' ：</span>' +  */
          data.experience +
          '</p></div></div>';
        $(html).insertAfter(insertLi);
        this.lasttimeline = _line
      }
    },
    data() {
      return {
        head:{},
        teamListBJ:{},
        teamLis:{},
        lasttimeline:99,
        SelectFlag:false,
        language:false
      }
    },
    components: {
      Bottom,
      Top,
      Global
    },
  }

</script>

<style>


</style>
