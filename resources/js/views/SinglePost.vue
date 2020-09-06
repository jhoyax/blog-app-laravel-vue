<template>
    <main>
        <breadcrumb :links="breadCrumbLinks" v-if="showChildren"/>
        <section class="container">
            <post-form v-if="edit" v-on:cancelEdit="handleCancelEdit" :post="post"/>
            <post-display v-else v-on:editPost="handleEditPost" :post="post"/>
        </section>
        <div class="container" v-if="hasComment">
            <hr/>
        </div>
        <comment v-if="hasComment" :commentableType="'post'" :commentableId="routePostId"/>
    </main>
</template>

<script>
import Breadcrumb from '../components/Breadcrumb';
import PostForm from '../components/PostForm';
import PostDisplay from '../components/PostDisplay';
import Comment from '../components/Comment';
import authOptions from '../mixins/authOptions';
import { eventBus } from '../services/eventBus';

const store = require('../store/').default;
const {POST_SHOW} = require('../store/action-types');

export default {
    name: 'SinglePost',
    mixins: [authOptions],
    components: {
        Breadcrumb,
        PostForm,
        PostDisplay,
        Comment
    },
    data() {
        return {
            edit: false,
            hasComment: true,
            breadCrumbLinks: [
                {
                    title: ''
                }
            ],
            post: {},
            routePostId: Number(this.$route.params.postId)
        }
    },
    mounted() {
        if ( 'postId' in this.$route.params) {
            if (isNaN(this.routePostId)) {
                this.$router.push({name: 'notFound'});
            } else {
                this.fetchPost(this.routePostId);
            }
        }
        eventBus.$on('fetchedComment', (data, hasAuth) => {
            this.hasComment = data.length || hasAuth? true : false;
        });
    },
    methods: {
        fetchPost(id) {
            let params = {
                id: id,
                successCb: res => {
                    this.post = res.data.data;
                    this.breadCrumbLinks = [
                        {
                            title: this.post.title
                        }
                    ];
                },
                errorCb: error => {
                    this.$router.push({name: 'notFound'});
                }
            };
            store.dispatch(POST_SHOW, params);
        },
        handleEditPost() {
            this.edit = true;
        },
        handleCancelEdit(post) {
            this.edit = false;
            this.post = post;
            this.breadCrumbLinks = [
                {
                    title: this.post.title
                }
            ];
        }
    }
}
</script>
