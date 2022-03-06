import { createStore } from 'vuex';
import shoppingCartVue from '../components/product/shoppingCart.vue';
import User from '../Helpers/User';
const store = createStore({
 state:{
     products: [],
     cart:[],
     showCart:false,
     logedin:User.loggedIn()
 },
actions:{
    fetchProducts(context,products){
        context.state.products = products
    },
    showcart(context){
        context.state.showCart = !context.state.showCart 
    },
  
    logout(context){
        context.state.logedin = false 
    },
    addProductToCart(context,product){
        const cartItem = context.state.cart.find(item=> item.id === product.id)
        if(!cartItem){
          context.commit('pushProductToCart',product.id)
        }else{
            context.commit('incrementItemQuantity', cartItem)

        }
    },
    removeProductFromCart(context,product){

          context.commit('removeProductCart',product.id)

    }
},
 getters:{
     cartProducts (state){
         console.log("ffffffffffffffffffffffff"+JSON.stringify(state))
        return state.cart.map(cartItem=>{
            const product = state.products.find(product => product.id === cartItem.id);
            return {
                name:product.name,
                image:product.image
            }
        }) 
     }
 },
 mutations:{
    pushProductToCart (state, productId){
        state.cart.push({
            id: productId,
            quantity: 1
        })
    },
    removeProductCart (state, productId){
        state.cart.pop({
            id: productId,
            quantity: 1
        })
    },
    incrementItemQuantity (state, cartItem){
        cartItem.quantity++
 },
}

})

export default store;