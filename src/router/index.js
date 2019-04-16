import Vue from 'vue'
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
import createItem from '@/pages/item/create'
import settingItem from '@/pages/item/setting'
import itemDetails from '@/pages/item/details'
import tomato from '@/pages/tomato'

import login from '@/pages/user/login'
import register from '@/pages/user/register'

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
      },],
    },
    {
      path: '/subpage',
      name: 'subpage',
      component: subpage,
      children: [
        {
          path: '/create',
          name: 'createItem',
          component: createItem,
        },
        {
          path: '/setting',
          name: 'settingItem',
          component: settingItem,
        },
        {
          path: '/details/:synckey',
          name: 'itemDetails',
          component: itemDetails,
        },
        {
          path: '/tomato',
          name: 'tomato',
          component: tomato,
        },
        {
          path: '/timeing',
          name: 'timeing',
          // component: timeing,
        },
        {
          path: '/login',
          name: 'login',
          component: login,
        },
        {
          path: '/register',
          name: 'register',
          component: register,
        },


      ]
    }
  ]
})
