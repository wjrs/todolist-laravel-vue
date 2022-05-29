import Vue from 'vue'
import VueRouter from 'vue-router'
import LayoutDefault from "@/layouts/Default";
import LayoutAuth from '../layouts/Auth'
import Login from "@/views/Login"
import Register from "@/views/Register"
import VerifyEmail from "@/views/VerifyEmail"
import ForgotPassword from "@/views/ForgotPassword"
import ResetPassword from "@/views/ResetPassword";
import Home from "@/views/Home";
import Guard from "@/service/middleware";
import Profile from "@/views/Profile";

Vue.use(VueRouter)

const routes = [
  {
      path: '/', component: LayoutDefault,
      beforeEnter: Guard.redirectIfNotAuthenticated,
      children: [
          { path: '', name: 'index', component: Home },
          { path: 'profile', name: 'profile', component: Profile },
      ],
  },
  {
    path: '/login', component: LayoutAuth,
    beforeEnter: Guard.redirectIfAuthenticated,
    children: [
      { path: '', name: 'login', component: Login },
    ],
  },
  {
    path: '/register', component: LayoutAuth,
    children: [
      { path: '', name: 'register', component: Register },
    ],
  },
  {
    path: '/verify', component: LayoutAuth,
    children: [
      { path: '', name: 'verify', component: VerifyEmail },
    ],
  },
  {
    path: '/forgot-password', component: LayoutAuth,
      children: [
        { path: '', name: 'forgotPassword', component: ForgotPassword },
      ],
  },
  {
    path: '/reset-password', component: LayoutAuth,
      children: [
        { path: '', name: 'resetPassword', component: ResetPassword },
      ],
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
