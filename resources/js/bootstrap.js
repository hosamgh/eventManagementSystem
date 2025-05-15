import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js'; // ✅ استخدم import بدل require

// إعداد axios
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// إعداد Pusher و Echo
window.Pusher = Pusher;

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: '5fed855ca904de9194c1',
  cluster: 'ap2',
  forceTLS: true, 
});