<template>
  <div id="browser" style="z-index: 1;background-repeat: no-repeat;background-size: 100%;background:rgba(233,237,239,1);">
    <Top></Top>

    <div class="trust-margin-t-2">
      <div class="container" style="max-width: 1200px;">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="return-home-css" @click="goBack">&#8592 Back</p>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class=" text-center list-title-css">Trust Anchor Coverage</p>
          </div>
        </div>

        <div class="row">
          <div class="" style="width: 100%; margin:0 auto;">
            <ul class="nav nav-pills btn-country">
              <li><a :class="clicked[0] ? 'clicked-li-a' : ''" @click="reloadData(0)">All</a></li>
              <li><a v-on:submit.prevent style="color: #BABDBF;">|</a></li>
              <li><a :class="clicked[1] ? 'clicked-li-a' : ''" @click="reloadData(1)">Africa</a></li>
              <li><a v-on:submit.prevent style="color: #BABDBF;">|</a></li>
              <li><a :class="clicked[2] ? 'clicked-li-a' : ''" @click="reloadData(2)">Asia</a></li>
              <li><a v-on:submit.prevent style="color: #BABDBF;">|</a></li>
              <li><a :class="clicked[3] ? 'clicked-li-a' : ''" @click="reloadData(3)">Europe</a></li>
              <li><a v-on:submit.prevent style="color: #BABDBF;">|</a></li>
              <li><a :class="clicked[4] ? 'clicked-li-a' : ''" @click="reloadData(4)">North America</a></li>
              <li><a v-on:submit.prevent style="color: #BABDBF;">|</a></li>
              <li><a :class="clicked[5] ? 'clicked-li-a' : ''" @click="reloadData(5)">Central America</a></li>
              <li><a v-on:submit.prevent style="color: #BABDBF;">|</a></li>
              <li><a :class="clicked[6] ? 'clicked-li-a' : ''" @click="reloadData(6)">South America</a></li>
              <li><a v-on:submit.prevent style="color: #BABDBF;">|</a></li>
              <li><a :class="clicked[7] ? 'clicked-li-a' : ''" @click="reloadData(7)">Oceania</a></li>
            </ul>
          </div>
        </div>

        <div class="row ">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th class="trust-anchor-th" scope="col">Country</th>
                  <th class="trust-anchor-th" scope="col">Driver's License</th>
                  <th class="trust-anchor-th" scope="col">Identity Card</th>
                  <th class="trust-anchor-th" scope="col">Passport</th>
                  <th class="trust-anchor-th" scope="col">Residence Permit</th>
                  <th class="trust-anchor-th" scope="col">Travel Document</th>
                  <th class="trust-anchor-th" scope="col">Visa</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="country in viewData">
                  <td class="trust-anchor-td" @click="">{{country[0]}}</td>
                  <td class="trust-anchor-td" :class="[country[1]=== false?'trust-anchor-td-false':'']">
                    <img v-show="country[1]" src="./../assets/images/trust-anchor/check_mark@2x.png" alt="">
                  </td>
                  <td class="trust-anchor-td" :class="[country[2]=== false?'trust-anchor-td-false':'']">
                    <img v-show="country[2]" src="./../assets/images/trust-anchor/check_mark@2x.png" alt="">
                  </td>
                  <td class="trust-anchor-td" :class="[country[3]=== false?'trust-anchor-td-false':'']">
                    <img v-show="country[3]" src="./../assets/images/trust-anchor/check_mark@2x.png" alt="">
                  </td>
                  <td class="trust-anchor-td" :class="[country[4]=== false?'trust-anchor-td-false':'']">
                    <img v-show="country[4]" src="./../assets/images/trust-anchor/check_mark@2x.png" alt="">
                  </td>
                  <td class="trust-anchor-td" :class="[country[5]=== false?'trust-anchor-td-false':'']">
                    <img v-show="country[5]" src="./../assets/images/trust-anchor/check_mark@2x.png" alt="">
                  </td>
                  <td class="trust-anchor-td" :class="[country[6]=== false?'trust-anchor-td-false':'']">
                    <img v-show="country[6]" src="./../assets/images/trust-anchor/check_mark@2x.png" alt="">
                  </td>
                </tr>
                </tbody>
              </table>
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
    <div class="hidden-lg hidden-md hidden-sm" style="position: relative; width: 100%; text-align: center; margin-top: 20px">
      <img class="wanna-be-our" src="./../assets/images/trust-anchor/bg_banner_trust_anchor@2x-mobile.png" alt="">
      <div class="wanna-be-our-phone">
        <a :href="ontEmail">
          <p>Wanna be our</p>
          <p>Trust Anchor?</p>
          <p>Talk to us.</p>
        </a>
      </div>
    </div>

    <Bottom></Bottom>
  </div>
</template>

<script>
  import Top from './head.vue'
  import Bottom from './bottom.vue'

	export default {
    name: "TrustAnchorCoverage",
    created() {
      this.initData()
    },
    data() {
      return {
        clicked: [true, false, false, false, false, false, false, false],
        viewData: [],
        ontEmail: 'mailto:' + 'contact@ont.io',
        allData: {
          africa: [
            ['Algeria', true, true, true, true, false, false],
            ['Angola', true, true, true, true, false, false],
            ['Benin', true, true, true, true, false, false],
            ['Botswana', true, true, true, true, false, false],
            ['Burkina Faso', true, true, true, true, false, false],
            ['Burundi', true, true, true, false, false, false],
            ['Cameroon', true, true, true, true, false, false],
            ['Cape Verde', true, true, true, false, false, false],
            ['Central African Rep.', false, false, false, false, false, false],
            ['Chad', true, true, true, false, false, false],
            ['Congo', true, true, true, false, false, false],
            ['Cote D\'ivoire', false, true, true, false, false, false],
            ['Djibouti', true, true, true, false, false, false],
            ['Egypt', true, true, true, false, true, false],
            ['Equatorial Guinea', true, true, true, true, false, false],
            ['Eritrea', true, true, true, false, false, false],
            ['Ethiopia', false, true, true, true, true, false],
            ['Gabon', true, false, true, true, false, false],
            ['Gambia', true, true, true, false, false, false],
            ['Ghana', true, true, true, true, false, false],
            ['Guinea', false, true, true, false, false, false],
            ['Kenya', true, true, true, true, false, false],
            ['Lesotho', true, true, true, false, false, false],
            ['Liberia', true, true, true, false, false, false],
            ['Libya', false, true, true, false, false, false],
            ['Madagascar', true, true, true, true, false, false],
            ['Malawi', true, true, true, false, false, false],
            ['Mali', true, true, true, false, false, false],
            ['Mauritania', false, true, true, true, false, false],
            ['Mauritius', true, true, true, false, false, false],
            ['Mayotte', false, false, true, false, false, false],
            ['Morocco', true, true, true, true, false, false],
            ['Mozambique', true, true, true, true, false, false],
            ['Namibia', true, true, true, false, false, false],
            ['Niger', false, false, true, false, false, false],
            ['Nigeria', true, true, true, true, false, false],
            ['Reunion', true, true, true, false, false, false],
            ['Rwanda', true, true, true, true, false, false],
            ['Sao Tome and Principe', false, false, true, false, false, false],
            ['Senegal', true, true, true, false, false, false],
            ['Seychelles', true, true, true, false, false, false],
            ['Sierra Leone', true, true, true, false, false, false],
            ['Somalia', true, true, true, true, true, false],
            ['South Affrica', false, true, true, false, true, false],
            ['South Sudan', false, true, true, false, false, false],
            ['Sudan', true, true, true, false, false, false],
            ['Swaziland', true, true, true, false, false, false],
            ['Tanzania', true, true, true, true, false, false],
            ['Togo', true, true, true, true, false, false],
            ['Tunisia', true, true, true, true, false, false],
            ['Uganda', true, true, true, true, false, false],
            ['Western Sahara', false, false, true, false, false, false],
            ['Zambia', true, true, true, false, false, false],
            ['Zimbabwe', true, true, true, true, false, false]
          ],
          asia: [
            ['Afghanistan', false, true, true, true, false, false],
            ['Armenia', true, true, true, true, false, false],
            ['Azerbaijan', true, true, true, true, false, false],
            ['Bahrain', true, true, true, true, false, false],
            ['Bangladesh', true, true, true, true, false, false],
            ['Bhutan', true, true, true, true, true, false],
            ['Brunei', false, false, true, false, false, false],
            ['Cambodia', true, true, true, true, false, false],
            ['China', true, true, true, true, true, true],
            ['East Timor', true, true, true, true, false, false],
            ['Georgia', true, true, true, true, true, false],
            ['Hong Kong', true, true, true, true, false, false],
            ['India', true, false, true, true, false, true],
            ['Indonesia', true, true, true, true, false, true],
            ['Iran', true, true, true, true, false, false],
            ['Iraq', true, true, true, true, false, false],
            ['Israel', true, true, true, true, true, false],
            ['Japan', false, false, true, true, true, false],
            ['Jordan', true, true, true, true, false, false],
            ['Kazakhstan', true, true, true, true, false, true],
            ['Kuwait', true, true, true, true, false, false],
            ['Kyrgyzstan', true, true, true, false, false, false],
            ['Laos', true, false, true, false, false, false],
            ['Lebanon', true, true, true, false, false, false],
            ['Macau', false, false, false, false, false, false],
            ['Malaysia', true, true, true, true, false, false],
            ['Maldives', true, true, true, true, false, false],
            ['Mongolia', true, true, true, true, false, false],
            ['Myanmar', true, false, true, true, false, false],
            ['Nepal', true, true, true, false, true, false],
            ['North Korea', false, false, true, false, false, false],
            ['Oman', true, true, true, true, false, false],
            ['Pakistan', true, true, true, true, false, false],
            ['Palestine', true, true, true, false, false, false],
            ['Philippines', true, true, true, true, false, false],
            ['Qatar', true, true, true, true, false, false],
            ['Russia', true, true, true, true, false, true],
            ['Saudi Arabia', true, true, true, false, false, false],
            ['Singapore', true, true, true, true, true, false],
            ['Sri Lanka', true, true, true, true, false, false],
            ['Syria', true, true, true, false, false, false],
            ['Taiwan', false, false, true, true, true, false],
            ['Tajikistan', true, false, true, true, false, false],
            ['Thailand', true, true, true, true, false, true],
            ['Turkmenistan', true, true, true, false, false, false],
            ['United Arab Emirates', true, true, true, true, false, false],
            ['Uzbekistan', true, true, true, false, false, false],
            ['Vietnam', true, true, true, true, false, false],
            ['Yemen', true, false, true, false, false, false]
          ],
          europe: [
            ['Aland Islands', false, false, true, false, false, false],
            ['Albania', true, true, true, true, false, false],
            ['Andorra', true, true, true, true, false, false],
            ['Austria', true, true, true, true, true, false],
            ['Belarus', true, true, true, true, false, false],
            ['Belgium', true, true, true, true, true, true],
            ['Bosnia and Herzegovina', true, true, true, true, false, false],
            ['Bulgaria', true, true, true, true, true, false],
            ['Croatia', true, true, true, true, true, false],
            ['Cyprus', true, true, true, true, false, false],
            ['Czech Republic', true, true, true, true, false, false],
            ['Denmark', true, true, true, true, true, true],
            ['Estonia', true, true, true, true, true, false],
            ['Faroe Islands', true, true, true, false, false, false],
            ['Finland', true, true, true, true, true, true],
            ['France', true, true, true, true, true, true],
            ['Germany', true, true, true, true, true, true],
            ['Gibraltar', true, true, true, true, false, false],
            ['Greece', true, true, true, true, false, true],
            ['Hungary', true, true, true, true, false, false],
            ['Iceland', true, true, true, true, true, true],
            ['Ireland', true, true, true, true, true, true],
            ['Italy', true, true, true, true, false, true],
            ['Jersey Islands', false, false, false, false, false, false],
            ['Kosovo', true, true, true, true, true, false],
            ['Latvia', true, true, true, true, true, true],
            ['Liechtenstein', true, true, true, true, true, false],
            ['Lithuania', true, true, true, true, false, false],
            ['Luxembourg', true, true, true, true, true, true],
            ['Macedonia', true, true, true, true, false, false],
            ['Malta', true, true, true, true, true, false],
            ['Moldova', true, true, true, true, false, false],
            ['Monaco', true, true, true, true, true, false],
            ['Montenegro', true, true, true, true, false, false],
            ['Netherlands', true, true, true, true, true, true],
            ['Netherlands Antilles', false, false, true, false, false, false],
            ['Norway', true, true, true, true, true, true],
            ['Poland', true, true, true, true, true, false],
            ['Portugal', true, true, true, true, false, true],
            ['Romania', true, true, true, true, false, false],
            ['Saint Martin', false, false, false, false, false, false],
            ['San Marino', true, true, true, true, false, false],
            ['Serbia', true, true, true, false, false, false],
            ['Slovakia', true, true, true, true, true, false],
            ['Slovenia', true, true, true, true, false, false],
            ['Spain', true, true, true, true, false, true],
            ['Sweden', true, true, true, true, true, true],
            ['Switzerland', true, true, true, true, true, true],
            ['Turkey', true, true, true, true, false, false],
            ['Ukraine', true, true, true, true, false, false],
            ['United Kingdom', true, true, true, true, true, true],
            ['Vatican City', false, false, true, false, false, false]
          ],
          northAmerica: [
            ['Canada', true, true, true, true, true, false],
            ['Mexico', true, true, true, true, false, true],
            ['United States', false, true, true, false, true, true]
          ],
          centralAmerica: [
            ['Antigua and Barbuda', true, true, true, false, false, false],
            ['Bahamas', true, true, true, true, false, false],
            ['Barbados', true, true, true, false, false, false],
            ['Belize', true, true, true, false, false, false],
            ['Bermuda', true, true, true, true, false, false],
            ['Cayman Islands', true, true, true, false, false, false],
            ['Costa Rica', true, true, true, true, false, false],
            ['Cuba', true, true, true, true, false, false],
            ['Dominica', true, true, true, false, false, false],
            ['Dominican Rep.', false, false, false, false, false, false],
            ['El Salvador', true, true, true, true, false, false],
            ['Grenada', true, true, true, false, false, false],
            ['Guadeloupe', false, true, true, false, false, false],
            ['Guatemala', true, true, true, true, false, false],
            ['Haiti', true, true, true, true, false, false],
            ['Honduras', true, true, true, true, false, false],
            ['Jamaica', true, true, true, false, false, false],
            ['Martinique', true, true, true, false, false, false],
            ['Montserrat', false, false, true, false, false, false],
            ['Nicaragua', true, true, true, true, false, false],
            ['Panama', true, true, true, true, false, false],
            ['Puerto Rico', true, true, true, true, false, false],
            ['St. Kitts and Nevis', false, false, true, false, false, false],
            ['Saint Lucia', true, true, true, false, false, false],
            ['St. Pierre/ Miquelon', false, false, false, false, false, false],
            ['St. Vincent/Grenadines', false, false, false, false, false, false],
            ['Trinidad and Tobago', true, true, true, true, false, false],
            ['Turks and Caicos', false, false, true, false, false, false],
            ['British Virgin Islands', true, true, true, false, false, false]
          ],
          southAmerica: [
            ['Argentina', true, true, true, true, false, false],
            ['Aruba', true, true, true, false, false, false],
            ['Bolivia', true, true, true, false, false, false],
            ['Bonaire St. Eustatius & Saba', false, true, false, false, false, false],
            ['Brazil', true, true, true, true, false, true],
            ['Chile', true, true, true, true, false, false],
            ['Colobia', false, false, true, false, false, false],
            ['Ecuador', true, true, true, true, false, false],
            ['French Guiana', true, true, true, false, false, false],
            ['Guyana', true, true, true, false, false, false],
            ['Paraguay', true, true, true, true, false, false],
            ['Peru', true, true, true, true, false, false],
            ['Suriname', true, true, true, true, false, true],
            ['Venezuela', true, true, true, true, false, false]
          ],
          oceania: [
            ['Australia', true, true, true, true, false, false],
            ['Cook Islands', true, true, true, true, false, false],
            ['Federated States of Micronesia', false, false, false, false, false, false],
            ['Fiji', true, true, true, false, false, false],
            ['Kiribati', true, false, true, false, false, false],
            ['Marshall Islands', false, false, true, false, false, false],
            ['Nauru', false, false, true, false, false, false],
            ['New Zealand', true, true, true, true, true, true],
            ['Norfolk Island', false, false, true, false, false, false],
            ['Palau', true, false, true, false, false, false],
            ['Papua New Guinea', true, true, true, false, false, false],
            ['Samoa', true, true, true, false, false, false],
            ['Solomon Islands', false, true, true, false, false, false],
            ['Tonga', true, true, true, false, false, false],
            ['Tuvalu', false, true, true, false, false, false],
            ['Vanuatu', true, true, true, false, false, false]
          ]
        }
      }
    },
    methods: {
      initData() {
        this.viewData = this.viewData.concat(this.allData.africa)
        this.viewData = this.viewData.concat(this.allData.asia)
        this.viewData = this.viewData.concat(this.allData.europe)
        this.viewData = this.viewData.concat(this.allData.northAmerica)
        this.viewData = this.viewData.concat(this.allData.centralAmerica)
        this.viewData = this.viewData.concat(this.allData.southAmerica)
        this.viewData = this.viewData.concat(this.allData.oceania)
      },
      goBack() {
        this.$router.push({'path': '/trust-anchor/en'})
      },
      reloadData(tableIndex) {
        // 切换table name
        for (let i = 0; i < 8; i++) {
          if (tableIndex === i) {
            this.$set(this.clicked, i, true)
          } else {
            this.$set(this.clicked, i, false)
          }
        }

        // 更新table data
        switch (tableIndex) {
          case 1:
            this.viewData = this.allData.africa;
            break;
          case 2:
            this.viewData = this.allData.asia;
            break;
          case 3:
            this.viewData = this.allData.europe;
            break;
          case 4:
            this.viewData = this.allData.northAmerica;
            break;
          case 5:
            this.viewData = this.allData.centralAmerica;
            break;
          case 6:
            this.viewData = this.allData.southAmerica;
            break;
          case 7:
            this.viewData = this.allData.oceania;
            break;
          default:
            this.initData();
            break;
        }
      }
    },
    components: {Top, Bottom}
  }
</script>

<style scoped>
  .trust-margin-t-2 {
    margin: 50px 0;
  }

  .return-home-css {
    font-size:18px;
    font-family:SourceSansPro-Semibold, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight:600;
    color:rgba(43,64,69,1);
    line-height:23px;
    cursor: pointer;
    margin: 25px 0;
  }
  .return-home-css:hover {
    text-decoration: underline;
    opacity: 0.6;
  }

  .list-title-css {
    font-size:40px;
    font-family:SourceSansPro-Light, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight:300;
    color:rgba(0,0,0,1);
    line-height:50px;
    margin-bottom: 32px;
  }

  .wanna-be-our {
    width: 100%;
    margin-bottom: 32px;
  }

  .wanna-be-our-txt {
    font-size: 32px;
    font-family: SourceSansPro-Semibold, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight: 600;
    color: rgba(255, 255, 255, 1);
    line-height: 40px;
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    margin: -30px auto 0;
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

  .btn-country {
    font-size:18px;
    font-family:SourceSansPro-Semibold, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    color:rgba(43,64,69,1);
    line-height:23px;
    margin-bottom: 30px;
    padding: 0 10px;
  }

  .btn-country > li > a {
    color:rgba(43,64,69,1);
  }

  .btn-country > li > a:hover,
  .wanna-be-our-txt > a:hover,
  .wanna-be-our-phone > a:hover {
    text-decoration: underline;
    opacity: 0.6;
  }

  .clicked-li-a {
    font-weight:600;
    color:rgba(50,164,190,1) !important;
  }

  .trust-anchor-th {
    background:rgba(50,164,190,1);
    font-size:16px;
    font-family:SourceSansPro-Semibold, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight:600;
    color:rgba(255,255,255,1);
    line-height:32px;
    text-align: center;
    border: 2px solid rgba(233,237,239,1);
  }

  .trust-anchor-td {
    background: white;
    font-size: 16px;
    font-family: SourceSansPro-Semibold, 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;
    font-weight: 600;
    color: rgba(43, 64, 69, 1);
    line-height: 32px;
    text-align: center;
    border: 2px solid rgba(233,237,239,1);
  }

  .trust-anchor-td > img {
    width: 25px;
  }

  .trust-anchor-td-false {
    background:rgba(187,213,221,1);
  }

  /* 移动端适配 */
  @media only screen and (max-width: 414px) {
    .trust-margin-t-2 {
      margin: 40px 0;
    }

    .btn-country {
      font-size:16px;
      line-height:12px;
    }

    .trust-anchor-th {
      font-size: 12px;
      line-height: 24px;
    }

    .trust-anchor-td {
      font-size: 12px;
      line-height: 18px;
    }
  }
</style>
