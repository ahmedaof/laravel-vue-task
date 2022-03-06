<template>
<div style="">
    <h1>shopping carts</h1>
    <ul>
        <li v-for="product in products" :key="product.id">
            <i class="fas fa-remove offset-md-10" @click="removeProductFromCart(product)" style="cursor: pointer;"></i>
            <br>
             product name:<h1>{{product.name}}</h1><br>
           <img :src="imageAPI+product.image" style="height: 112px;
    width: 115px;" />
        </li>

    </ul>
    </div>
</template>

<script>
import { API } from "../../config/config"


export default {
    data(){
        return {
            imageAPI: API+'/' ,
        }
    },
    methods:{
  removeProductFromCart(product){
      this.$store.dispatch('removeProductFromCart' , product)
    }
    },
  
    computed: {
        products(){
            return this.$store.getters.cartProducts
        }
    },

}
</script>
