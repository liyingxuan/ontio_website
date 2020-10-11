<template>
  <div class="container-fluid">
    <router-view></router-view>
    <div class="container-div">
      <div class="row container " style="margin:auto;">
        <div class="index-logo-warpper col-lg-8 "  style="padding-left:24px;">
            <img  src="/static/img/ontlogo.png" class="index-logo">
        </div>
      </div>
        <search-input></search-input>
    </div>
    <div class="div-transaction-list-page form-group container" v-if="transactionListDetail.length >0">
      <div class="row">
        <div class="col-lg-12">
          <p  class="text-center font-size40 font-ExtraLight p_margin_bottom_L normal_color margin-top32" >Swap List</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <p style="text-align:right">Change Balance: {{changebalance}} ONT *</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <table class="table table-hover">
            <thead>
            <tr>
              <th class="trl-tab-border-top-none font-size18 " style="padding-top:34px;" scope="col">{{ $t('transactionList.TxnId') }}</th>
              <th class="trl-tab-border-top-none font-size18" scope="col">STATUS</th>
              <th class="trl-tab-border-top-none font-size18" scope="col">AMOUNT</th>
              <th class="trl-tab-border-top-none font-size18" scope="col">ASSET</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(transaction,index) in transactionListDetail" v-if="transaction.assetname =='ont'" :class="transaction.selected ? 'swap-item':''">
              <td class="font-size14 font-Regular important_color td_height3 click_able"@click="getDetail(transaction.txnhash,index)">{{transaction.txnhash}}</td>
              <td v-if="transaction.state ==2" class="font-size14 font-Regular s_color td_height3">Success</td>
              <td v-else class="font-size14 font-Regular f_color td_height3">Failed</td>
              <td class="font-size14 font-Regular normal_color td_height3">{{transaction.amount}}</td>
              <td class="font-size14 font-Regular normal_color td_height3">ONT</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row justify-content-center" v-if="Detail.info">
        <div class="col-lg-12" >
          <div class="col-lg-12 font-Regular" style="background: white;padding-top:10px;padding-bottom:10px">
            <p class="font-Regular" style="text-align:left;margin-top:20px;color:#aeaeae;font-size:14px;" v-if="sdetail.state == 2">Status: <span class="s_color">Success</span></p>
            <p class="font-Regular" style="text-align:left;margin-top:20px;color:#aeaeae;font-size:14px;" v-else-if="sdetail.state == 1">Status: Processing</p>
            <p class="font-Regular" style="text-align:left;margin-top:20px;color:#aeaeae;font-size:14px;" v-else-if="sdetail.state == 0">Status: Waiting</p>
            <p class="font-Regular" style="text-align:left;margin-top:20px;color:#aeaeae;font-size:14px;" v-else>Status: Failed</p>
            <p class="font-Regular" style="text-align:left;margin-top:20px;color:#aeaeae;font-size:14px;">Request Amount: {{sdetail.neo_amount}} ONT</p>
            <p class="font-Regular" style="text-align:left;margin-top:20px;color:#aeaeae;font-size:14px;">Swap Amount: {{sdetail.amount}} ONT</p>
            <p class="font-Regular" style="text-align:left;margin-top:20px;color:#aeaeae;font-size:14px;">Swap Time: {{getDate(sdetail.requestTime)}}</p>
            <p class="font-Regular" style="text-align:left;margin-top:20px;color:#aeaeae;font-size:14px;">Address: {{sdetail.address}}</p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <p class="font-Regular" style="text-align:left;margin-top:20px;color:#aeaeae;font-size:14px;">* Since MainNet ONT is indivisible (smallest unit 1 ONT), only whole numbers of NEP-5 ONT can be mapped. If you have smaller units of NEP-5 ONT we recommend you make your ONT a whole number before mapping.</p>
        </div>
      </div>
    </div>
    
    <div class="div-transaction-list-page form-group container progress-container" >
      <div class="row">
        <div class="col-sm-12">
          <p  class="text-center font-size40 font-ExtraLight  normal_color margin-top32" >Total Swap Process</p>
        </div>
        <div class="col-sm-12">
          <div class="countdownwrapper">
             <!-- <count-down class="countdown-font" v-on:start_callback="countDownS_cb(1)" v-on:end_callback="countDownE_cb(1)" :startTime="(new Date()).valueOf()" :endTime="1538395200" :tipText="'距离开始文字1'" :tipTextEnd="'Closing in'" :endText="'Token Swap Closed'" :dayTxt="'D :'" :hourTxt="'H :'" :minutesTxt="'M :'" :secondsTxt="'S'"></count-down>
              --><div class="countdown-font">
                <p><a href="https://medium.com/ontologynetwork/ontology-mainnet-token-swap-fallback-plan-be18c46e54da" target="_blank">You can still swap till the end of the year!</a></p>
                <p><a href="https://medium.com/ontology-cn/%E9%92%88%E5%AF%B9%E6%9C%AA%E5%AE%8C%E6%88%90%E6%9C%AC%E4%BD%93%E4%B8%BB%E7%BD%91%E6%98%A0%E5%B0%84%E7%94%A8%E6%88%B7%E7%9A%84%E6%96%B9%E6%A1%88-57a0caf4f2b4" target="_blank">本体主网映射将开放至今年年底。</a></p>
              </div>
          </div>
        </div>
        <div class="col-sm-12">
          <p  class="text-center font-size18 font-Regular  normal_color "  style="color:#AAB3B4;margin-top:1rem;" >Total ONT amount: 1 billion</p>
        </div>
        <div class="process-title">
          <div class="col-sm-12 padding0"><p class="process-title-text">Started Swap:</p></div>
        </div>
        <div class="process-content">
          <div class="progress">
             <div id="startbar" class="bar" ></div>
          </div>
          <div id="startbarnum" class="barnum" >{{startpercent}}</div>
        </div>
        <div class="process-title">
          <div class="col-sm-12 padding0"><p class="process-title-text">Finished Swap:</p></div>
        </div>
        <div class="process-content">
          <div class="progress">
             <div id="finishbar" class="finbar" ></div>
          </div>
          <div id="finishbarnum" class="barnum" >{{finishpercent}}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {mapState} from 'vuex'
  import Helper from './../../helpers/helper.js'
  import RunStatus from "./RunStatus";
  import SearchInput from './../home/SearchInput'
  import OntIdList from "./OntIdList";
  import TransactionList from "./TransactionList";
  import AddressMsg from "./AddressMsg";
  import BlockList from "./BlockList";
  import CountDown from '../common/CountDown';

  export default {
    name: 'Home',
    mounted: function() {
    },
    computed:{
      ...mapState({
        getTxnState: state => state.Txnstate.TxnState,
        Change: state => state.Txnstate.Change,
        Detail: state => state.Txnstate.Detail,
        Progress: state => state.Txnstate.Progress
      }),
    },
    created() {
        this.getProgress()
        if(this.$route.params.address != undefined){
          this.getState()
          this.getChange()
        }
    },
    watch: {
      '$route.params': function(){
            this.getall()
      },
      'height': function(){
         /* console.log(this.height) */
      },
      'getTxnState.info': function(){
            this.transactionListDetail = this.getTxnState.info.TxnList
            for(var i =0;i<this.transactionListDetail.length;i++){
              this.transactionListDetail[i].selected = false
            }
      },
      'Change.info': function(){
            this.changebalance = this.Change.info.ontchange
      },
      'Detail.info': function(){
            this.sdetail = this.Detail.info
      },
      'Progress.info': function(){
            this.progressinfo = this.Progress.info
            console.log(this.Progress.info)
            this.startpercent = (this.progressinfo.Amount/10000000).toFixed(2)+"%"
            this.finishpercent = (this.progressinfo.SwapAmount/10000000).toFixed(2)+"%"
            console.log(this.finishpercent )
            console.log(this.startpercent )
            $("#startbar").css("width",this.startpercent)
            $("#finishbar").css("width",this.finishpercent)
            $("#startbarnum").css("width",this.startpercent)
            $("#finishbarnum").css("width",this.finishpercent)
      }
    },
    methods:{
      getall(){
        this.getState()
        this.getChange()
      },
      getState() {
        // do something
        this.$store.dispatch('getTxnState',this.$route.params).then(response => {
          //console.log(response)
        }).catch(error => {
          console.log(error)
        })
      },
      getProgress() {
        // do something
        this.$store.dispatch('getprogress').then(response => {
          //console.log(response)
        }).catch(error => {
          console.log(error)
        })
      },
      getChange() {
        // do something
        this.$store.dispatch('getChange',this.$route.params).then(response => {
          //console.log(response)
        }).catch(error => {
          console.log(error)
        })
      },
      getDetail($txnhash,$index) {
        // do something
        debugger
            for(var i =0;i<this.transactionListDetail.length;i++){
              if(i ==$index ){
                this.transactionListDetail[i].selected = true
              }else{
                this.transactionListDetail[i].selected = false
              }
            }
        this.transactionListDetail.reverse().reverse()
        this.$route.params.txnhash = $txnhash
        this.$store.dispatch('getDetail',this.$route.params).then(response => {
          //console.log(response)
        }).catch(error => {
          console.log(error)
        })
      },
      getDate($time){
        return Helper.getDate($time)
      },
      toTransactionDetailPage($TxnId){
        window.open("https://explorer.ont.io/transaction/"+$TxnId)
      },
    },
    data() {
      return {
        readynet:"Mainnet",
        notreadynet:"Polaris 1.0.0",
        changebalance:0,
        sdetail:{
/*             requestTime: 1529488766,
            amount: "7.00000000",
            address: "AJzoeKrj7RHMwSrPQDPdv61ciVEYpmhkjk",
            neo_amount: "7.15000000",
            confirmtime: 1529494602,
            assetname: "ont",
            state: 2 */
        },
        finishpercent:0,
        startpercent:0,
        progressinfo:{
          SwapAmount:"847827784.000000000",
          Amount:"848144798.9709413"
          },
        transactionListDetail:[
/*           {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"},
          {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"},
          {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"},
          {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"},
          {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"},
          {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"},
          {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"},
          {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"},
          {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"},
          {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"},
          {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"},
          {amount:11,txnhash:"af785e6060f72a86865908a02219c02067553012c42a39814c0e00e5f2880777",state:2,assetname:"ont"}, */
        ]
      }
    },
    components: {
      BlockList,
      AddressMsg,
      TransactionList,
      OntIdList,
      SearchInput,
      RunStatus,
      CountDown
    }
  }
</script>

<style>
.net-notready{
  color:#817f7c !important;
  cursor: pointer;
}
.net-ready{
  cursor: pointer;
}
.margin-top32{
  margin-top: 32px;
}
.swap-item{
  background-color: rgba(0,0,0,0.075);
}
.process-title {
    height: 30px;
    margin: auto;
    margin-top: 20px;
}
.process-content {
    height: 50px;
    margin: auto;
    margin-top: 10px;
}
.process-back{
  height: 25px;
    border-radius: 7.5px;
    background-color: #2B4045;
}
.process-start{
    height: 17px;
    border-radius: 4.5px;
    background-color: #7ED321;
    margin-top: 4px;
    margin-bottom: 4px;
}

	.progress {
	  overflow: hidden;
	  height: 25px;
    padding-left:4px;
    padding-right:4px;
	  background-color: #2B4045;
	  background-image: -moz-linear-gradient(top, #2B4045, #2B4045);
	  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#2B4045), to(#2B4045));
	  background-image: -webkit-linear-gradient(top, #2B4045, #2B4045);
	  background-image: -o-linear-gradient(top, #2B4045, #2B4045);
	  background-image: linear-gradient(to bottom, #2B4045, #2B4045);
	  background-repeat: repeat-x;
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff5f5f5', endColorstr='#fff9f9f9', GradientType=0);
	  -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
	  -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
	  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
	  -webkit-border-radius: 7.5px;
	  -moz-border-radius: 7.5px;
	  border-radius: 7.5px;
	}
	
	.progress .bar {
	  width: 0%;
	  height: 17px;
    margin-top:4px;
	  color: #ffffff;
	  float: left;
	  font-size: 12px;
	  text-align: center;
	  align-items: center;
	  display: flex;
	  justify-content: center;
	  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
	  background-color: #7ED321;
	  background-image: -moz-linear-gradient(top, #7ED321, #7ED321);
	  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#7ED321), to(#7ED321));
	  background-image: -webkit-linear-gradient(top, #7ED321, #7ED321);
	  background-image: -o-linear-gradient(top, #7ED321, #7ED321);
	  background-image: linear-gradient(to bottom, #7ED321, #7ED321);
	  background-repeat: repeat-x;
	  -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
	  -moz-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
	  box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
	  -webkit-box-sizing: border-box;
	  -moz-box-sizing: border-box;
	  box-sizing: border-box;
	  -webkit-transition: width 0.6s ease;
	  -moz-transition: width 0.6s ease;
	  -o-transition: width 0.6s ease;
	  transition: width 0.6s ease;
	  -webkit-border-radius: 4.5px;
	  -moz-border-radius: 4.5px;
	  border-radius: 4.5px;
	}
	.progress .finbar {
	  width: 0%;
	  height: 17px;
    margin-top:4px;
	  color: #ffffff;
	  float: left;
	  font-size: 12px;
	  text-align: center;
	  align-items: center;
	  display: flex;
	  justify-content: center;
	  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
	  background-color: #35BFDF;
	  background-image: -moz-linear-gradient(top, #35BFDF, #35BFDF);
	  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#35BFDF), to(#35BFDF));
	  background-image: -webkit-linear-gradient(top, #35BFDF, #35BFDF);
	  background-image: -o-linear-gradient(top, #35BFDF, #35BFDF);
	  background-image: linear-gradient(to bottom, #35BFDF, #35BFDF);
	  background-repeat: repeat-x;
	  -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
	  -moz-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
	  box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
	  -webkit-box-sizing: border-box;
	  -moz-box-sizing: border-box;
	  box-sizing: border-box;
	  -webkit-transition: width 0.6s ease;
	  -moz-transition: width 0.6s ease;
	  -o-transition: width 0.6s ease;
	  transition: width 0.6s ease;
	  -webkit-border-radius: 4.5px;
	  -moz-border-radius: 4.5px;
	  border-radius: 4.5px;
	}
  .process-title-text{
    font-family: SourceSansPro-Bold;
    font-size: 18px;
    color: #2B4045;
    letter-spacing: 0;
    line-height: 18px;
  }
  .barnum{
    text-align: right;
    font-family: SourceSansPro-Bold;
    font-size: 24px;
    color: #32A4BE;
    letter-spacing: 0;
    line-height: 24px;
    margin-top:8px;
  }
@media screen and (min-width:768px){
  .progress-container{
      
  }
  .process-content{      
    width:670px;
  }
  .process-title{      
    width:670px;
  }
}
@media screen and (max-width:768px){
  .progress-container{
      padding-left:16px;
      padding-right:16px;
  }
  .process-content{      
    padding-left:16px;
    padding-right:16px;
    width:100%;

  }
  .process-title{      
    padding-left:16px;
    padding-right:16px;
    width:100%;

  }
}
.countdown-font p{
  text-align: center;
    font-family: sans-serif;
    color:#D3A02E;
        padding: 10px 0;
    margin-bottom: 0px;
}
.countdown-font p a{
  text-align: center;
    font-family: sans-serif;
    color:#D3A02E;
        padding: 10px 0;
    margin-bottom: 0px;
}
.countdown-font p a:hover{
  text-decoration: none;
  color:#f3ae14;
}
.countdown-font p i{
  font-style: normal;
}
.countdownwrapper{
  background-color: #2B4045;
/*   height: 80px; */
  width: 358px;
  margin: auto;
  border-radius: 9px;
}
</style>
