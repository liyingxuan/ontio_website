import axios from 'axios'
import * as types from "../mutation-type"

export default {
  state: {
    BlockDetail: {
      info: '',
      lastBlockHeight: '',
      nextBlockHeight: '',
    }
  },
  mutations: {
    [types.SET_BLOCK_DETAIL_PAGE](state, payload) {
      state.BlockDetail.info = payload.info
      state.BlockDetail.lastBlockHeight = payload.lastBlockHeight
      state.BlockDetail.nextBlockHeight = payload.nextBlockHeight
    }
  },
  actions: {
    getBlockDetailPage({dispatch, commit},$param) {
      let used_url 
      if($param.net=="testnet"){
        used_url = process.env.TEST_API_URL
      }else{
        used_url = process.env.API_URL
      }
      return axios.get(used_url + '/block/'+$param.param).then(response => {
        let msg = response.data
        //console.log(msg.Result)

        let blockHeight = msg.Result.Height
        let nextBlock
        if (blockHeight>1){
          nextBlock = blockHeight-1
        }else{
          nextBlock = 1
        }
        let lastBlock = blockHeight+1

        commit({
          type: types.SET_BLOCK_DETAIL_PAGE,
          info: msg.Result,
          lastBlockHeight: lastBlock,
          nextBlockHeight: nextBlock,
        })
      }).catch(error => {
        console.log(error)
      })
    },
  }
}
