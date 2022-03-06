   

<template>
  
  <div>

 <div class="row">
  <router-link to="/brand" class="btn btn-primary add">All Brands </router-link>
   
 </div>



    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"> Brand Update</h1>
                  </div>

      <form class="user" @submit.prevent="brandUpdate">

        <div class="form-group">

          <div class="form-row">
            <div class="col-md-12">
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Brand Name" v-model="form.name">
  <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
           

            </div> 
            
          </div>
        </div>
       
         
 


        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Update</button>
        </div>
        
      </form>
                  <hr>
                  <div class="text-center">
  
  
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</template>



<script type="text/javascript">
import { API } from "../../config/config"
import axios from 'axios'
  
  export default {
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },

    data(){
    return {
      form:{
        name: '',
       
        
      },
      errors:{}
    }
  },
  created(){
  	let id = this.$route.params.id
  	axios.get(`${API}/api/brand/`+id)
  	.then(({data}) => (this.form = data))
  	.catch(console.log('error'))
  },

  methods:{
    
       brandUpdate(){
  	  let id = this.$route.params.id
       axios.patch(`${API}/api/brand/`+id,this.form)
       .then(() => {
        this.$router.push({ name: 'brand'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  } 


  }
   
</script>


<style type="text/css">
  
</style>