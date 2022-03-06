import { createRouter, createWebHistory } from 'vue-router'
//auth
import Login from '../components/auth/Login.vue'
import logout from '../components/auth/logout.vue'
import Signup from '../components/auth/Signup.vue'
import HomeView from '../views/HomeView.vue'

//category
import storecategory from '../components/category/create.vue'
import category from '../components/category/index.vue'
import editcategory from '../components/category/edit.vue'
//brands
import storebrand from '../components/brand/create.vue'
import brand from '../components/brand/index.vue'
import editbrand from '../components/brand/edit.vue'


import storeproduct from '../components/product/create.vue'
import product from '../components/product/index.vue'
import editproduct from '../components/product/edit.vue'


import categoryBrands from '../components/categoryBrands.vue'

//reset
import forgotPassword from '../components/auth/forgotPassword.vue'
import ConfirmCode from '../components/auth/confirmCode.vue'
import changePassword from '../components/auth/change password.vue'

import validateCustomer from '../components/auth/validateCustomer.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/signup',
      name: 'signup',
      component: Signup
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/forget',
      name: 'forget',
      component: forgotPassword
    },
    {
      path: '/confirm',
      name: 'confirmCode',
      component: ConfirmCode
    },
    {
      path: '/validate-customer',
      name: 'validateCustomer',
      component: validateCustomer
    },
    {
      path: '/change-password/:id',
      name: 'changePassword',
      component: changePassword
    },
    {
      path: '/logout',
      name: 'logout',
      component: logout
    },
    { path: '/storeCategory', component: storecategory, name:'storeCategory'},
    { path: '/category', component: category, name:'category'},
    { path: '/edit-category/:id', component: editcategory, name:'edit-category'},

    { path: '/storeBrand', component: storebrand, name:'storeBrand'},
    { path: '/brand', component: brand, name:'brand'},
    { path: '/edit-brand/:id', component: editbrand, name:'edit-brand'},

    { path: '/store-product', component: storeproduct, name:'store-product'},
  { path: '/product', component: product, name:'product'},
  { path: '/edit-product/:id', component: editproduct, name:'edit-product'},


  { path: '/categoryBrands', component: categoryBrands, name:'categoryBrands'},
  ]
})

export default router
