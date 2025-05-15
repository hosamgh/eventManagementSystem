import './bootstrap';
import { createApp } from 'vue';
import ToastPlugin from 'vue-toast-notification';
// Import one of the available themes
//import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import router from './router';
import App from './App.vue'
const app = createApp(App);
app.use(router);
app.use(ToastPlugin);
app.mount('#app');
