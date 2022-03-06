<template>
  <v-container>
    <h1>pleaze sign up first</h1>
    <br />
    <br />
    <br />
    <v-form ref="form"  lazy-validation>
      <v-row class="text-center">
        <v-text-field
          v-model="form.name"
          :counter="10"
          label="Name"
          required
        ></v-text-field>
      </v-row>
       <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>

      <v-row class="text-center">
        <v-text-field
          v-model="form.email"
          label="E-mail"
          required
        ></v-text-field>
      </v-row>
   <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>

      <v-row class="text-center">
        <v-text-field
          v-model="form.password"
          :type="'password'"
          label="password"
          required
        ></v-text-field>
      </v-row>
   <small class="text-danger" v-if="errors.password"> {{ errors.password[0] }} </small>

      <v-row class="text-center">
<div>
      <label for="name" class="active">role</label>
    </div>
    <select  class="form-select" aria-label="Default select example" v-model="form.is_admin">
  <option value="0">Customer</option>
  <option value="1">Admin</option>
</select>
<small>we can remove role and make admin with seeding and customer sign up</small>
   <small class="text-danger" v-if="errors.is_admin"> {{ errors.is_admin[0] }} </small>

<br>
      </v-row>
      <v-row class="text-center">
        <v-checkbox
          v-model="checkbox"
          label="Do you agree?"
          required
        ></v-checkbox>
      </v-row>
      <v-row class="text-center">
        <v-btn
          color="success"
          class="mr-4"
          @click="signup"
        >
           submit
        </v-btn>
      </v-row>
      <br> <br>
          <v-row class="text-center">
              <RouterLink to="/login">already have account'</RouterLink> 
</v-row>
    </v-form>
  </v-container>
</template>
<script>
import axios from 'axios'
import { useRouter } from 'vue-router'
import { API } from '../../config/config';
  const router = useRouter()
export default {
  data() {
    return {
      items: ["admin", "customer"],
      checkbox: false,
      select: null,
      form: {
        email: null,
        name: null,
        password: null,

        is_admin: null ,
      },
           errors:{},
    };
  },
  methods: {
    
    signup() {
      axios
        .post(`${API}/api/auth/signup`, this.form)
       .then((response) => {
         console.log("ffffffffffffffffffffffffffff:"+JSON.stringify(response))
          axios
        .post(`${API}/api/send-token`, {email:this.form.email}).then((res)=>{
      this.$router.push({name:'validateCustomer'})

        }).catch()
               console.log(response)

   User.responseAfterLogin(response); 
        })
        .catch(error =>this.errors = error.response.data.errors);
    },
  },
};
</script>
