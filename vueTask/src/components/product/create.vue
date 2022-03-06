

<template>
  
  <div>

 <div class="row">
  <router-link to="/product" class="btn btn-primary add">All Product </router-link>
   
 </div>

 
<v-container>
    <v-form ref="form"  lazy-validation>

      <v-row class="text-center">
        <v-text-field
          v-model="form.name"
          label="name"
          required
        ></v-text-field>
      </v-row>
          <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
     
      <v-row class="text-center">
        <v-text-field
          v-model="form.SKE"
          label="name"
          required
        ></v-text-field>
      </v-row>
          <small class="text-danger" v-if="errors.SKE"> {{ errors.SKE[0] }} </small>
           
           <label for="exampleFormControlSelect1">Product Category</label>
      <select class="form-control" id="exampleFormControlSelect1" v-model="form.category_id">
     <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option> -->
                       
                      </select>  
         <small class="text-danger" v-if="errors.category_id"> {{ errors.category_id[0] }} </small>
 
               <label for="exampleFormControlSelect1">Product Brand</label>
 <select class="form-control" id="exampleFormControlSelect1" v-model="form.brand_id">
   
     <option :value="brand.id" v-for="brand in brands" :key="brand.id">{{ brand.name }}</option> -->
                        
                      </select> 
     <small class="text-danger" v-if="errors.brand_id"> {{ errors.brand_id[0] }} </small>

<div class="form-row">
        <div class="col-md-6">
   <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">

       <label class="custom-file-label" for="customFile">Choose file</label>
            </div>


     <div class="col-md-6">
        <img :src="form.image" style="height: 40px; width: 40px;">
       </div>     
            
 </div>
         
      </v-form>
      </v-container>
        <v-row class="text-center">
        <v-btn
          color="success"
          class="mr-4"
          @click="ProductInsert"
        >
           add Product
        </v-btn>
      </v-row>
 </div> 

  
 



</template>



<script type="text/javascript">
import { API } from "../../config/config";
import axios from 'axios'
import { useRouter } from "vue-router";
    const router = useRouter()
  export default {
    data(){
    return {
      form:{
        name: null,
        SKE: null,
        category_id: null,
        brand_id: null,
        image: null,
      },
      errors:{},
      categories:{},
      brands:{},
    }
  },

  methods:{
    onFileSelected(event){
     let file = event.target.files[0];
     if (file.size > 1048770) {
      Notification.image_validation()
     }else{
      let reader = new FileReader();
      reader.onload = event =>{
        this.form.image = event.target.result
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
     }

    },
  ProductInsert(){
       axios.post(`${API}/api/product/`,this.form)
       .then((res) => {
         console.log(res)
        this.$router.push({ name: 'product'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  },
  created(){
    if(User.IsAdmin() == 0){
         this.$swal({
              title: 'this action for admins only?',
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
            }).then((result) => {
              })
               this.$router.push({ name: 'home'})
    }
    axios.get(`${API}/api/category/`)
    .then(({data}) => (this.categories = data))

    axios.get(`${API}/api/brand/`)
    .then(({data}) => (this.brands = data))

  } 


  }
   
</script>


<style type="text/css">
  
</style>