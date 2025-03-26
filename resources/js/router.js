// Import Vue dan Vue Router
import { createRouter, createWebHistory } from 'vue-router';

// Import Komponen
import Home from './components/Home.vue';
import About from './components/About.vue';

const routes = [
    { path: '/', component: Home, name: 'home' },
    { path: '/about', component: About, name: 'about' },
];

// Buat dan export router
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
