import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

// Buat aplikasi Vue dan pasang router
const app = createApp(App);
app.use(router);
app.mount('#app');
