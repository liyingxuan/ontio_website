<template>
  <div id="browser" style="z-index: 1;background-repeat: no-repeat;background-size: 100%;">
    <Top></Top>

    <div class="trust-margin-t">
      <!--Trust Ecosystem说明和合作方logo-->
      <div class="first-bg">
        <img class="hidden-xs hidden-sm first-bg-img" src="./../assets/images/trust-anchor/Oval@2x.png" alt="">
        <img class="hidden-lg hidden-md  first-bg-img-2" src="./../assets/images/trust-anchor/Oval_m@2x.png" alt="">

        <div class="container" style="max-width: 1200px;">
          <div class="row text-center trust-tit">Ontology Trust Anchor</div>

          <div class="row" style="margin-top: 64px;">
            <div class="col-lg-offset-1 col-lg-3 text-center">
              <img src="./../assets/images/trust-anchor/anchor.png" alt="" style="margin-bottom: 50px">
            </div>
            <div class="col-lg-7 text-left trust-anchor-desc">
              Trust Anchor refers to the partner that provides authentication services on the ontology ecosystem.
              It may be government agencies, universities, banks, third-party authentication service agencies
              (such as CA agencies), biometric technology companies, etc. These trust anchor provide multi-dimensional
              authentication for the owner of the ontology ONT ID, and record the authentication behavior and the
              authentication result HASH through the Ontology Blockchain at the first time, thus providing standardized
              and credible for the user authentication requirment.
            </div>
          </div>
          
          <div class="row text-center div-bottom-center">
            <img class="icons-css" src="./../assets/images/trust-anchor/icon_CFCA.png" alt="">
            <img class="icons-css" src="./../assets/images/trust-anchor/icon_Identitymind.png" alt="">
            <img class="icons-css" src="./../assets/images/trust-anchor/icon_sensetime.png" alt="">
            <img class="icons-css" src="./../assets/images/trust-anchor/icon_shuftipro.png" alt="">
            <img class="icons-css" src="./../assets/images/trust-anchor/icon_4stop.png" alt="">
          </div>
        </div>
      </div>

      <!--trust anchors数据展示-->
      <div class="second-bg">
        <img class="hidden-xs second-bg-img" src="./../assets/images/trust-anchor/map.png" alt="">
        <img class="hidden-lg hidden-md hidden-sm second-bg-img-xs" src="./../assets/images/trust-anchor/map.png" alt="">

        <div class="container" style="max-width: 1200px;">
          <div class="row text-center coverage-map">
            <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
              <div class="row">
                <div class="col-lg-4 col-md-4" style="margin-bottom: 24px">
                  <div class="row font-64">5</div>
                  <div class="row">Trust Anchors</div>
                </div>
                <div class="col-lg-4 col-md-4" style="margin-bottom: 24px">
                  <div class="row font-64">6</div>
                  <div class="row">Types of Identity Documents</div>
                </div>
                <div class="col-lg-4 col-md-4" style="margin-bottom: 24px">
                  <div class="row font-64">218</div>
                  <div class="row">Countries and regions around the world</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center see-c-d"><a @click="toTableLists">See Coverage Details &#8594</a></div>
      </div>

      <!--KYC和login等说明-->
      <div class="third-bg">
        <div class="container" style="max-width: 1200px;">
          <div class="row" style="margin-top: 72px">
            <div class="col-lg-6 col-md-6">
              <div class="row text-center">
                <img src="./../assets/images/trust-anchor/icon_kyc.png" alt="">
              </div>
              <div class="row text-center kyc-login-tit">Decentralize KYC service integration</div>
              <div class="row kyc-login-text">
                Ontology provides the enterprise with reusable KYC service, and combines the TrustAnchor of the
                authentication service in the ontology trust ecosystem to provide users with verifiable, trustworthy,
                and identifiable identity authentication services.
              </div>
              <div class="hidden-lg hidden-md row text-center kyc-login-connect" style="margin-bottom: 64px">
                <a :href="kycUrl" target="_blank">Connect &#8594</a>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="row text-center">
                <img src="./../assets/images/trust-anchor/icon_ont_id.png" alt="">
              </div>
              <div class="row text-center kyc-login-tit">Password-less login service integration</div>
              <div class="row kyc-login-text">
                Through the Ont ID login protocol, your website supports ONT ID authorization to login and share the
                ontology ecological resources. Integrated ONT ID third-party login component, users can login to any
                system through ONTO scan code, without password, based on private key signature, build a secure and
                reliable login component.
              </div>
              <div class="hidden-lg hidden-md row text-center kyc-login-connect" style="margin-bottom: 64px">
                <a :href="loginUrl" target="_blank">Connect &#8594</a>
              </div>
            </div>
          </div>
          <div class="hidden-xs hidden-sm row" style="margin-bottom: 30px;">
            <div class="col-lg-6 col-md-6">
              <div class="row text-right kyc-login-connect">
                <a :href="kycUrl" target="_blank">Connect &#8594</a>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="row text-right kyc-login-connect">
                <a :href="loginUrl" target="_blank">Connect &#8594</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Wanna be our Trust Anchor-->
      <div class="hidden-xs" style="position: relative; width: 100%; text-align: center;">
        <img class="wanna-be-our" src="./../assets/images/trust-anchor/bg_banner_trust_anchor@2x.png" alt="">
        <div class="wanna-be-our-txt">
          <a :href="ontEmail">Wanna be our Trust Anchor? Talk to us.</a>
        </div>
      </div>

      <!--Wanna be our Trust Anchor —— mobile style-->
      
     <!-- 20181106 remove -->  
      <!-- <div class="hidden-lg hidden-md hidden-sm" style="position: relative; width: 100%; text-align: center; margin-top: 20px"> -->
      <div class="hidden-lg hidden-md hidden-sm" style="position: relative; width: 100%; text-align: center;">
        <img class="wanna-be-our-2" src="./../assets/images/trust-anchor/bg_banner_trust_anchor@2x-mobile.png" alt="">
        <div class="wanna-be-our-phone">
          <a :href="ontEmail">
            <p>Wanna be our</p>
            <p>Trust Anchor?</p>
            <p>Talk to us.</p>
          </a>
        </div>
      </div>
    </div>

    <Bottom></Bottom>
  </div>
</template>

<script>
  import Top from './head.vue'
  import Bottom from './bottom.vue'

	export default {
    name: "TrustAnchors",
    data() {
      return {
        kycUrl: 'https://github.com/ontio/ontology-DID/blob/master/docs/en/thirdparty_specification.md',
        loginUrl: 'https://github.com/ontio/ontology-DID/blob/master/docs/cn/thirdparty_login_cn.md',
        ontEmail: 'mailto:' + 'contact@ont.io'
      }
    },
    methods: {
      toTableLists() {
        this.$router.push({'path': '/trust-anchor-coverage/en'})
      }
    },
    components: {Top, Bottom}
  }
</script>

<style scoped>
  .trust-margin-t {
    margin-top: 50px;
  }

  .first-bg {
    position: relative;
    width: 100%;
    min-height: 615px;
    background: linear-gradient(360deg, rgba(97, 209, 224, 1) 0%, rgba(73, 186, 207, 1) 45%, rgba(50, 164, 190, 1) 100%);
  }

  .second-bg {
    position: relative;
    width: 100%;
    min-height: 480px;
    background: linear-gradient(270deg, rgba(31, 53, 57, 1) 0%, rgba(13, 24, 26, 1) 100%);
  }

  .third-bg {
/*     min-height: 480px; */
/*     20181106 remove  */
    display: none;
  }

  .first-bg-img,
  .first-bg-img-2 {
    position: absolute;
    bottom: 0;
    width: 100%;
    min-height: 160px;
  }
  .first-bg-img-2 {
    height: 273px;
  }

  .second-bg-img,
  .second-bg-img-xs {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
  }
  .second-bg-img-xs {
    width: 100%;
  }

  .coverage-map {
    margin-top: 160px;
  }

  .trust-tit {
    font-size:40px;
    font-family:SourceSansPro-Light, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight:300;
    color:rgba(255,255,255,1);
    line-height:50px;
    margin-top: 40px;
  }

  .trust-anchor-desc {
    font-size:16px;
    font-family:PingFangSC-Regular, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight:400;
    color:rgba(194,231,243,1);
    line-height:24px;
    padding: 0 15px 0 45px;
  }

  .div-bottom-center {
    position: absolute;
    bottom: 50px;
    left: 0;
    right: 0;
    margin: auto
  }

  .icons-css{
    margin: 37px 28px 0;
  }

  .font-64 {
    font-size: 64px;
    font-family: SourceSansPro-ExtraLight, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight: 200;
    color: rgba(255, 255, 255, 1);
    line-height: 80px;
  }

  .see-c-d {
    font-size:22px;
    font-family:SourceSansPro-Semibold, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight:600;
    line-height:30px;
    position: absolute;
    bottom: 40px;
    left: 0;
    right: 0;
    margin: auto;
  }

  .see-c-d > a,
  .kyc-login-connect > a {
    color:rgba(50,164,190,1) !important;
  }

  .see-c-d > a:hover,
  .wanna-be-our-txt > a:hover,
  .wanna-be-our-phone > a:hover,
  .kyc-login-connect > a:hover {
    text-decoration: underline;
    opacity: 0.6;
  }

  .kyc-login-tit {
    height: 25px;
    font-size: 20px;
    font-family: SourceSansPro-Semibold, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight: 600;
    color: rgba(0, 0, 0, 1);
    line-height: 25px;
    margin-top: 29px;
  }

  .kyc-login-text {
    font-size: 14px;
    font-family: SourceSansPro-Regular, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight: 400;
    color: rgba(106, 121, 124, 1);
    line-height: 21px;
    margin-top: 24px;
    padding: 0 30px;
  }

  .kyc-login-connect {
    font-size:18px;
    font-family:SourceSansPro-Semibold, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight:600;
    color:rgba(50,164,190,1);
    line-height:23px;
    margin-top: 37px;
    padding: 0 30px;
  }

  .wanna-be-our {
    height: 128px;
    width: 100%;
    object-fit: cover;
/*     20181106 remove  */
/*     margin-bottom: 32px; */
  }

  .wanna-be-our-2 {
    width: 100%;
/*     20181106 remove  */
/*     margin-bottom: 32px; */
  }

  .wanna-be-our-txt {
    font-size: 32px;
    font-family: SourceSansPro-Semibold, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight: 600;
    color: rgba(255, 255, 255, 1);
    line-height: 40px;
    position: absolute;
/*     20181106 remove  */
/*     top: 50%; */
    top:60%;
    left: 0;
    right: 0;
    margin: -35px auto 0;
  }

  .wanna-be-our-txt > a,
  .wanna-be-our-phone > a {
    color: rgba(255, 255, 255, 1);
  }

  .wanna-be-our-phone {
    font-size: 32px;
    font-family: SourceSansPro-Semibold, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight: 600;
    color: rgba(255, 255, 255, 1);
    line-height: 40px;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    margin: 64px auto 0;
    text-align: left;
    padding: 30px;
  }

  @media only screen and (max-width: 992px) {
    .trust-margin-t {
      margin-top: 40px;
    }

    .first-bg {
      height: 820px;
    }

    .trust-anchor-desc {
      padding: 0 15px;
    }

    .second-bg {
      height: 520px;
    }

    .coverage-map {
      margin-top: 48px;
    }
  }

  /* 移动端适配 */
  @media only screen and (max-width: 414px) {
    .trust-margin-t {
      margin-top: 40px;
    }

    .first-bg {
      height: 1020px;
    }

    .icons-css {
      width: 25%;
    }

    .trust-anchor-desc {
      padding: 0 15px;
    }

    .second-bg {
      height: 520px;
    }

    .kyc-login-tit {
      margin-bottom: 50px;
    }

    .coverage-map {
      margin-top: 48px;
    }
  }

  @media only screen and (max-width: 321px) {
    .trust-margin-t {
      margin-top: 40px;
    }

    .first-bg {
      height: 1120px;
    }

    .icons-css {
      width: 25%;
    }

    .trust-anchor-desc {
      padding: 0 15px;
    }

    .second-bg {
      height: 520px;
    }

    .kyc-login-tit {
      margin-bottom: 50px;
    }

    .coverage-map {
      margin-top: 48px;
    }
  }
</style>
