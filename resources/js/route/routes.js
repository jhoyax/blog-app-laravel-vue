import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../views/Home';
import CreatePost from '../views/CreatePost';
import SinglePost from '../views/SinglePost';
import NotFound from '../views/NotFound';
import MainContainer from '../views/MainContainer';

Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [
        {
          path: '/',
          component: MainContainer,
          children: [
            {
                path: '/',
                name: 'home',
                component: Home,
            },
            {
                path: '/post/create',
                name: 'createPost',
                component: CreatePost,
            },
            {
                path: '/post/:postId',
                name: 'singlePost',
                component: SinglePost,
            },
            {
                path: '*',
                name: 'notFound',
                component: NotFound,
            }
          ]
        }
    ]
});

export default router;
