webpackJsonp([24,25],{0:function(e,t,i){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}var o=i(28),a=n(o),u=i(31),r=n(u),c=i(186),d=n(c),l=i(67),f=n(l),s=i(125),E=n(s),v=i(116),N=n(v),m=i(292);r.default.use(d.default),(0,m.sync)(E.default,N.default);var p=new r.default((0,a.default)({router:N.default,store:E.default},f.default));p.$mount("#app")},33:function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});t.FILEZH="FILEZH",t.FILEEN="FILEEN",t.APPFILEZH="APPFILEZH",t.APPFILEEN="APPFILEEN",t.TEAMFILEZH="TEAMFILEZH",t.TEAMFILEEN="TEAMFILEEN",t.TECHFILEZH="TECHFILEZH",t.TECHFILEEN="TECHFILEEN",t.JOINUSFILEZH="JOINUSFILEZH",t.JOINUSFILEEN="JOINUSFILEEN",t.NEWSFILEEN="NEWSFILEEN",t.NEWSFILEZH="NEWSFILEZH",t.ARTICLE="ARTICLE",t.ONTVIEWEN="ONTVIEWEN",t.ONTVIEWZH="ONTVIEWZH",t.COOPERATIONEN="COOPERATIONEN",t.COOPERATIONZH="COOPERATIONZH",t.COOPERATIONSUBMIT="COOPERATIONSUBMIT",t.MAILVERFIRST="MAILVERFIRST",t.GETCAPTCHA="GETCAPTCHA",t.VERCAPTCHA="VERCAPTCHA",t.REGISTERINDIVIDUAL="REGISTERINDIVIDUAL",t.KYCEN="KYCEN",t.KYCZH="KYCZH",t.KYCFAQEN="KYCFAQEN",t.KYCFAQZH="KYCFAQZH",t.AUDITORLOGIN="AUDITORLOGIN",t.INDIVIDUALLIST="INDIVIDUALLIST",t.INDIVIDUALDETAIL="INDIVIDUALDETAIL",t.INDIVIDUALVERIFICATION="INDIVIDUALVERIFICATION",t.INDIVIDUALFIRST="INDIVIDUALFIRST",t.INDIVIDUALSECONDVERIFICATION="INDIVIDUALSECONDVERIFICATION",t.NOTPASSSEARCH="NOTPASSSEARCH",t.EMAILSEARCH="EMAILSEARCH",t.ROWNUMBESEARECH="ROWNUMBESEARECH"},51:function(e,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0});t.API_ROOT="https://ont.io/",t.CookieDomain=""},67:function(e,t,i){var n,o,a=i(274);o=n=n||{},"object"!=typeof n.default&&"function"!=typeof n.default||(o=n=n.default),"function"==typeof o&&(o=o.options),o.render=a.render,o.staticRenderFns=a.staticRenderFns,e.exports=n},114:function(e,t,i){"use strict";function n(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var i in e)Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t.default=e,t}Object.defineProperty(t,"__esModule",{value:!0});var o=i(115),a=n(o);t.default={getFileEN:function(){return a.FileENReource.get({})},getFileZH:function(){return a.FileZHReource.get({})},getAppFileEN:function(){return a.AppFileENReource.get({})},getAppFileZH:function(){return a.AppFileZHReource.get({})},getTeamFileEN:function(){return a.TeamFileENReource.get({})},getTeamFileZH:function(){return a.TeamFileZHReource.get({})},getTechFileEN:function(){return a.TechFileENReource.get({})},getTechFileZH:function(){return a.TechFileZHReource.get({})},getJoinUsFileEN:function(){return a.JoinUsFileENReource.get({})},getJoinUsFileZH:function(){return a.JoinUsFileZHReource.get({})},getNewsFileZH:function(){return a.NewsFileZHReource.get({})},getNewsFileEN:function(){return a.NewsFileENReource.get({})},getarticle:function(e){return a.articleReource.get({ip:e})},getontViewZH:function(){return a.ontViewZHReource.get({})},getontViewEN:function(){return a.ontViewENReource.get({})},getCooperationZH:function(){return a.CooperationZHReource.get({})},getCooperationEN:function(){return a.CooperationENReource.get({})},savecooperationsubmit:function(e,t,i,n,o){return a.cooperationsubmitReource.save({},{Name:e,ContactWay:t,Detail:o,Type:i,ContactNumber:n})},getkycZH:function(){return a.kycZHReource.get({})},getkycEN:function(){return a.kycENReource.get({})},mailverfirst:function(e,t){return a.mailverfirstReource.get({Email:e,EmailCode:t})},getcaptcha:function(e,t,i){return a.getcaptchaReource.get({phone:e,nation:t,EmailCode:i})},vercaptcha:function(e,t){return a.vercaptchaReource.get({phone:e,code:t})},registerindividual:function(e,t,i){return a.registerindividualReource.save({},{EmailCode:e,Email:t,Data:i})},getKYCFAQEN:function(){return a.KYCFAQENReource.get({})},getKYCFAQZH:function(){return a.KYCFAQZHReource.get({})},auditorlogin:function(e,t){return a.auditorloginReource.save({},{Name:e,Password:t})},individualList:function(e,t){return a.individualListReource.get({pagesize:e,pagenumber:t})},individualdetail:function(e){return a.individualdetailReource.get({id:e})},individualverification:function(e,t,i,n,o){return a.individualverificationReource.save({},{Id:e,PassFlag:t,Reason:i,Auditor:n,Password:o})},individualfirst:function(e,t,i,n){return a.individualfirstReource.save({},{PageSize:e,PageNumber:t,Auditor:i,FirstAuditor:n})},individualsecondverification:function(e,t,i,n){return a.individualsecondverificationReource.save({},{Id:e,Auditor:t,PassFlag:i,Reason:n})},notpasssearch:function(e,t,i,n){return a.notpasssearchReource.save({},{PageSize:e,PageNumber:t,Auditor:i,FirstAuditor:n})},emailsearch:function(e,t){return a.emailsearchReource.save({},{Email:e,Auditor:t})},rownumbesearch:function(e,t){return a.rownumbesearchrReource.save({},{RowNumber:e,Auditor:t})}}},115:function(e,t,i){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0}),t.rownumbesearchrReource=t.emailsearchReource=t.notpasssearchReource=t.individualsecondverificationReource=t.individualfirstReource=t.individualverificationReource=t.individualdetailReource=t.individualListReource=t.auditorloginReource=t.KYCFAQENReource=t.KYCFAQZHReource=t.registerindividualReource=t.vercaptchaReource=t.getcaptchaReource=t.mailverfirstReource=t.cooperationsubmitReource=t.ontViewZHReource=t.ontViewENReource=t.kycENReource=t.kycZHReource=t.articleReource=t.CooperationZHReource=t.CooperationENReource=t.NewsFileZHReource=t.NewsFileENReource=t.JoinUsFileZHReource=t.JoinUsFileENReource=t.TechFileZHReource=t.TechFileENReource=t.TeamFileZHReource=t.TeamFileENReource=t.AppFileZHReource=t.AppFileENReource=t.FileZHReource=t.FileENReource=void 0;var o=i(31),a=n(o),u=i(290),r=n(u),c=i(51),d=i(117);a.default.use(r.default),a.default.http.options.crossOrigin=!0,a.default.http.options.credentials=!0,a.default.http.interceptors.push(function(e,t){e.headers=e.headers||{},(0,d.getCookie)("token")&&(e.headers.Authorizatin="Bearer "+(0,d.getCookie)("token").replace(/(^\")|(\"$)/g,"")),t(function(e){401===e.status&&((0,d.signOut)(),window.location.pathname="/login")})});t.FileENReource=a.default.resource("/static/file/FileEN.json"),t.FileZHReource=a.default.resource("/static/file/FileZH.json"),t.AppFileENReource=a.default.resource("/static/file/AppFileEN.json"),t.AppFileZHReource=a.default.resource("/static/file/AppFileZH.json"),t.TeamFileENReource=a.default.resource("/static/file/TeamFileEN.json"),t.TeamFileZHReource=a.default.resource("/static/file/TeamFileZH.json"),t.TechFileENReource=a.default.resource("/static/file/TechFileEN.json"),t.TechFileZHReource=a.default.resource("/static/file/TechFileZH.json"),t.JoinUsFileENReource=a.default.resource("/static/file/JoinUsFileEN.json"),t.JoinUsFileZHReource=a.default.resource("/static/file/JoinUsFileZH.json"),t.NewsFileENReource=a.default.resource("/static/file/NewsFileEN.json"),t.NewsFileZHReource=a.default.resource("/static/file/NewsFileZH.json"),t.CooperationENReource=a.default.resource("/static/file/CooperationEN.json"),t.CooperationZHReource=a.default.resource("/static/file/CooperationZH.json"),t.articleReource=a.default.resource("/static/file/news/{/ip}.json"),t.kycZHReource=a.default.resource("/static/file/kycZH.json"),t.kycENReource=a.default.resource("/static/file/kycEN.json"),t.ontViewENReource=a.default.resource("/static/file/ontViewEN.json"),t.ontViewZHReource=a.default.resource("/static/file/ontViewZH.json"),t.cooperationsubmitReource=a.default.resource(c.API_ROOT+"api/v1/ont/enterprise"),t.mailverfirstReource=a.default.resource(c.API_ROOT+"api/v1/ont/email/verification/{Email}/{EmailCode}"),t.getcaptchaReource=a.default.resource(c.API_ROOT+"api/v1/ont/sms/verificationcode/{phone}/{nation}/{EmailCode}"),t.vercaptchaReource=a.default.resource(c.API_ROOT+"api/v1/ont/sms/phone/verification/{phone}/{code}"),t.registerindividualReource=a.default.resource(c.API_ROOT+"api/v1/ont/individual"),t.KYCFAQZHReource=a.default.resource("/static/file/KYCFAQZH.json"),t.KYCFAQENReource=a.default.resource("/static/file/KYCFAQEN.json"),t.auditorloginReource=a.default.resource(c.API_ROOT+"api/v1/ont/individual/auditor/login"),t.individualListReource=a.default.resource(c.API_ROOT+"api/v1/ont/individual/{pagesize}/{pagenumber}"),t.individualdetailReource=a.default.resource(c.API_ROOT+"api/v1/ont/individual/{id}"),t.individualverificationReource=a.default.resource(c.API_ROOT+"api/v1/ont/individual/verification"),t.individualfirstReource=a.default.resource(c.API_ROOT+"api/v1/ont/individual/first/audit"),t.individualsecondverificationReource=a.default.resource(c.API_ROOT+"api/v1/ont/individual/second/audit"),t.notpasssearchReource=a.default.resource(c.API_ROOT+"api/v1/ont/individual/notpass"),t.emailsearchReource=a.default.resource(c.API_ROOT+"api/v1/ont/individual/email"),t.rownumbesearchrReource=a.default.resource(c.API_ROOT+"api/v1/ont/individual/rownumber")},116:function(e,t,i){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var o=i(31),a=n(o),u=i(291),r=n(u);a.default.use(r.default);var c=function(e){return i.e(24,function(){return e(i(67))})},d=function(e){return i.e(0,function(){return e(i(244))})},l=function(e){return i.e(23,function(){return e(i(241))})},f=function(e){return i.e(17,function(){return e(i(263))})},s=function(e){return i.e(19,function(){return e(i(260))})},E=function(e){return i.e(21,function(){return e(i(243))})},v=function(e){return i.e(22,function(){return e(i(242))})},N=function(e){return i.e(2,function(){return e(i(262))})},m=function(e){return i.e(9,function(){return e(i(252))})},p=function(e){return i.e(8,function(){return e(i(253))})},F=function(e){return i.e(1,function(){return e(i(254))})},I=function(e){return i.e(7,function(){return e(i(255))})},R=function(e){return i.e(6,function(){return e(i(256))})},A=function(e){return i.e(5,function(){return e(i(257))})},h=function(e){return i.e(3,function(){return e(i(259))})},H=function(e){return i.e(4,function(){return e(i(258))})},C=function(e){return i.e(15,function(){return e(i(246))})},T=function(e){return i.e(13,function(){return e(i(248))})},Z=function(e){return i.e(11,function(){return e(i(250))})},g=function(e){return i.e(14,function(){return e(i(247))})},O=function(e){return i.e(12,function(){return e(i(249))})},y=function(e){return i.e(10,function(){return e(i(251))})},L=function(e){return i.e(18,function(){return e(i(261))})},P=function(e){return i.e(16,function(){return e(i(264))})},b=[{path:"/",component:c,children:[{path:"",redirect:"",component:d},{path:"/home",component:d},{path:"/kyc0/:mail/:code",component:m},{path:"/kyc0",component:m},{path:"/kyc1",component:p},{path:"/kyc2",component:F},{path:"/kyc3",component:I},{path:"/kyc4",component:R},{path:"/kyc5",component:A},{path:"/kycMustRead",component:h},{path:"/FAQ",component:H},{path:"/home/:lang",component:d},{path:"/application/:page",component:l},{path:"/technology",component:f},{path:"/news",component:s},{path:"/ontView",component:L},{path:"/viewpoint/:ip",component:P},{path:"/cooperation",component:E},{path:"/press/:ip",component:v},{path:"/team",component:N},{path:"/kycCheck0",component:C},{path:"/CheckDetail",component:T},{path:"/kycList/:pagesize/:pagenumber",component:Z},{path:"/kycCheckM",component:g},{path:"/CheckDetailM",component:O},{path:"/kycListM/:PageSize/:PageNumber",component:y}]},{path:"*",redirect:"/"}],w=new r.default({mode:"history",scrollBehavior:function(){return{y:0}},routes:b});w.beforeEach(function(e,t,i){var n,o=new RegExp("(^| )kycAuth=([^;]*)(;|$)");if(n=document.cookie.match(o))var a=unescape(n[2]);else var a=null;var u,r=new RegExp("(^| )kycphoneAuth=([^;]*)(;|$)");if(u=document.cookie.match(r)){unescape(u[2])}else;"/kyc1"==e.fullPath||"/kyc2"==e.fullPath||"/kyc3"==e.fullPath||"/kyc4"==e.fullPath||"/kyc5"==e.fullPath||"/kycMustRead"==e.fullPath?a?i():i("/kyc0"):i(),i()}),t.default=w},117:function(e,t,i){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}function o(e,t){l.default.save(e,t,s)}function a(e){return l.default.load(e)}function u(e){l.default.remove(e,s)}function r(){l.default.remove("token",s)}function c(){return!!l.default.load("token")}Object.defineProperty(t,"__esModule",{value:!0}),t.saveCookie=o,t.getCookie=a,t.removeCookie=u,t.signOut=r,t.isLogin=c;var d=i(224),l=n(d),f=i(51),s={};""!==f.CookieDomain&&(s={domain:f.CookieDomain})},118:function(e,t,i){"use strict";function n(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var i in e)Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t.default=e,t}function o(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0}),t.rownumbesearch=t.emailsearch=t.notpasssearch=t.individualsecondverification=t.individualfirst=t.individualverification=t.individualdetail=t.individualList=t.auditorlogin=t.KYCFAQZH=t.KYCFAQEN=t.kycEN=t.kycZH=t.registerindividual=t.vercaptcha=t.getcaptcha=t.mailverfirst=t.cooperationsubmit=t.CooperationEN=t.CooperationZH=t.ontViewEN=t.ontViewZH=t.article=t.NewsFileEN=t.NewsFileZH=t.JoinUsFileZH=t.JoinUsFileEN=t.TechFileZH=t.TechFileEN=t.TeamFileZH=t.TeamFileEN=t.AppFileZH=t.AppFileEN=t.FileEN=t.FileZH=t.CakeyRecord=t.NewRecord=void 0;var a=i(114),u=o(a),r=i(33),c=n(r);t.NewRecord=function(e,t){var i=e.commit;u.default.saveNewRecord(t.Action,t.Version,t.RecordData).then(function(e){var t=e.body;i(c.NEWRECORD,{data:t})})},t.CakeyRecord=function(e,t){var i=e.commit;u.default.getCakeyRecord(t.cakey).then(function(e){var t=e.body;i(c.CAKEYRECORD,{data:t})})},t.FileZH=function(e,t){var i=e.commit;u.default.getFileZH().then(function(e){var t=e.body;i(c.FILEZH,{data:t})})},t.FileEN=function(e,t){var i=e.commit;u.default.getFileEN().then(function(e){var t=e.body;i(c.FILEEN,{data:t})})},t.AppFileEN=function(e,t){var i=e.commit;u.default.getAppFileEN().then(function(e){var t=e.body;i(c.APPFILEEN,{data:t})})},t.AppFileZH=function(e,t){var i=e.commit;u.default.getAppFileZH().then(function(e){var t=e.body;i(c.APPFILEZH,{data:t})})},t.TeamFileEN=function(e,t){var i=e.commit;u.default.getTeamFileEN().then(function(e){var t=e.body;i(c.TEAMFILEEN,{data:t})})},t.TeamFileZH=function(e,t){var i=e.commit;u.default.getTeamFileZH().then(function(e){var t=e.body;i(c.TEAMFILEZH,{data:t})})},t.TechFileEN=function(e,t){var i=e.commit;u.default.getTechFileEN().then(function(e){var t=e.body;i(c.TECHFILEEN,{data:t})})},t.TechFileZH=function(e,t){var i=e.commit;u.default.getTechFileZH().then(function(e){var t=e.body;i(c.TECHFILEZH,{data:t})})},t.JoinUsFileEN=function(e,t){var i=e.commit;u.default.getJoinUsFileEN().then(function(e){var t=e.body;i(c.JOINUSFILEEN,{data:t})})},t.JoinUsFileZH=function(e,t){var i=e.commit;u.default.getJoinUsFileZH().then(function(e){var t=e.body;i(c.JOINUSFILEZH,{data:t})})},t.NewsFileZH=function(e,t){var i=e.commit;u.default.getNewsFileZH().then(function(e){var t=e.body;i(c.NEWSFILEZH,{data:t})})},t.NewsFileEN=function(e,t){var i=e.commit;u.default.getNewsFileEN().then(function(e){var t=e.body;i(c.NEWSFILEEN,{data:t})})},t.article=function(e,t){var i=e.commit;u.default.getarticle(t.ip).then(function(e){var t=e.body;i(c.ARTICLE,{data:t})})},t.ontViewZH=function(e,t){var i=e.commit;u.default.getontViewZH().then(function(e){var t=e.body;i(c.ONTVIEWZH,{data:t})})},t.ontViewEN=function(e,t){var i=e.commit;u.default.getontViewEN().then(function(e){var t=e.body;i(c.ONTVIEWEN,{data:t})})},t.CooperationZH=function(e,t){var i=e.commit;u.default.getCooperationZH().then(function(e){var t=e.body;i(c.COOPERATIONZH,{data:t})})},t.CooperationEN=function(e,t){var i=e.commit;u.default.getCooperationEN().then(function(e){var t=e.body;i(c.COOPERATIONEN,{data:t})})},t.cooperationsubmit=function(e,t){var i=e.commit;u.default.savecooperationsubmit(t.name,t.contact,t.field,t.phone,t.detail).then(function(e){var t=e.body;i(c.COOPERATIONSUBMIT,{data:t})})},t.mailverfirst=function(e,t){var i=e.commit;u.default.mailverfirst(t.Email,t.EmailCode).then(function(e){var t=e.body;document.cookie="kycAuth="+escape(t.Result),i(c.MAILVERFIRST,{data:t})})},t.getcaptcha=function(e,t){var i=e.commit;u.default.getcaptcha(t.phone,t.nation,t.EmailCode).then(function(e){var t=e.body;i(c.GETCAPTCHA,{data:t})},function(e){var t=e.body;i(c.GETCAPTCHA,{data:t})})},t.vercaptcha=function(e,t){var i=e.commit;u.default.vercaptcha(t.phone,t.code).then(function(e){var t=e.body;document.cookie="kycphoneAuth="+escape(t.Result),i(c.VERCAPTCHA,{data:t})},function(e){})},t.registerindividual=function(e,t){var i=e.commit;u.default.registerindividual(t.EmailCode,t.Email,t.Data).then(function(e){var t=e.body;i(c.REGISTERINDIVIDUAL,{data:t})})},t.kycZH=function(e,t){var i=e.commit;u.default.getkycZH().then(function(e){var t=e.body;i(c.KYCZH,{data:t})})},t.kycEN=function(e,t){var i=e.commit;u.default.getkycEN().then(function(e){var t=e.body;i(c.KYCEN,{data:t})})},t.KYCFAQEN=function(e,t){var i=e.commit;u.default.getKYCFAQEN().then(function(e){var t=e.body;i(c.KYCFAQEN,{data:t})})},t.KYCFAQZH=function(e,t){var i=e.commit;u.default.getKYCFAQZH().then(function(e){var t=e.body;i(c.KYCFAQZH,{data:t})})},t.auditorlogin=function(e,t){var i=e.commit;u.default.auditorlogin(t.Name,t.Password).then(function(e){var t=e.body;document.cookie="kycCheckAuth="+escape(t.Result),i(c.AUDITORLOGIN,{data:t})})},t.individualList=function(e,t){var i=e.commit;u.default.individualList(t.pagesize,t.pagenumber).then(function(e){var t=e.body;i(c.INDIVIDUALLIST,{data:t})})},t.individualdetail=function(e,t){var i=e.commit;u.default.individualdetail(t.id).then(function(e){var t=e.body;i(c.INDIVIDUALDETAIL,{data:t})})},t.individualverification=function(e,t){var i=e.commit;u.default.individualverification(t.Id,t.PassFlag,t.Reason,t.Auditor,t.Password).then(function(e){var t=e.body;i(c.INDIVIDUALVERIFICATION,{data:t})})},t.individualfirst=function(e,t){var i=e.commit;u.default.individualfirst(t.PageSize,t.PageNumber,t.Auditor,t.FirstAuditor).then(function(e){var t=e.body;i(c.INDIVIDUALFIRST,{data:t})})},t.individualsecondverification=function(e,t){var i=e.commit;u.default.individualsecondverification(t.Id,t.Auditor,t.PassFlag,t.Reason).then(function(e){var t=e.body;i(c.INDIVIDUALSECONDVERIFICATION,{data:t})})},t.notpasssearch=function(e,t){var i=e.commit;u.default.notpasssearch(t.PageSize,t.PageNumber,t.Auditor,t.FirstAuditor).then(function(e){var t=e.body;i(c.NOTPASSSEARCH,{data:t})})},t.emailsearch=function(e,t){var i=e.commit;u.default.emailsearch(t.Email,t.Auditor).then(function(e){var t=e.body;i(c.EMAILSEARCH,{data:t})})},t.rownumbesearch=function(e,t){var i=e.commit;u.default.rownumbesearch(t.RowNumber,t.Auditor).then(function(e){var t=e.body;i(c.ROWNUMBESEARECH,{data:t})})}},119:function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});t.FileZH=function(e){return e.main.FileZH},t.FileEN=function(e){return e.main.FileEN},t.AppFileZH=function(e){return e.main.AppFileZH},t.AppFileEN=function(e){return e.main.AppFileEN},t.TeamFileEN=function(e){return e.main.TeamFileEN},t.TeamFileZH=function(e){return e.main.TeamFileZH},t.TechFileEN=function(e){return e.main.TechFileEN},t.TechFileZH=function(e){return e.main.TechFileZH},t.JoinUsFileZH=function(e){return e.main.JoinUsFileZH},t.JoinUsFileEN=function(e){return e.main.JoinUsFileEN},t.NewsFileEN=function(e){return e.main.NewsFileEN},t.NewsFileZH=function(e){return e.main.NewsFileZH},t.article=function(e){return e.main.article},t.ontViewZH=function(e){return e.main.ontViewZH},t.ontViewEN=function(e){return e.main.ontViewEN},t.CooperationEN=function(e){return e.main.CooperationEN},t.CooperationZH=function(e){return e.main.CooperationZH},t.cooperationsubmit=function(e){return e.main.cooperationsubmit},t.mailverfirst=function(e){return e.main.mailverfirst},t.getcaptcha=function(e){return e.main.getcaptcha},t.vercaptcha=function(e){return e.main.vercaptcha},t.registerindividual=function(e){return e.main.registerindividual},t.kycEN=function(e){return e.main.kycEN},t.kycZH=function(e){return e.main.kycZH},t.KYCFAQEN=function(e){return e.main.KYCFAQEN},t.KYCFAQZH=function(e){return e.main.KYCFAQZH},t.auditorlogin=function(e){return e.main.auditorlogin},t.individualList=function(e){return e.main.individualList},t.individualdetail=function(e){return e.main.individualdetail},t.individualverification=function(e){return e.main.individualverification},t.individualfirst=function(e){return e.main.individualfirst},t.individualsecondverification=function(e){return e.main.individualsecondverification},t.notpasssearch=function(e){return e.main.notpasssearch},t.emailsearch=function(e){return e.main.emailsearch},t.rownumbesearch=function(e){return e.main.rownumbesearch}},120:function(e,t,i){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var o=i(10),a=n(o),u=i(33),r={degreeInfo:[]},c=(0,a.default)({},u.DEGREEINFO,function(e,t){var i=t.data;e.degreeInfo=i});t.default={state:r,mutations:c}},121:function(e,t,i){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var o=i(10),a=n(o),u=i(33),r={degreeLog:[]},c=(0,a.default)({},u.GEGREELOG,function(e,t){var i=t.data;e.degreeLog=i});t.default={state:r,mutations:c}},122:function(e,t,i){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var o=i(10),a=n(o),u=i(33),r={tradeData:[]},c=(0,a.default)({},u.HOME,function(e,t){var i=t.data;e.tradeData=i});t.default={state:r,mutations:c}},123:function(e,t,i){"use strict";function n(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var i in e)Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t.default=e,t}function o(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var a,u=i(10),r=o(u),c=i(33),d=n(c),l={FileEN:[],FileZH:[],AppFileZH:[],AppFileEN:[],TeamFileZH:[],TeamFileEN:[],TechFileZH:[],TechFileEN:[],JoinUsFileEN:[],JoinUsFileZH:[],NewsFileEN:[],NewsFileZH:[],ontViewEN:[],ontViewZH:[],CooperationEN:[],CooperationZH:[],article:[],cooperationsubmit:[],kycEN:[],kycZH:[],KYCFAQEN:[],KYCFAQZH:[],mailverfirst:[],getcaptcha:[],vercaptcha:[],registerindividual:[],auditorlogin:[],individualList:[],individualdetail:[],individualverification:[],individualfirst:[],individualsecondverification:[],notpasssearch:[],emailsearch:[],rownumbesearch:[]},f=(a={},(0,r.default)(a,d.FILEZH,function(e,t){var i=t.data;e.FileZH=i}),(0,r.default)(a,d.FILEEN,function(e,t){var i=t.data;e.FileEN=i}),(0,r.default)(a,d.APPFILEZH,function(e,t){var i=t.data;e.AppFileZH=i}),(0,r.default)(a,d.APPFILEEN,function(e,t){var i=t.data;e.AppFileEN=i}),(0,r.default)(a,d.TEAMFILEZH,function(e,t){var i=t.data;e.TeamFileZH=i}),(0,r.default)(a,d.TEAMFILEEN,function(e,t){var i=t.data;e.TeamFileEN=i}),(0,r.default)(a,d.TECHFILEZH,function(e,t){var i=t.data;e.TechFileZH=i}),(0,r.default)(a,d.TECHFILEEN,function(e,t){var i=t.data;e.TechFileEN=i}),(0,r.default)(a,d.JOINUSFILEZH,function(e,t){var i=t.data;e.JoinUsFileZH=i}),(0,r.default)(a,d.JOINUSFILEEN,function(e,t){var i=t.data;e.JoinUsFileEN=i}),(0,r.default)(a,d.NEWSFILEEN,function(e,t){var i=t.data;e.NewsFileEN=i}),(0,r.default)(a,d.NEWSFILEZH,function(e,t){var i=t.data;e.NewsFileZH=i}),(0,r.default)(a,d.ARTICLE,function(e,t){var i=t.data;e.article=i}),(0,r.default)(a,d.ONTVIEWEN,function(e,t){var i=t.data;e.ontViewEN=i}),(0,r.default)(a,d.ONTVIEWZH,function(e,t){var i=t.data;e.ontViewZH=i}),(0,r.default)(a,d.COOPERATIONEN,function(e,t){var i=t.data;e.CooperationEN=i}),(0,r.default)(a,d.COOPERATIONZH,function(e,t){var i=t.data;e.CooperationZH=i}),(0,r.default)(a,d.COOPERATIONSUBMIT,function(e,t){var i=t.data;e.cooperationsubmit=i}),(0,r.default)(a,d.KYCEN,function(e,t){var i=t.data;e.kycEN=i}),(0,r.default)(a,d.KYCZH,function(e,t){var i=t.data;e.kycZH=i}),(0,r.default)(a,d.MAILVERFIRST,function(e,t){var i=t.data;e.mailverfirst=i}),(0,r.default)(a,d.GETCAPTCHA,function(e,t){var i=t.data;e.getcaptcha=i}),(0,r.default)(a,d.VERCAPTCHA,function(e,t){var i=t.data;e.vercaptcha=i}),(0,r.default)(a,d.REGISTERINDIVIDUAL,function(e,t){var i=t.data;e.registerindividual=i}),(0,r.default)(a,d.KYCFAQEN,function(e,t){var i=t.data;e.KYCFAQEN=i}),(0,r.default)(a,d.KYCFAQZH,function(e,t){var i=t.data;e.KYCFAQZH=i}),(0,r.default)(a,d.AUDITORLOGIN,function(e,t){var i=t.data;e.auditorlogin=i}),(0,r.default)(a,d.INDIVIDUALLIST,function(e,t){var i=t.data;e.individualList=i}),(0,r.default)(a,d.INDIVIDUALDETAIL,function(e,t){var i=t.data;e.individualdetail=i}),(0,r.default)(a,d.INDIVIDUALVERIFICATION,function(e,t){var i=t.data;e.individualverification=i}),(0,r.default)(a,d.INDIVIDUALFIRST,function(e,t){var i=t.data;e.individualfirst=i}),(0,r.default)(a,d.INDIVIDUALSECONDVERIFICATION,function(e,t){var i=t.data;e.individualsecondverification=i}),(0,r.default)(a,d.NOTPASSSEARCH,function(e,t){var i=t.data;e.notpasssearch=i}),(0,r.default)(a,d.EMAILSEARCH,function(e,t){var i=t.data;e.emailsearch=i}),(0,r.default)(a,d.ROWNUMBESEARECH,function(e,t){var i=t.data;e.rownumbesearch=i}),a);t.default={state:l,mutations:f}},124:function(e,t,i){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var o=i(10),a=n(o),u=i(33),r={test:[]},c=(0,a.default)({},u.TEST,function(e,t){var i=t.data;e.test=i});t.default={state:r,mutations:c}},125:function(e,t,i){"use strict";function n(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var i in e)Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t.default=e,t}function o(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var a=i(31),u=o(a),r=i(4),c=o(r),d=i(118),l=n(d),f=i(119),s=n(f),E=i(124),v=o(E),N=i(122),m=o(N),p=i(123),F=o(p),I=i(120),R=o(I),A=i(121),h=o(A),H=!1;u.default.use(c.default),u.default.config.debug=H,t.default=new c.default.Store({modules:{test:v.default,home:m.default,main:F.default,degreeCz:R.default,degreeCzLog:h.default},actions:l,getters:s})},274:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("transition",{attrs:{name:"router-fade",mode:"out-in"}},[i("router-view")],1)},staticRenderFns:[]}},293:function(e,t){}});