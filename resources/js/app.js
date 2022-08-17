
import {createApp} from 'vue' ;
import App from "./App.vue";

require('./bootstrap');
import 'bootstrap-icons/font/bootstrap-icons.css'
import router from "./router";
import store from "./store";
import VueSidebarMenu from 'vue-sidebar-menu'


let app = createApp(App);
app.use(router) ;
app.use(store) ;
app.use(VueSidebarMenu);
app.mount('#app');
