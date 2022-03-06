<template>
 <v-container>
    <h1>pleaze in </h1>
    <br />
    <br />
    <br />
    <v-form ref="form"  lazy-validation>
      <v-row class="text-center">
        <v-text-field
          v-model="email"
          label="E-mail"
          required
        ></v-text-field>
      </v-row>
    <small class="text-danger" v-if="errors"> {{ errors.email }} </small>

<br><br>
      <v-row class="text-center">
        <v-text-field
          v-model="password"
          :type="'password'"
          label="password"
          required
        ></v-text-field>
      </v-row>
         <small class="text-danger" v-if="errors"> {{ errors.password }} </small>

<br><br>

      <v-row class="text-center">
        <v-btn
          color="success"
          class="mr-4"
          @click="login"
        >
           login
        </v-btn>
      </v-row>
    </v-form>
    <br> <br>
        <RouterLink to="/forget">forget password</RouterLink> <br>
        <RouterLink to="/signup">don't have account'</RouterLink> 
         </v-container>
</template>


<script type="text/javascript">
import { ref } from '@vue/reactivity'
import { useRouter } from 'vue-router'
import axios from 'axios'
import { API } from '../../config/config'
import { useStore } from 'vuex'
export default {
  setup(){
     const store = useStore()
     const router = useRouter()
    const email = ref('');
    const password = ref('');
    const errors = ref(null);
    const login = () => {
      axios.post(`${API}/api/auth/login`,{
       email:email.value,
       password:password.value
    }).then((res) => {
         User.responseAfterLogin(res);
          store.state.logedin = true ;
      router.push({name:'home'})
        }).catch();
        };

    
    return {login,email,password,errors}
  },

}

</script>