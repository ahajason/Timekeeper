import {md5} from "vux";

export default {
  saveTokenInfo: (state, {userId, token}) => {
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
    state.itemList = {...state.itemList, ...itemList};
  },
  setEditingItem: (state, editingItem) => {
    state.editingItem = editingItem;
  },
  updateEditingItem: (state, {key, value}) => {
    state.editingItem[key] = value;
  },
  setCategoryList: (state, categoryList) => {
    let categoryMap = {};
    state.categoryPickerList = categoryList.map(item => {
      categoryMap[item.category_id] = item;
      return {
        name: item.category_name,
        value: item.category_id,
      };
    });
    state.categoryMap = categoryMap;
  },
  generateItemSyncKey: state =>
    state.editingItem.item_sync_key = state.editingItem.item_sync_key ||
      md5(new Date().getTime() + Math.random().toString(16).substr(2)),
  InitEditingItem: state => state.editingItem = {
    item_sync_key: null,
    item_name: null,
    item_emergency_level: 5,
    item_importance_level: 5,
    category_id: '0',
  },

}
