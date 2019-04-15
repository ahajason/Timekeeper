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
}