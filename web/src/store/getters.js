export default {
  tokenInfo: ({token, userId}) => {
    if (!token || !userId) {
      token = localStorage.getItem('token');
      userId = localStorage.getItem('userId');
    }
    return {token, user_id: userId}
  },
  todayTodoList: state => {
    //todo筛选排序
    // itemList.filter(item=>item).sort((x, y)=>x < y)
    return state.itemList
  },
  editingItem: state => state.editingItem,
  categoryPickerList: state => state.categoryPickerList,
  categoryMap: state => state.categoryMap,
}
