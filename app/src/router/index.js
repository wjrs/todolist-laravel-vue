import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import LayoutAuth from '../layouts/Auth'
import Login from "@/views/Login"
import Register from "@/views/Register"

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/login', component: LayoutAuth,
    children: [
      { path: '', name: 'login', component: Login },
    ],
  },
  {
    path: '/register', component: LayoutAuth,
    children: [
      { path: '', name: 'register', component: Register },
    ],
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
