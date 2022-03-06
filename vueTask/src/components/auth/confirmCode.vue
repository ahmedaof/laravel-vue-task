<template>
 <v-container>
    <v-form ref="form"  lazy-validation>
      <v-row class="text-center">
        <v-text-field
          v-model="token"
          label="token"
          required
        ></v-text-field>
      </v-row>
           <small class="text-danger" v-if="errors.token"> {{ errors.token[0] }} </small>
      <br><br>

      <v-row class="text-center">
        <v-btn
          color="success"
          class="mr-4"
            @click="validateToken"
        >
           enter the code
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
              token:'',
              errors:{},
        }
    },
    methods:{
        validateToken(){
         axios
        .post(`${API}/api/validate-token`, {token:this.token})
       .then((res) => {
         console.log(res);
             this.$router.push({path:`/change-password/${JSON.stringify(res.data.id)}`})
        })
        .catch(error =>this.errors = error.response.data.errors);
        },
    }
}
</script>