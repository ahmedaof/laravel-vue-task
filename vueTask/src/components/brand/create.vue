<template>

  <div>

 <div class="row">
  <router-link to="/brand" class="btn btn-primary add">All Brand </router-link>
   
 </div>

   <h1 class="h4 text-gray-900 mb-4">Add Brand </h1>
   
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
      </v-form>
      </v-container>
        <v-row class="text-center">
        <v-btn
          color="success"
          class="mr-4"
          @click="brandInsert"
        >
           add Brand
        </v-btn>
      </v-row>
        
                  <hr>
                  <div class="text-center">
  
  
                  </div>
                  <div class="text-center">
                  </div>
                </div>


</template>




<script type="text/javascript">
import { API } from "../../config/config"
import axios from 'axios'
  
  export default {
created(){
    if(User.IsAdmin() ==0){
         this.$swal({
              title: 'this action for admins only?',
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
            }).then((result) => {
              })
               this.$router.push({ name: 'home'})
    }
},
    data(){
    return {
      form:{
        name: null
        
      },
      errors:{}
    }
  },

  methods:{
    
  brandInsert(){
       axios.post(`${API}/api/brand`,this.form)
       .then((res) => {
         console.log(res)
        this.$router.push({ name: 'brand'})
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  } 


  }
   
</script>


<style type="text/css">
  
</style>
