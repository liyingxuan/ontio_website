import api from '../api'
import * as types from './mutation-types'
//for new cunzheng browser
export const NewRecord = ({ commit }, params) => {
  api.saveNewRecord(params.Action,params.Version,params.RecordData).then(response => {
    var data = response.body
    commit(types.NEWRECORD, {data})
  })
}
export const CakeyRecord = ({ commit }, params) => {
  api.getCakeyRecord(params.cakey).then(response => {
    var data = response.body
    commit(types.CAKEYRECORD, {data})
  })
}
export const FileZH = ({ commit }, params) => {
  api.getFileZH().then(response => {
    var data = response.body
    commit(types.FILEZH, {data})
  })
}
export const FileEN = ({ commit }, params) => {
  api.getFileEN().then(response => {
    var data = response.body
    commit(types.FILEEN, {data})
  })
}
export const AppFileEN = ({ commit }, params) => {
  api.getAppFileEN().then(response => {
    var data = response.body
    commit(types.APPFILEEN, {data})
  })
}
export const AppFileZH = ({ commit }, params) => {
  api.getAppFileZH().then(response => {
    var data = response.body
    commit(types.APPFILEZH, {data})
  })
}
export const TeamFileEN = ({ commit }, params) => {
  api.getTeamFileEN().then(response => {
    var data = response.body
    commit(types.TEAMFILEEN, {data})
  })
}
export const TeamFileZH = ({ commit }, params) => {
  api.getTeamFileZH().then(response => {
    var data = response.body
    commit(types.TEAMFILEZH, {data})
  })
}
export const TeamFileKO = ({ commit }, params) => {
  api.getTeamFileKO().then(response => {
    var data = response.body
    commit(types.TEAMFILEKO, {data})
  })
}
export const TechFileEN = ({ commit }, params) => {
  api.getTechFileEN().then(response => {
    var data = response.body
    commit(types.TECHFILEEN, {data})
  })
}
export const TechFileZH = ({ commit }, params) => {
  api.getTechFileZH().then(response => {
    var data = response.body
    commit(types.TECHFILEZH, {data})
  })
}
export const JoinUsFileEN = ({ commit }, params) => {
  api.getJoinUsFileEN().then(response => {
    var data = response.body
    commit(types.JOINUSFILEEN, {data})
  })
}
export const JoinUsFileZH = ({ commit }, params) => {
  api.getJoinUsFileZH().then(response => {
    var data = response.body
    commit(types.JOINUSFILEZH, {data})
  })
}
export const NewsFileZH = ({ commit }, params) => {
  api.getNewsFileZH().then(response => {
    var data = response.body
    commit(types.NEWSFILEZH, {data})
  })
}
export const NewsFileEN = ({ commit }, params) => {
  api.getNewsFileEN().then(response => {
    var data = response.body
    commit(types.NEWSFILEEN, {data})
  })
}
export const NewsFileKO = ({ commit }, params) => {
  api.getNewsFileEN().then(response => {
    var data = response.body
    commit(types.NEWSFILEKO, {data})
  })
}
export const article = ({ commit }, params) => {
  api.getarticle(params.ip).then(response => {
    var data = response.body
    commit(types.ARTICLE, {data})
  })
}
export const ontViewZH = ({ commit }, params) => {
  api.getontViewZH().then(response => {
    var data = response.body
    commit(types.ONTVIEWZH, {data})
  })
}
export const ontViewEN = ({ commit }, params) => {
  api.getontViewEN().then(response => {
    var data = response.body
    commit(types.ONTVIEWEN, {data})
  })
}
export const ontViewKO = ({ commit }, params) => {
  api.getontViewEN().then(response => {
    var data = response.body
    commit(types.ONTVIEWKO, {data})
  })
}
/* export const Subscribe = ({ commit }, params) => {
  api.saveSubscribe(params.Name,params.PhoneNumber,params.OrgName,params.Email,params.Language).then(response => {
    var data = response.body
    commit(types.SUBSCRIBE, {data})
  })
} */
export const CooperationZH = ({ commit }, params) => {
  api.getCooperationZH().then(response => {
    var data = response.body
    commit(types.COOPERATIONZH, {data})
  })
}
export const CooperationEN = ({ commit }, params) => {
  api.getCooperationEN().then(response => {
    var data = response.body
    commit(types.COOPERATIONEN, {data})
  })
}
export const CooperationKO = ({ commit }, params) => {
  api.getCooperationKO().then(response => {
    var data = response.body
    commit(types.COOPERATIONKO, {data})
  })
}

export const cooperationsubmit = ({ commit }, params) => {
  api.savecooperationsubmit(params.name,params.contact,params.field,params.phone,params.detail).then(response => {
    var data = response.body
    commit(types.COOPERATIONSUBMIT, {data})
  })
}
/* kyc */
/* 邮箱首次验证 */
export const mailverfirst = ({ commit }, params) => {
  api.mailverfirst(params.Email,params.EmailCode).then(response => {
    var data = response.body
    debugger
    document.cookie="kycAuth="+escape(data.Result);
    commit(types.MAILVERFIRST, {data})
  })
}
/* 手机获取短信验证码 */
export const getcaptcha = ({ commit }, params) => {
  api.getcaptcha(params.phone,params.nation,params.EmailCode).then(response => {
    var data = response.body
    commit(types.GETCAPTCHA, {data})
  },error =>{
    var data = error.body
    commit(types.GETCAPTCHA, {data})
  })
}
/* 短信验证码验证 */
export const vercaptcha = ({ commit }, params) => {
  api.vercaptcha(params.phone,params.code).then(response => {
    var data = response.body
    document.cookie="kycphoneAuth="+escape(data.Result);
    commit(types.VERCAPTCHA, {data})
  },error =>{
    var data = error
  })
}
/* 注册个人信息 */
export const registerindividual = ({ commit }, params) => {
  api.registerindividual(params.EmailCode,params.Email,params.Data).then(response => {
    var data = response.body
    commit(types.REGISTERINDIVIDUAL, {data})
  })
}
/* 节点 */
export const TrionesZH = ({ commit }, params) => {
  api.getTrionesZH().then(response => {
    var data = response.body
    commit(types.TRIONESZH, {data})
  })
}
export const TrionesEN = ({ commit }, params) => {
  api.getTrionesEN().then(response => {
    var data = response.body
    commit(types.TRIONESEN, {data})
  })
}
export const TrionesListZH = ({ commit }, params) => {
  api.getTrionesListZH().then(response => {
    var data = response.body
    commit(types.TRIONESLISTZH, {data})
  })
}
export const TrionesListEN = ({ commit }, params) => {
  api.getTrionesListEN().then(response => {
    var data = response.body
    commit(types.TRIONESLISTEN, {data})
  })
}
export const trioneslist = ({ commit }, params) => {
  api.gettrioneslist(params.region).then(response => {
    var data = response.body
    commit(types.TRIONESLIST, {data})
  })
}
export const KYCFAQEN = ({ commit }, params) => {
  api.getKYCFAQEN().then(response => {
    var data = response.body
    commit(types.KYCFAQEN, {data})
  })
}
export const KYCFAQZH = ({ commit }, params) => {
  api.getKYCFAQZH().then(response => {
    var data = response.body
    commit(types.KYCFAQZH, {data})
  })
}


/* 审计员登录 */
export const auditorlogin = ({ commit }, params) => {
  api.auditorlogin(params.Name,params.Password).then(response => {
    var data = response.body
    document.cookie="kycCheckAuth="+escape(data.Result);
    commit(types.AUDITORLOGIN, {data})
  })
}
  /* 分页查询个人简略信息 */
export const individualList = ({ commit }, params) => {
  api.individualList(params.pagesize,params.pagenumber).then(response => {
    var data = response.body
    commit(types.INDIVIDUALLIST, {data})
  })
}
/* 根据id查询个人照片 */
export const individualdetail = ({ commit }, params) => {
  api.individualdetail(params.id).then(response => {
    var data = response.body
    commit(types.INDIVIDUALDETAIL, {data})
  })
}
 /* 审核信息 */
export const individualverification = ({ commit }, params) => {
  api.individualverification(params.Id,params.PassFlag,params.Reason,params.Auditor,params.Password).then(response => {
    var data = response.body
    commit(types.INDIVIDUALVERIFICATION, {data})
  })
}
/* 初次审核后信息 */
export const individualfirst = ({ commit }, params) => {
  api.individualfirst(params.PageSize,params.PageNumber,params.Auditor,params.FirstAuditor).then(response => {
    var data = response.body
    commit(types.INDIVIDUALFIRST, {data})
  })
}
/* 注册个人信息 */
export const individualsecondverification = ({ commit }, params) => {
  api.individualsecondverification(params.Id,params.Auditor,params.PassFlag,params.Reason,).then(response => {
    var data = response.body
    commit(types.INDIVIDUALSECONDVERIFICATION, {data})
  })
}
/* 管理员查询未审核通过的记录 */
export const notpasssearch = ({ commit }, params) => {
  api.notpasssearch(params.PageSize,params.PageNumber,params.Auditor,params.FirstAuditor).then(response => {
    var data = response.body
    commit(types.NOTPASSSEARCH, {data})
  })
}
/* 管理员根据邮箱查询审核信息 */
export const emailsearch = ({ commit }, params) => {
  api.emailsearch(params.Email,params.Auditor).then(response => {
    var data = response.body
    commit(types.EMAILSEARCH, {data})
  })
}
/* 管理员根据序号查询审核信息 */
export const rownumbesearch = ({ commit }, params) => {
  api.rownumbesearch(params.RowNumber,params.Auditor).then(response => {
    var data = response.body
    commit(types.ROWNUMBESEARECH, {data})
  })
}

/* 内容管理系统 */
/* 管理员登录 */
export const newslogin = ({ commit }, params) => {
  api.newslogin(params.Account,params.Password).then(response => {
    var data = response.body
    commit(types.NEWSLOGIN, {data})
  })
}
/* 上传或更新 */
export const newsupload = ({ commit }, params) => {
  api.newsupload(params.Account,params.Password,params.NewsList).then(response => {
    var data = response.body
    commit(types.NEWSUPLOAD, {data})
  })
}
/* 获取列表 */
export const newslist = ({ commit }, params) => {
  api.newslist(params.language,params.pagesize,params.pagenumber,params.category).then(response => {
    var data = response.body
    commit(types.NEWSLIST, {data})
  })
}
/* 获取详情 */
export const newsdetail = ({ commit }, params) => {
  api.newsdetail(params.id).then(response => {
    var data = response.body
    commit(types.NEWSDETAIL, {data})
  })
}
/* 删除 */
export const newsdelete = ({ commit }, params) => {
  api.newsdelete(params.Id,params.Account,params.Password).then(response => {
    var data = response.body
    commit(types.NEWSDELETE, {data})
  })
}
/* 隐藏 */
export const newshide = ({ commit }, params) => {
  api.newshide(params.Id,params.Account,params.Password).then(response => {
    var data = response.body
    commit(types.NEWSHIDE, {data})
  })
}
/* 显示 */
export const newsshow = ({ commit }, params) => {
  api.newsshow(params.id).then(response => {
    var data = response.body
    commit(types.NEWSSHOW, {data})
  })
}
/* 获取当前页面json */
export const pageDetail = ({ commit }, params) => {
  api.pageDetail(params.pgname).then(response => {
    var data = response.body
    commit(types.PAGEDETAIL, {data})
  })
}