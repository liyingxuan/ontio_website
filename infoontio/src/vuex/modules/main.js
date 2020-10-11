/**
 * Created by tanyuan on 25/4/2017.
 */
import * as types from '../mutation-types'

const state = {
  FileEN:[],
  FileZH:[],
  AppFileZH:[],
  AppFileEN:[],
  TeamFileZH:[],
  TeamFileEN:[],
  TeamFileKO:[],
  TechFileZH:[],
  TechFileEN:[],
  JoinUsFileEN:[],
  JoinUsFileZH:[],
  NewsFileEN:[],
  NewsFileZH:[],
  NewsFileKO:[],
  ontViewEN:[],
  ontViewZH:[],
  ontViewKO:[],
  CooperationEN:[],
  CooperationZH:[],
  CooperationKO:[],
  article:[],
  cooperationsubmit:[],
  TrionesZH:[],
  TrionesEN:[],
  TrionesListZH:[],
  TrionesListEN:[],
  trioneslist:[],
  KYCFAQEN:[],
  KYCFAQZH:[],
  mailverfirst:[],
  getcaptcha:[],
  vercaptcha:[],
  registerindividual:[],
/*   Subscribe:[] */
auditorlogin:[],
individualList:[],
individualdetail:[],
individualverification:[],
individualfirst:[],
individualsecondverification:[],
notpasssearch:[],
emailsearch:[],
rownumbesearch:[],
newslogin:[],
newsupload:[],
newslist:[],
newsdetail:[],
newsdelete:[],
newshide:[],
newsshow:[],
pageDetail:[]
}

const mutations = {

  [types.FILEZH] (state, { data }) {
    state.FileZH = data
  },
  [types.FILEEN] (state, { data }) {
    state.FileEN = data
  },
  [types.APPFILEZH] (state, { data }) {
    state.AppFileZH = data
  },
  [types.APPFILEEN] (state, { data }) {
    state.AppFileEN = data
  },
  [types.TEAMFILEZH] (state, { data }) {
    state.TeamFileZH = data
  },
  [types.TEAMFILEEN] (state, { data }) {
    state.TeamFileEN = data
  },
  [types.TEAMFILEKO] (state, { data }) {
    state.TeamFileKO = data
  },
  [types.TECHFILEZH] (state, { data }) {
    state.TechFileZH = data
  },
  [types.TECHFILEEN] (state, { data }) {
    state.TechFileEN = data
  },
  [types.JOINUSFILEZH] (state, { data }) {
    state.JoinUsFileZH = data
  },
  [types.JOINUSFILEEN] (state, { data }) {
    state.JoinUsFileEN = data
  },
  [types.NEWSFILEEN] (state, { data }) {
    state.NewsFileEN = data
  },
  [types.NEWSFILEZH] (state, { data }) {
    state.NewsFileZH = data
  },
  [types.NEWSFILEKO] (state, { data }) {
    state.NewsFileKO = data
  },
  [types.ARTICLE] (state, { data }) {
    state.article = data
  },
  [types.ONTVIEWEN] (state, { data }) {
    state.ontViewEN = data
  },
  [types.ONTVIEWZH] (state, { data }) {
    state.ontViewZH = data
  },
  [types.ONTVIEWKO] (state, { data }) {
    state.ontViewKO = data
  },
  [types.COOPERATIONEN] (state, { data }) {
    state.CooperationEN = data
  },
  [types.COOPERATIONZH] (state, { data }) {
    state.CooperationZH = data
  },
  [types.COOPERATIONKO] (state, { data }) {
    state.CooperationKO = data
  },
  [types.COOPERATIONSUBMIT] (state, { data }) {
    state.cooperationsubmit = data
  },
/*   [types.SUBSCRIBE] (state, { data }) {
    state.Subscribe = data
  } */
  [types.TRIONESEN] (state, { data }) {
    state.TrionesEN = data
  },
  [types.TRIONESZH] (state, { data }) {
    state.TrionesZH = data
  },
  [types.TRIONESLISTEN] (state, { data }) {
    state.TrionesListEN = data
  },
  [types.TRIONESLISTZH] (state, { data }) {
    state.TrionesListZH = data
  },
  [types.TRIONESLIST] (state, { data }) {
    state.trioneslist = data
  },
  [types.MAILVERFIRST] (state, { data }) {
    state.mailverfirst = data
  },
  [types.GETCAPTCHA] (state, { data }) {
    state.getcaptcha = data
  },
  [types.VERCAPTCHA] (state, { data }) {
    state.vercaptcha = data
  },
  [types.REGISTERINDIVIDUAL] (state, { data }) {
    state.registerindividual = data
  },
  [types.KYCFAQEN] (state, { data }) {
    state.KYCFAQEN = data
  },
  [types.KYCFAQZH] (state, { data }) {
    state.KYCFAQZH = data
  },
  [types.AUDITORLOGIN] (state, { data }) {
    state.auditorlogin = data
  },
  [types.INDIVIDUALLIST] (state, { data }) {
    state.individualList = data
  },
  [types.INDIVIDUALDETAIL] (state, { data }) {
    state.individualdetail = data
  },
  [types.INDIVIDUALVERIFICATION] (state, { data }) {
    state.individualverification = data
  },
  [types.INDIVIDUALFIRST] (state, { data }) {
    state.individualfirst = data
  },
  [types.INDIVIDUALSECONDVERIFICATION] (state, { data }) {
    state.individualsecondverification = data
  },
  [types.NOTPASSSEARCH] (state, { data }) {
    state.notpasssearch = data
  },
  [types.EMAILSEARCH] (state, { data }) {
    state.emailsearch = data
  },
  [types.ROWNUMBESEARECH] (state, { data }) {
    state.rownumbesearch = data
  },

  [types.NEWSLOGIN] (state, { data }) {
    state.newslogin = data
  },
  [types.NEWSUPLOAD] (state, { data }) {
    state.newsupload = data
  },
  [types.NEWSLIST] (state, { data }) {
    state.newslist = data
  },
  [types.NEWSDETAIL] (state, { data }) {
    state.newsdetail = data
  },
  [types.NEWSDELETE] (state, { data }) {
    state.newsdelete = data
  },
  [types.NEWSHIDE] (state, { data }) {
    state.newshide = data
  },
  [types.NEWSSHOW] (state, { data }) {
    state.newsshow = data
  },
  [types.PAGEDETAIL] (state, { data }) {
    state.pageDetail = data
  },
}
export default {
  state,
  mutations
}
