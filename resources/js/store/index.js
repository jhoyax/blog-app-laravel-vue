import Vue from 'vue';
import Vuex from 'vuex';
import auth from './modules/auth';
import post from './modules/post';
import comment from './modules/comment';

Vue.use(Vuex)

const modules = {
  auth,
  post,
  comment
}

export default new Vuex.Store({
  modules
})
