class AppStorage{

 storeToken(token){
 	localStorage.setItem('token',token);
 }

 storeUser(user){
 	localStorage.setItem('user',user);
 }
 storeRole(role){
 	localStorage.setItem('role',role);
 }

 store(token,user,role){
 	this.storeToken(token)
 	this.storeUser(user)
 	this.storeRole(role)
  }

  clear(){
  	localStorage.removeItem('token')
  	localStorage.removeItem('user')
  	localStorage.removeItem('role')
  }

  getToken(){
  	localStorage.getItem(token);
  }

   getUser(){
  	localStorage.getItem(user);
  }
   getRole(){
  	localStorage.getItem(role);
  }



}

export default AppStorage = new AppStorage();