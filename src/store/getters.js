export default {
    tokenInfo: ({token,userId}) => {
        if (!token || !userId) {
            token = localStorage.getItem('token');
            userId = localStorage.getItem('userId');
        }
        return { token, user_id: userId }
    },
    todayTodoList: (state) => {
        console.log('ssss',state.itemList)
        // itemList.filter(item=>item).sort((x, y)=>x < y)
        return state.itemList
    },
}