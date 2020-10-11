import axios from 'axios'
import * as types from "../mutation-type"

export default {
  state: {
    TxnDetail: {
      info: '',
    }
  },
  mutations: {
    [types.SET_TXN_DETAIL](state, payload) {
      state.TxnDetail.info = payload.info
    }
  },
  actions: {
    getTxnDetailPage({dispatch, commit},$param) {
      let used_url 
      if($param.net=="testnet"){
        used_url = process.env.TEST_API_URL
      }else{
        used_url = process.env.API_URL
      }
      return axios.get('https://swap.ont.io' + '/api/v1/onttxn/txndetail/'+$param.txnHash).then(response => {
        let msg = response.data

        commit({
          type: types.SET_TXN_DETAIL,
          info: msg.Result,
        })
      }).catch(error => {
        console.log(error)
      })
    },
  }
}
