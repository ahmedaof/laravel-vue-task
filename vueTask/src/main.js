// import { createApp } from 'vue'
// import App from './App.vue'
// import router from './router'
// import store from './store'
// import vuetify from './plugins/vuetify'
// import { loadFonts } from './plugins/webfontloader'
// loadFonts()

// createApp(App)
//   .use(router)
//   .use(store)
//   .use(vuetify)
//   .mount('#app')
  import { createApp } from 'vue'
  import App from './App.vue'
  import router from './router'
  import store from './store'
  import User from './Helpers/User';
  import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import Notification from './Helpers/Notification';
import Toaster from '@meforma/vue-toaster';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

window.Notification = Notification;
loadFonts()
window.User = User;
  const app = createApp(App)
  app.use(router)
  app.use(VueSweetalert2);
  app.use(Toaster);
  app.use(store)

  app.use(vuetify)
  
  app.mount('#app')
  