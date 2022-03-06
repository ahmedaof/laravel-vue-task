<template>
 <v-container>
    <v-form ref="form"  lazy-validation>
      <v-row class="text-center">
        <v-text-field
          v-model="email"
          label="E-mail"
          required
        >
        </v-text-field>
      </v-row>
     <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>
<br><br>

      <v-row class="text-center">
        <v-btn
          color="success"
          class="mr-4"
            @click="sendToken"
        >
           send code
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
           email:'',     
         errors:{},
        }
    },
    methods:{
        sendToken(){
         axios
        .post(`${API}/api/send-token`, {email:this.email})
       .then((res) => {
             this.$router.push({name:'confirmCode'})
        })
        .catch(error =>this.errors = error.response.data.errors);
        },
    }
}
</script>