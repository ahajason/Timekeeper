import Vue from 'vue'
//引入字体
import 'font-awesome/css/font-awesome.css'
import '@/assets/iconfont/iconfont.css';
//引入样式
import '@/style/common.css';
import 'swiper/dist/css/swiper.css';
import animate from 'animate.css/animate.min.css';

//引入组件
import Router from 'vue-router'
//引入页面
import helloWorld from '@/pages/helloWorld'
import mainPage from '@/pages/mainPage'
import subpage from '@/pages/subpage'
import home from '@/pages/home'
import timeline from '@/pages/timeline'
import management from '@/pages/management'
import user from '@/pages/user'
import createPlan from '@/pages/plan/create'
import settingPlan from '@/pages/plan/setting'
Vue.use(animate)
Vue.use(Router)


export default new Router({
  linkActiveClass: 'active',
  linkExactActiveClass: 'active',
  routes: [
    {
      path: '/',
      component: mainPage,
      children: [{
        path: '',
        name: 'home',
        component: home,
      }, {
        path: 'timeline',
        name: 'timeline',
        component: timeline
      }, {
        path: 'management',
        name: 'management',
        component: management
      }, {
        path: 'user',
        name: 'user',
        component: user
      }, ],
    },
    {
      path: '/subpage',
      name: 'subpage',
      component: subpage,
      children: [
         {
           path: '/create/:pSyncKey',
           name: 'createPlan',
           component: createPlan,
         }, {
           path: '/setting/:pSyncKey',
           name: 'settingPlan',
           component: settingPlan,
        },
        {
          path: '/timeing',
          name: 'timeing',
          // component: timeing,
        },
      ]
    }
  ]
})
