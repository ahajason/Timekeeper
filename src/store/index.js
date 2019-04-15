import Vue from 'vue'
import Vuex from 'vuex'
import mutations from './mutations'
import actions from './action'
import getters from './getters'

Vue.use(Vuex)

const state = {
	userInfo: null,//用户信息
	userId: null,//账号ID
	token: null,//验证令牌
	itemList: {}//事项列表
}

export default new Vuex.Store({
	state,
	getters,
	actions,
	mutations,
})