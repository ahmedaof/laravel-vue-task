<template>
<div class="div">
<div class="container">
        <v-form ref="form"  lazy-validation>
    <div class="row mt-200">
        <div class="row"><br><br><br></div>
        <div class="col">
<label class="mb-2">choose  category to attach</label>

    <select v-model="form.category_id" class="form-select" >
  <option :value="category.id" v-for="category in categories" :key="category.id">{{category.name}}</option>
</select>
        </div>
        <div class="col">
<label class="mb-2">choose brand to attach</label>
    <select v-model="form.brand_id"  class="form-select">
  <option :value="brand.id" v-for="brand in brands" :key="brand.id">{{brand.name}}</option>

</select>
        </div>
    </div>

           <v-row class="text-center">
        <v-btn
          color="success"
          class="mt-6 ml-5"
          @click="insertBrandsCategory"
        >
           add relation for bran $ cat
        </v-btn>
      </v-row>
    </v-form>
</div>

<div class="container">
    <div class="row mt-5" v-for="BrandsCategory in BrandsCategories" :key="BrandsCategory.id">
        <div class="col">
<h2 v-if="BrandsCategory.categories.length != 0">Brand:{{BrandsCategory.name}}</h2>
        </div>
        <div class="col">

<h3>it's category</h3>
<h4 v-for="category in BrandsCategory.categories" :key="category.id">{{category.name}}</h4>
        </div>
        <hr>
    </div>
</div>
</div>
</template>


<script>
  import axios from 'axios'
import { API } from '../config/config'
 export default {
    data(){
    return {
        form:{
            category_id:'',
            brand_id:''
        },
      categories:{},
      brands:{},
      BrandsCategories:{},

    }
  },
   created(){
    axios.get(`${API}/api/category/`)
    .then(({data}) => (this.categories = data))

    axios.get(`${API}/api/BrandsCategories/`)
    .then(({data}) => (this.BrandsCategories = data))

    axios.get(`${API}/api/brand/`)
    .then(({data}) => (this.brands = data))

  } ,
  methods:{
       insertBrandsCategory(){
       axios.post(`${API}/api/BrandsCategories/`,this.form)
       .then((res) => {
         console.log(res)
        this.$router.push({ name: 'BrandsCategories'})
       })
       .catch(error =>this.errors = error.response.data.errors)
  },
  }
 }
</script>
