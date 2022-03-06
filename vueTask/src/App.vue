<script setup>
import { RouterLink, RouterView } from 'vue-router'
import User from './Helpers/User';
</script>

<template>
<header>
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <RouterLink  class="navbar-brand" to="/">Home</RouterLink>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <RouterLink class="nav-link" v-if="!logedin" to="/signup">Register</RouterLink>
      </li>
      <li class="nav-item ">
        <RouterLink class="nav-link" v-if="logedin"  to="/logout">logout</RouterLink>
      </li>
      <li class="nav-item">
        <RouterLink class="nav-link"  v-if="!logedin"  to="/login">signin</RouterLink>
      </li>  

   
    </ul>
  
              <v-btn
          color="success"
          class="mr-4"
            @click="cart"
        >
          cart 
      <i class="fas fa-shopping-cart"></i>{{products.length}}
        </v-btn>
      
  </div>
  
</nav>


<div class="row" >
  <div class="col-md-2" v-if="logedin">
    <ul  class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" style="background-color: #f8f9fa;
    margin: 0px;
    padding: 20px;">
      <li class="nav-item">
        <router-link class="nav-link" to="/category">
          category
        </router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/brand">
          <span>brand</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/product">
          <span>products</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" to="/categoryBrands">
          <span>Category and Brands</span>
        </router-link>
      </li>
      </ul>
  </div>
  <div class="col">

  <RouterView />
  </div>
</div>
  
  </header>
</template>

<script>
  export default {
  computed:{
    showCart(){
      return this.$store.state.showCart
    },
    logedin(){
      return this.$store.state.logedin
    },
   
        products(){
            return this.$store.getters.cartProducts
        }
  },
  methods:{
    cart(){
      this.$store.dispatch('showcart');
    }
  }
}
</script>


