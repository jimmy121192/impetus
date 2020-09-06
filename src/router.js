import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import Register from './components/Register'
import Admin from './components/Admin'
import Profile from './components/Profile'
import Challenge from './components/Challenge'
import Events from './components/Events'
import Master from './views/Master'
import Feeds from './components/Feeds'
import Stats from './components//AdminPanel/Stats'
Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/master',
      name: 'master',
      component: Master
    },
    {
      path: '/Admin',
      name: 'admin',
      component: Admin
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/profile',
      name: 'profile',
      component: Profile
    },
    {
      path: '/challenge',
      name: 'challenge',
      component: Challenge
    },
    {
      path: '/events',
      name: 'events',
      component: Events
    },
    {
      path: '/feeds',
      name: 'feeds',
      component: Feeds
    },
    {
      path: '/stats',
      name: 'stats',
      component: Stats
    },
    // {
    //   path: '/about',
    //   name: 'about',
    //   // route level code-splitting
    //   // this generates a separate chunk (about.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    // }
  ]
})
