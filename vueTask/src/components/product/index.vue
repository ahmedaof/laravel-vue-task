 

<template>
  
  <div>

 <div class="row">
  <router-link v-if="logedin" to="/store-product" class="btn btn-primary add">Add Product </router-link>
   
 </div>
<br>
   <input v-if="products.length>0" type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">

<h3 class="text-center" v-if="products.length == 0">no products added </h3>

<br>

   <div class="row" v-if="products.length> 0">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
                  <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                </div>

 <v-card  v-for="product in filtersearch" :key="product.id"
    class="mx-auto"
    max-width="344"
    outlined
  >
<div class="col-md-4">
    <v-list-item three-line>
      <v-list-item-content>
        <div class="text-overline mb-4">
        code: {{ product.SKE }}
        </div>
        <v-list-item-title class="text-h5 mb-1">
          name:{{ product.name }}
        </v-list-item-title>
        <v-list-item-subtitle>category:{{ product.category.name}}</v-list-item-subtitle>
        <v-list-item-subtitle>brand:{{ product.brand.name}}</v-list-item-subtitle>
      </v-list-item-content>

  <img class="ml-10" :src="imageAPI+product.image">
    </v-list-item>

    <v-card-actions v-if="logedin" >
      <v-btn
      color="error"
        outlined
        rounded
        text
        @click="deleteProduct(product.id)"
      >
        delete
      </v-btn>
    </v-card-actions>
    <v-card-actions v-if="logedin" >
      <v-btn
       color="info"
        outlined
        rounded
        text
        @click="addProductToCart(product)"
      >
        <i class="fas fa-shopping-cart"></i>add to card
      </v-btn>
    </v-card-actions>
    <v-card-actions v-if="logedin" >
      <v-btn
        outlined
        rounded
        text
      >
          <router-link :to="{name: 'edit-product', params:{id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>

      </v-btn>
    </v-card-actions>
    </div>
  </v-card>

                </div>
      
          </div>



</template>



<script type="text/javascript">
import { API } from "../../config/config"
  import axios from 'axios'
  
  export default {
    data(){
      return{
        products:[],
        searchTerm:'',
         imageAPI: API+'/' ,
      }
    },
    computed:{
      filtersearch(){
      return this.products.filter(product => {
         return product.name.match(this.searchTerm)
      }) 
      },
     logedin(){
      return this.$store.state.logedin
  },
    },
 
  methods:{
    addProductToCart(product){
      this.$store.dispatch('addProductToCart' , product)
    },
    fetchProducts(product){
      this.$store.dispatch('fetchProducts' , product)
    },
    allProduct(){
      axios.get(`${API}/api/product/`)
      .then(({data}) => (this.products = data,
      this.fetchProducts(this.products)
      ))
      .catch()
    },
  deleteProduct(id){
      if(User.IsAdmin() == 0){
         this.$swal({
              title: 'this action for admins only?',
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
            }).then((result) => {
              })
    }
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                axios.delete(`${API}/api/product/`+id)
               .then(() => {
                this.products = this.products.filter(product => {
                  return product.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'product'})
               })
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })

  } 

  },

  created(){
    this.allProduct();
    
  } 
  

  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>