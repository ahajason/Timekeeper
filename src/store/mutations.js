export default {
	saveTokenInfo: (state, { userId, token }) => {
		state.userId = userId;
		state.token = token;
		localStorage.setItem('userId', userId);
		localStorage.setItem('token', token);
	},
	setUserInfo: (state, userInfo) => {
		state.userInfo = userInfo;
	},
	setItemList: (state, itemList) => {
		state.itemList = itemList;
	},
	addItemList: (state, itemList) => {
		state.itemList = { ...state.itemList, ...itemList };
	},
	setEditingItem: (state, editingItem) => {
		state.editingItem = editingItem;
	},
	updateEditingItem: (state, { key, value }) => {
		console.log(key, value)
		state.editingItem[key] = value;
		console.log(state.editingItem)
	},
	setCategoryList: (state, categoryList) => {
		let categoryMap = {};
		state.categoryPickerList = categoryList.map(item => {
			categoryMap[item.category_id] = item
			return {
				name: item.category_name,
				value: item.category_id,
			};
		});
		state.categoryMap = categoryMap;
	},

}