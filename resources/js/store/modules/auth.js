import http from "../../services/http";
const { ACTION } = require('../action-types');

const actions = {
    [ACTION.REGISTER]({commit}, {name, email, password, password_confirmation, successCb, errorCb}) {
      let params = {name: name, email: email, password: password, password_confirmation: password_confirmation}
      http.post('register', params, res => {
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.LOGIN]({commit}, {email, password, successCb, errorCb}) {
      let params = {email: email, password: password}
      http.post('login', params, res => {
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.LOGOUT]({commit}, {successCb, errorCb}) {
      http.post('logout', {}, res => {
        $cookies.remove('token');
        successCb(res);
      }, error => {
        errorCb(error);
      });
    }
};

export default {
  actions
}
