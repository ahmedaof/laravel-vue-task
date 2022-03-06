<template>
 <v-container>
    <v-form ref="form"  lazy-validation>
      <v-row class="text-center">
        <v-text-field
          v-model="password"
          :type="'password'"
          label="change password"
          required
        ></v-text-field>
      </v-row>

           <small class="text-danger" v-if="errors.password"> {{ errors.password[0] }} </small>
<br><br>
      <v-row class="text-center">
        <v-btn
          color="success"
          class="mr-4"
            @click="changePassword"
        >
           change Password
        </v-btn>
      </v-row>
    </v-form>
         </v-container>
</template>

<script>
import axios from 'axios'
import { API } from '../../config/config'
export default {
    name:'password-reset',
    props:['app'],
    data(){
        return{
              password:'',
                  errors:{},
        }
    },

         methods:{
        changePassword(){
         axios
        .post(`${API}/api/reset-password`, {password:this.password,user_id:this.$route.params.id})
       .then((res) => {
           console.log("dddddddddddddddd:"+JSON.stringify(res))
           this.$router.push({name:'login'})
        })
        .catch(error =>this.errors = error.response.data.errors);
        },
    }
}
</script>