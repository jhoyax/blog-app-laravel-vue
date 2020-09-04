import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './views/Home';
import Login from './views/Login';
import Register from './views/Register';
import NotFound from './views/NotFound';

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
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '*',
            component: NotFound,
        },
    ]
});

export default router;
