<template>
    <section class="container">
        <div class="section__header">
            <h1>News</h1>
            <router-link v-if="hasUser" :to="{ name: 'createPost' }">{{ $t('create_new_post') }}</router-link>
        </div>
        <div class="section__content">
            <article v-for="(item, index) in this.$store.getters.posts" :key="index">
                <figure>
                    <router-link :to="{ name: 'singlePost', params: { postId: item.id } }">
                        <img :src="item.image || '/img/article/280x200.jpg'"/>
                        <time :datetime="item.date">{{$formatter('dashToDot', item.date)}}</time>
                        <figcaption>{{item.title}}</figcaption>
                    </router-link>
                </figure>
            </article>
        </div>
        <div class="section__footer">
            <button v-if="showLoadMore" @click.prevent="handleLoadMore">Load More</button>
        </div>
    </section>
</template>

<script>
import { eventBus } from '../services/eventBus';

const store = require('../store/').default;
const {POST_LIST} = require('../store/action-types');

export default {
    name: 'News',
    data() {
        return {
            hasUser: false,
            currentPage: 1,
            lastPage: 0
        };
    },
    computed: {
        showLoadMore() {
            return this.currentPage < this.lastPage;
        }
    },
    mounted() {
        eventBus.$on('userLoggedIn', (data) => {
            this.hasUser = data;
        });

        if ($cookies.get('token')) {
            this.hasUser = true;
        }

        this.fetchPosts();
    },
    methods: {
        fetchPosts() {
            let params = {
                page: this.currentPage,
                concat: true,
                successCb: res => {
                    this.lastPage = res.data.meta.last_page
                    eventBus.$emit('fetchedPost', JSON.parse(JSON.stringify(res.data.data)));
                },
                errorCb: error => {}
            };
            store.dispatch(POST_LIST, params);
        },
        handleLoadMore() {
            this.currentPage += 1;
            this.fetchPosts();
        }
    }
}
</script>
