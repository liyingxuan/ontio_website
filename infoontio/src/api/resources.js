import Vue from 'vue'
import VueResource from 'vue-resource'
import {API_ROOT} from '../config'
import { getCookie,signOut } from '../util/authService'

Vue.use(VueResource)

Vue.http.options.crossOrigin = true
Vue.http.options.credentials = true

Vue.http.interceptors.push((request, next) => {
  request.headers = request.headers || {}
  if(getCookie("token")) {
    request.headers.Authorizatin = 'Bearer ' + getCookie('token').replace(/(^\")|(\"$)/g, '')
  }
  next((response) => {
    if(response.status === 401) {
      signOut()
      window.location.pathname = '/login'
    }
  })
})

//for cunzheng browser
export const FileENReource = Vue.resource('/static/file/FileEN.json')
export const FileZHReource = Vue.resource('/static/file/FileZH.json')
export const AppFileENReource = Vue.resource('/static/file/AppFileEN.json')
export const AppFileZHReource = Vue.resource('/static/file/AppFileZH.json')
export const TeamFileENReource = Vue.resource('/static/file/TeamFileEN.json')
export const TeamFileKOReource = Vue.resource('/static/file/TeamFileKO.json')
export const TeamFileZHReource = Vue.resource('/static/file/TeamFileZH.json')
export const TechFileENReource = Vue.resource('/static/file/TechFileEN.json')
export const TechFileZHReource = Vue.resource('/static/file/TechFileZH.json')
export const JoinUsFileENReource = Vue.resource('/static/file/JoinUsFileEN.json')
export const JoinUsFileZHReource = Vue.resource('/static/file/JoinUsFileZH.json')
export const NewsFileENReource = Vue.resource('/static/file/NewsFileEN.json')
export const NewsFileZHReource = Vue.resource('/static/file/NewsFileZH.json')
export const CooperationENReource = Vue.resource('/static/file/CooperationEN.json')
export const CooperationZHReource = Vue.resource('/static/file/CooperationZH.json')
export const CooperationKOReource = Vue.resource('/static/file/CooperationKO.json')
export const articleReource = Vue.resource('/static/file/news/{/ip}.json')
export const TrionesZHReource = Vue.resource('/static/file/TrionesZH.json')
export const TrionesENReource = Vue.resource('/static/file/TrionesEN.json')
export const TrionesListZHReource = Vue.resource('/static/file/TrionesListZH.json')
export const TrionesListENReource = Vue.resource('/static/file/TrionesListEN.json')
export const trioneslistReource  = Vue.resource(API_ROOT+'api/v1/candidate/info/{region}')
export const ontViewENReource = Vue.resource('/static/file/ontViewEN.json')
export const ontViewZHReource = Vue.resource('/static/file/ontViewZH.json')

/* export const SubscribeReource = Vue.resource(API_ROOT+'api/v1/ont/email/subscriber') */
/* export const SubscribeReource = Vue.resource('api/v1/ont/email/subscriber') */
export const cooperationsubmitReource = Vue.resource(API_ROOT+'api/v1/ont/enterprise')
/* kyc */
/* 邮箱首次验证 */
export const mailverfirstReource = Vue.resource(API_ROOT+'api/v1/ont/email/verification/{Email}/{EmailCode}')
/* 手机获取短信验证码 */
export const getcaptchaReource = Vue.resource(API_ROOT+'api/v1/ont/sms/verificationcode/{phone}/{nation}/{EmailCode}')
/* 短信验证码验证 */
export const vercaptchaReource = Vue.resource(API_ROOT+'api/v1/ont/sms/phone/verification/{phone}/{code}')
/* 注册个人信息 */
export const registerindividualReource = Vue.resource(API_ROOT+'api/v1/ont/individual')
/* kycfaq zh */
export const KYCFAQZHReource = Vue.resource('/static/file/KYCFAQZH.json')
/* kycfaq en */
export const KYCFAQENReource = Vue.resource('/static/file/KYCFAQEN.json')

/* kycCheck */
/* 审计员登录 */
export const auditorloginReource = Vue.resource(API_ROOT+'api/v1/ont/individual/auditor/login')
/* 分页查询个人简略信息 */
export const individualListReource = Vue.resource(API_ROOT+'api/v1/ont/individual/{pagesize}/{pagenumber}')
/* 根据id查询个人照片 */
export const individualdetailReource = Vue.resource(API_ROOT+'api/v1/ont/individual/{id}')
/* 审核信息 */
export const individualverificationReource = Vue.resource(API_ROOT+'api/v1/ont/individual/verification')
/* 查询已初次审核信息 */
export const individualfirstReource = Vue.resource(API_ROOT+'api/v1/ont/individual/first/audit')  
/* 最终审核 */
export const individualsecondverificationReource = Vue.resource(API_ROOT+'api/v1/ont/individual/second/audit')
/* 管理员查询未审核通过的记录 */
export const notpasssearchReource = Vue.resource(API_ROOT+'api/v1/ont/individual/notpass')  
/* 管理员根据邮箱查询审核信息 */
export const emailsearchReource = Vue.resource(API_ROOT+'api/v1/ont/individual/email')  
/* 管理员根据序号查询审核信息 */
export const rownumbesearchrReource = Vue.resource(API_ROOT+'api/v1/ont/individual/rownumber')  


/* 内容管理系统 */
/* 管理员登录 */
export const newsloginReource = Vue.resource(API_ROOT+'api/v1/newsservice/manager/login')
/* 上传或更新 */
export const newsuploadReource = Vue.resource(API_ROOT+'api/v1/newsservice/news/upload')
/* 获取列表 */
export const newslistReource = Vue.resource(API_ROOT+'api/v1/newsservice/news/list/{language}/{pagesize}/{pagenumber}/{category}')
/* 获取详情 */
export const newsdetailReource = Vue.resource(API_ROOT+'api/v1/newsservice/news/{id}')
/* 删除 */
export const newsdeleteReource = Vue.resource(API_ROOT+'api/v1/newsservice/news/delete')
/* 隐藏 */
export const newshideReource = Vue.resource(API_ROOT+'api/v1/newsservice/news/hide')
/* 显示 */
export const newsshowReource = Vue.resource(API_ROOT+'api/v1/newsservice/news/show/{id}')


export const pageDetailReource = Vue.resource('/static/file/'+'{pgname}'+'.json')