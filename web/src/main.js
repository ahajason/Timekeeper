// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store/'
//引入字体
import 'font-awesome/css/font-awesome.css'
import '@/assets/iconfont/iconfont.css';
//引入样式
import '@/style/common.css';
import 'swiper/dist/css/swiper.css';
import animate from 'animate.css/animate.min.css';
Vue.use(animate)
//引入公共方法
// import Common from '@/script/common.js';
import { startRequest } from './api'
Vue.prototype.$startRequest = startRequest;
//引入弹窗
import { LoadingPlugin, ToastPlugin, DatetimePlugin, ConfirmPlugin } from 'vux'
Vue.use(LoadingPlugin)
Vue.use(ToastPlugin)
Vue.use(DatetimePlugin)
Vue.use(ConfirmPlugin)
const FastClick = require('fastclick');
FastClick.attach(document.body);
Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
});
