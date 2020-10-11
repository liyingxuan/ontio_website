import * as resource from './resources'

export default {
  getFileEN: function () {
    return resource.FileENReource.get({})
  },
  getFileZH: function () {
    return resource.FileZHReource.get({})
  },
  getAppFileEN: function () {
    return resource.AppFileENReource.get({})
  },
  getAppFileZH: function () {
    return resource.AppFileZHReource.get({})
  },
  getTeamFileEN: function () {
    return resource.TeamFileENReource.get({})
  },
  getTeamFileKO: function () {
    return resource.TeamFileKOReource.get({})
  },
  getTeamFileZH: function () {
    return resource.TeamFileZHReource.get({})
  },
  getTechFileEN: function () {
    return resource.TechFileENReource.get({})
  },
  getTechFileZH: function () {
    return resource.TechFileZHReource.get({})
  },
  getJoinUsFileEN: function () {
    return resource.JoinUsFileENReource.get({})
  },
  getJoinUsFileZH: function () {
    return resource.JoinUsFileZHReource.get({})
  },
  getNewsFileZH: function () {
    return resource.NewsFileZHReource.get({})
  },
  getNewsFileEN: function () {
    return resource.NewsFileENReource.get({})
  },
  getarticle: function (ip) {
    return resource.articleReource.get({ip:ip})
  },
  getontViewZH: function () {
    return resource.ontViewZHReource.get({})
  },
  getontViewEN: function () {
    return resource.ontViewENReource.get({})
  },
/*   saveSubscribe: function (Name,PhoneNumber,OrgName,Email,Language) {
    return resource.SubscribeReource.save({},{Name:Name, PhoneNumber:PhoneNumber,OrgName:OrgName,Email:Email,Language:Language})
  }, */
  getCooperationZH: function () {
    return resource.CooperationZHReource.get({})
  },
  getCooperationEN: function () {
    return resource.CooperationENReource.get({})
  },
  getCooperationKO: function () {
    return resource.CooperationKOReource.get({})
  },
  savecooperationsubmit: function (name,contact,field,phone,detail) {
    return resource.cooperationsubmitReource.save({},{Name:name, ContactWay:contact,Detail:detail,Type:field,ContactNumber:phone})
  },
/*   节点 */
  getTrionesZH: function () {
    return resource.TrionesZHReource.get({})
  },
  getTrionesEN: function () {
    return resource.TrionesENReource.get({})
  },
  getTrionesListZH: function () {
    return resource.TrionesListZHReource.get({})
  },
  getTrionesListEN: function () {
    return resource.TrionesListENReource.get({})
  },
  gettrioneslist: function (region) {
    return resource.trioneslistReource.get({region:region})
  },

  /* kyc */
  mailverfirst: function (Email,EmailCode) {
    return resource.mailverfirstReource.get({Email:Email, EmailCode:EmailCode})
  },
  getcaptcha: function (phone,nation,EmailCode) {
    return resource.getcaptchaReource.get({phone:phone, nation:nation,EmailCode:EmailCode})
  },
  vercaptcha: function (phone,code) {
    return resource.vercaptchaReource.get({phone:phone, code:code})
  },
  registerindividual: function (EmailCode,Email,Data) {
    return resource.registerindividualReource.save({},{EmailCode:EmailCode, Email:Email,Data:Data})
  },
  getKYCFAQEN: function () {
    return resource.KYCFAQENReource.get({})
  },
  getKYCFAQZH: function () {
    return resource.KYCFAQZHReource.get({})
  },
  /* kyc check */
/* 审计员登录 */
auditorlogin: function (Name,Password) {
  return resource.auditorloginReource.save({},{Name:Name, Password:Password})
},
/* 分页查询个人简略信息 */
individualList: function (pagesize,pagenumber) {
  return resource.individualListReource.get({pagesize:pagesize,pagenumber:pagenumber})
},
/* 根据id查询个人照片 */
individualdetail: function (id) {
  return resource.individualdetailReource.get({id:id})
},
/* 审核信息 */
individualverification: function (Id,PassFlag,Reason,Auditor,Password) {
  return resource.individualverificationReource.save({},{Id:Id, PassFlag:PassFlag, Reason:Reason, Auditor:Auditor, Password:Password})
},
/* 查询已初次审核信息 */
individualfirst: function (PageSize,PageNumber,Auditor,FirstAuditor) {
  return resource.individualfirstReource.save({},{PageSize:PageSize, PageNumber:PageNumber, Auditor:Auditor,FirstAuditor:FirstAuditor})
},
/* 最终审核 */
individualsecondverification: function (Id,Auditor,PassFlag,Reason) {
  return resource.individualsecondverificationReource.save({},{Id:Id, Auditor:Auditor, PassFlag:PassFlag, Reason:Reason})
},
/* 管理员根据邮箱查询审核信息 */
notpasssearch: function (PageSize,PageNumber,Auditor,FirstAuditor) {
  return resource.notpasssearchReource.save({},{PageSize:PageSize, PageNumber:PageNumber, Auditor:Auditor,FirstAuditor:FirstAuditor})
},
/* 管理员根据邮箱查询审核信息 */
emailsearch: function (Email,Auditor) {
  return resource.emailsearchReource.save({},{Email:Email, Auditor:Auditor})
},
/* 管理员根据序号查询审核信息 */
rownumbesearch: function (RowNumber,Auditor) {
  return resource.rownumbesearchrReource.save({},{RowNumber:RowNumber,Auditor:Auditor})
},

/* 内容管理系统 */
/* 管理员登录 */
newslogin: function (Account,Password) {
  return resource.newsloginReource.save({},{Account:Account,Password:Password})
},
/* 上传或更新 */
newsupload:function (Account,Password,NewsList) {
  return resource.newsuploadReource.save({},{Account:Account,Password:Password,NewsList:NewsList})
},
/* 获取列表 */
newslist:function (language,pagesize,pagenumber,category) {
  return resource.newslistReource.get({language:language,pagesize:pagesize,pagenumber:pagenumber,category:category})
},
/* 获取详情 */
newsdetail:function (id) {
  return resource.newsdetailReource.get({id:id})
},
/* 删除 */
newsdelete:function (Id,Account,Password) {
  return resource.newsdeleteReource.save({},{Id:Id,Account:Account,Password:Password})
},
/* 隐藏 */
newshide:function (Id,Account,Password) {
  return resource.newshideReource.save({},{Id:Id,Account:Account,Password:Password})
},
/* 显示 */
newsshow:function (id) {
  return resource.newsshowReource.get({id:id})
},


/* 获取当前页面json */
pageDetail:function (pgname) {
  return resource.pageDetailReource.get({pgname:pgname})
},
}