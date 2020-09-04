import http from "../../services/http";
const { MUTATION } = require('../mutation-types');
const { ACTION } = require('../action-types');

const state = {
  me: null,
};

const actions = {
    [ACTION.REGISTER]({commit}, {email, password, name, successCb, errorCb}) {
      let params = {email: email, password: password, name: name}
      http.post('register', params, res => {
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.LOGIN]({commit}, {email, password, successCb, errorCb}) {
      let params = {email: email, password: password}
      http.post('login', params, res => {
        commit(MUTATION.SET_ME, {me: res.data.user});
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.LOGOUT]({commit}, {successCb, errorCb}) {
      http.get('logout', () => {
        localStorage.removeItem('jwt-token');
        commit(MUTATION.REMOVE_ME);
        successCb();
      }, error => {
        errorCb(error);
      });
    }
};

const mutations = {
    [ MUTATION.SET_ME ]( state, { me } ) {
      state.me = me;
    },
    [MUTATION.REMOVE_ME](state) {
      state.me = null;
    },
};

export default {
  state,
  actions,
  mutations
}
