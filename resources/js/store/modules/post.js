import http from "../../services/http";
const { ACTION } = require('../action-types');
const {MUTATION} = require('../mutation-types');

const state = {
    posts: [],
    postId: 0,
}
const getters = {
    posts: (state) => {
        return state.posts;
    },
    getPost: (state, getters) => (id) => {
      return state.posts.find(post => post.id === id) || {};
    }
}

const actions = {
    [ACTION.POST_LIST]({commit}, {page, perPage, concat, successCb, errorCb}) {
      page =  page || 1;
      perPage = perPage || 6;
      concat = concat || false;

      if (page === 1) concat = false;
      
      http.get('posts?page=' + page + '&per_page=' + perPage, res => {
        commit(MUTATION.POSTS_SET, {posts: res.data.data, concat: concat});
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.POST_STORE]({commit}, {title, content, image, successCb, errorCb}) {
      const config = {
        headers: { 'Content-Type': 'multipart/form-data' }
      }

      let formData = new FormData();
      formData.append('title', title);
      formData.append('content', content);
      formData.append('image', image);

      axios.post('posts', formData, config)
      .then((res) => {
        commit(MUTATION.POST_STORE, {post: res.data.data});
        successCb(res);
      }).catch((error) => { errorCb(error); });
    },
    [ACTION.POST_SHOW]({commit}, {id, successCb, errorCb}) {
      http.get('posts/' + id, res => {
        successCb(res);
      }, error => {
        errorCb(error);
      });
    },
    [ACTION.POST_UPDATE]({commit}, {id, title, content, image, successCb, errorCb}) {
      const config = {
        headers: { 'Content-Type': 'multipart/form-data', 'X-HTTP-Method-Override': 'PUT' }
      }

      let formData = new FormData();
      formData.append('title', title);
      formData.append('content', content);
      formData.append('image', image);

      axios.post('posts/' + id, formData, config)
      .then((res) => {
        commit(MUTATION.POST_STORE, {post: res.data.data});
        successCb(res);
      }).catch((error) => { errorCb(error); });
    },
    [ACTION.POST_DELETE]({commit}, {successCb, errorCb}) {
      let params = {}
      http.delete('posts/' + id, params, res => {
        successCb(res);
      }, error => {
        errorCb(error);
      });
    }
};

const mutations = {
    [MUTATION.POSTS_SET](state, {posts, concat}) {
        if (concat) {
          state.posts = state.posts.concat(posts);
        } else {
          state.posts = posts;
        }
    },
    [MUTATION.POST_STORE](state, {post}) {
        state.posts.push(post);
    },
    [MUTATION.POST_UPDATE](state, {post}) {
        state.posts[state.posts.findIndex(post => post.id == id)] = post;
    },
    [MUTATION.POST_REMOVE](state, {id}) {
        state.posts.splice([state.posts.findIndex(post => post.id == id)], 1);
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
