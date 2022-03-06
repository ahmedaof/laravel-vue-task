   

<template>
  
  <div>

 <div class="row">
  <router-link to="/category" class="btn btn-primary add">All Category </router-link>
   
 </div>

   <h1 class="h4 text-gray-900 mb-4"> Category Update</h1>
   
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
          @click="categoryUpdate"
        >
           Update
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
    data(){
    return {
      form:{
        name: '',
       
        
      },
      errors:{}
    }
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
  	let id = this.$route.params.id
  	axios.get(`${API}/api/category/`+id)
  	.then(({data}) => (this.form = data))
  	.catch(console.log('error'))
  },

  methods:{
    
  categoryUpdate(){
  	  let id = this.$route.params.id
       axios.patch(`${API}/api/category/`+id,this.form)
       .then((res) => {
         console.log(res)
        this.$router.push({ name: 'category'})
        Notification.success()
       })
       .catch((error) =>{console.log('fffffffffff:'+erroe),this.errors = error.response.data.errors})
     },
  } 


  }
   
</script>


<style type="text/css">
  
</style>