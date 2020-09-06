import http from "../../services/http";
const { ACTION } = require('../action-types');
const {MUTATION} = require('../mutation-types');

const state = {
    comments: []
}
const getters = {
    comments: (state) => {
        return state.comments;
    }
}

const actions = {
    [ACTION.COMMENT_LIST]({commit}, {commentableType, commentableId, page, perPage, successCb, errorCb}) {
      page =  page || 1;
      perPage = perPage || 20;
      http.get('comments?page=' + page + '&per_page=' + perPage + '&commentable_type=' + commentableType + '&commentable_id=' + commentableId, res => {
        commit(MUTATION.COMMENTS_SET, {comments: res.data.data});
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.COMMENT_STORE]({commit}, {commentableType, commentableId, content, parentId, successCb, errorCb}) {
      parentId = parentId || 0;
      let params = {commentable_type: commentableType, commentable_id: commentableId, content: content, parent_id: parentId}
      http.post('comments', params, res => {
        commit(MUTATION.COMMENT_STORE, {comment: res.data.data});
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.COMMENT_SHOW]({commit}, {id, successCb, errorCb}) {
      http.get('comments/' + id, res => {
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.COMMENT_UPDATE]({commit}, {content, successCb, errorCb}) {
      let params = {content: content}
      http.put('comments/' + id, params, res => {
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.COMMENT_DELETE]({commit}, {successCb, errorCb}) {
      let params = {}
      http.delete('comments/' + id, params, res => {
        successCb(res);
      }, error => {
        errorCb(error);
      });
    }
};

const mutations = {
    [MUTATION.COMMENTS_SET](state, {comments}) {
        state.comments = comments;
    },
    [MUTATION.COMMENT_STORE](state, {comment}) {
        state.comments.unshift(comment);
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
