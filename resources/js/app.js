import './bootstrap';
import Vue from 'vue';
import router from './routes';
import store from './store/';
import App from './App.vue';
import i18n from './i18n'
import http from "./services/http"

new Vue({
    el: '#app',
    router,
    store,
    i18n,
    created() {
      http.init();
    },
    render: h => h(App)
});
