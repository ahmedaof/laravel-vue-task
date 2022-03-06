<template>
    
</template>

<script>
import { useStore } from "vuex";

export default{
    created(){
        const store = useStore()
         store.state.logedin = false ;
        localStorage.removeItem('token')
        localStorage.removeItem('user') 
        localStorage.removeItem('role') 
          this.$router.push({name:'home'})
   
    }
}
</script>