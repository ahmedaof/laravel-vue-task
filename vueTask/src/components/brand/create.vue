 

<template>
  
  <div>

 <div class="row">
  <router-link to="/brand" class="btn btn-primary">All Brands </router-link>
   
 </div>



    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Brand</h1>
                  </div>

      <form class="user" @submit.prevent="brandInsert">

        <div class="form-group">

          <div class="form-row">
            <div class="col-md-12">
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Brand Name" v-model="form.name">
  <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
           

            </div> 
            
          </div>
        </div>
       
         
 


        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
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