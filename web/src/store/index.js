import Vue from 'vue'
import Vuex from 'vuex'
import mutations from './mutations'
import actions from './action'
import getters from './getters'

Vue.use(Vuex)

const state = {
	userInfo: {},//用户信息
	userId: null,//账号ID
	token: null,//验证令牌
	itemList: {},//事项列表
	editingItem: {//编辑中的事项
		item_sync_key: null,
		item_name: null,
		item_emergency_level: 5,
		item_importance_level: 5,
		category_id: '0',
	},
	categoryPickerList: [],//类别Picker选择列表
	categoryMap: {},//类别映射
}

export default new Vuex.Store({
	state,
	getters,
	actions,
	mutations,
})