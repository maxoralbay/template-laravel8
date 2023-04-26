import { createRouter, createWebHistory, createWebHashHistory } from 'vue-router';
import middleware from '@grafikri/vue-middleware';
import routes from 'Routes/index.js';

const router = createRouter({
    history: createWebHistory(),
    // history: createWebHashHistory(),
    routes
});

router.beforeEach(middleware())

export default router;