import axios from 'axios'
import * as types from "../mutation-type"

export default {
  state: {
    TxnState: {
      info: '',
    },
    Change: {
      info: '',
    },    
    Detail: {
      info: '',
    },    
    Progress: {
      info: '',
    },    
  },
  mutations: {
    [types.SET_TXN_STATE](state, payload) {
      state.TxnState.info = payload.info
    },
    [types.SET_TXN_CHANGE](state, payload) {
      state.Change.info = payload.info
    },
    [types.SET_STXN_DETAIL](state, payload) {
      state.Detail.info = payload.info
    },
    [types.SET_PROGRESS](state, payload) {
      state.Progress.info = payload.info
    }
  },
  actions: {
    getTxnState({dispatch, commit},$param) {
/*       let used_url 
      if($param.net=="testnet"){
        used_url = process.env.TEST_API_URL
      }else{
        used_url = process.env.API_URL
      } */
      return axios.get(process.env.TEST_API_URL + '/api/v1/onttxn/txnstate/'+$param.address+'/'+$param.pageSize+'/'+$param.pageNumber).then(response => {
        let msg = response.data
        commit({
          type: types.SET_TXN_STATE,
          info: msg.Result,
        })
      }).catch(error => {
        console.log(error)
      })
    },
    getChange({dispatch, commit},$param) {
      /*       let used_url 
            if($param.net=="testnet"){
              used_url = process.env.TEST_API_URL
            }else{
              used_url = process.env.API_URL
            } */
            return axios.get(process.env.TEST_API_URL + '/api/v1/onttxn/ontchange/'+$param.address).then(response => {
              let msg = response.data
              commit({
                type: types.SET_TXN_CHANGE,
                info: msg.Result,
              })
            }).catch(error => {
              console.log(error)
            })
          },
    getDetail({dispatch, commit},$param) {
      /*       let used_url 
            if($param.net=="testnet"){
              used_url = process.env.TEST_API_URL
            }else{
              used_url = process.env.API_URL
            } */
            return axios.get(process.env.TEST_API_URL + '/api/v1/onttxn/txndetail/'+$param.txnhash).then(response => {
              let msg = response.data
              commit({
                type: types.SET_STXN_DETAIL,
                info: msg.Result,
              })
            }).catch(error => {
              console.log(error)
            })
          },
    getprogress({dispatch, commit}) {
      /*       let used_url 
            if($param.net=="testnet"){
              used_url = process.env.TEST_API_URL
            }else{
              used_url = process.env.API_URL
            } */
            return axios.get('https://swap.ont.io/api/v1/onttxn/swaprate').then(response => {
              let msg = response.data
              commit({
                type: types.SET_PROGRESS,
                info: msg.Result,
              })
            }).catch(error => {
              console.log(error)
            })
          },
  }
}
