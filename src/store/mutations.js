import { 
	SAVE_TOKEN_INFO,
	GET_TOKEN_INFO
 } from './mutation-types'

export default {
	[SAVE_TOKEN_INFO](state, {
		userId,
		token
	}) {
		state.userId = userId;
		state.token = token;
		localStorage.setItem('userId', userId);
		localStorage.setItem('token', token);
	},	
	[GET_TOKEN_INFO](state) {
		let userId = localStorage.getItem('userId');
		let token = localStorage.getItem('token');
		state.userId = userId;
		state.token = token;
	},	
}