<template>
<div>
   <div style="background-color: #eff0f1;" id="cart" v-show="showCart"  class="col-md-3 offset-md-9">
       <ShoppingCart />
      </div>
  <h1>dashboard</h1>
<Product />
  </div>
</template>
<script>
import Product from "./product/index.vue";
import ShoppingCart from "./product/shoppingCart.vue"; 
export default {
  components :{
    Product,
    ShoppingCart
},
 computed:{
    showCart(){
      return this.$store.state.showCart
    }
  },
}
</script>
