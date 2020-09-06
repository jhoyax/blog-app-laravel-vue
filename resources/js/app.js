import './bootstrap';
import Vue from 'vue';
import router from './route/routes';
import store from './store/';
import App from './App.vue';
import i18n from './services/i18n'
import http from "./services/http"
import { dashToDot } from './helpers/formatter'
import VueCookies from 'vue-cookies'

Vue.use(VueCookies)

// set default config
Vue.$cookies.config('7d');

Vue.prototype.$dashToDot = (...args) => dashToDot(...args);

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
