import './bootstrap';
import Vue from 'vue';
import router from './route/routes';
import store from './store/';
import App from './App.vue';
import i18n from './services/i18n'
import http from "./services/http"
import { dashToDot } from './helpers/formatter'

Vue.prototype.$dashToDot = (...args) => dashToDot(...args);

export const bus = new Vue();

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
