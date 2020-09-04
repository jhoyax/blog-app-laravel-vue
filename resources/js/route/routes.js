import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../views/Home';
import NotFound from '../views/NotFound';

Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '*',
            component: NotFound,
        },
    ]
});

export default router;
