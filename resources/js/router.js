import { createRouter, createWebHistory } from 'vue-router';
import BookEvent from './pages/BookEvent.vue';
import Event from './pages/Event.vue';
import BookingHistory from './pages/BookingHistory.vue';
import Login from './pages/Login.vue';

const routes = [
  { path: '/', name: 'app', component: BookEvent },
  { path: '/event', name: 'event', component: Event },
  { path: '/bookingHistory', name: 'bookingHistory', component: BookingHistory },
  { path: '/login', name: "login", component: Login }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});
router.beforeEach((to, from, next) => {
  const isLoggedIn = !!localStorage.getItem('token');

  if (to.name === 'login' && isLoggedIn) {
    // إذا المستخدم مسجل دخول، امنعه من الدخول إلى صفحة تسجيل الدخول
    next({ name: 'app' }); // رجّعه للصفحة الرئيسية أو أي صفحة مناسبة
  } else {
    next(); // تابع التوجيه عادي
  }
});
export default router;