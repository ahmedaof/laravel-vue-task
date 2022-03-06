  

<template>
  
  <div>

 <div class="row">
  <router-link to="/storeBrand" class="btn btn-primary add">Add Brand </router-link>
   
 </div>
<br>
   <input v-if="brands.length>0" type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">

<h3 class="text-center" v-if="brands.length == 0">no brands added </h3>
<br>

   <div class="row"  v-if="brands.length>0">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">brand List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>brand Name</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="brand in filtersearch" :key="brand.id">
                        <td> {{ brand.name }} </td>
                       
            <td>
   <router-link :to="{name: 'edit-brand', params:{id:brand.id}}" class="btn btn-sm btn-primary">Edit</router-link>

 <a @click="deletebrand(brand.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
            </td>
                      </tr>
                    
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->


   
  </div>


</template>



<script type="text/javascript">
  import axios from 'axios'
import { API } from '../../config/config'
  export default {
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },
    data(){
      return{
        brands:[],
        searchTerm:''
      }
    },
    computed:{
      filtersearch(){
      return this.brands.filter(brand => {
         return brand.name.match(this.searchTerm)
      }) 
      }
    },
 
  methods:{
    allbrand(){
      axios.get(`${API}/api/brand`)
      .then(({data}) => (this.brands = data))
      .catch()
    },
  deletebrand(id){
             this.$swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                axios.delete(`${API}/api/brand/`+id)
               .then(() => {
                this.brands = this.brands.filter(brand => {
                  return brand.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'brand'})
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
    this.allbrand();
  } 
  

  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>
