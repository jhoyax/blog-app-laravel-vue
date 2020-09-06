<template>
    <section class="container">
        <div class="section__header">
            <h2>Comment</h2>
        </div>
        <div class="section__content">
            <article class="article__comment" v-for="(item, index) in this.$store.getters.comments" :key="index">
                <span>{{item.user.name}}</span>
                <div class="article__comment-content">{{ item.content }}</div>
                <time :datetime="item.date">{{getTimeAgo(item.timestamp)}}</time>
            </article>
        </div>
        <div class="section__footer">
            <comment-form v-if="$cookies.get('token')" :commentableType="commentableType" :commentableId="commentableId"/>
        </div>
    </section>
</template>
<script>
import CommentForm from './CommentForm';
import commentable from '../mixins/commentable';
import { eventBus } from '../services/eventBus';

import TimeAgo from 'javascript-time-ago';
import en from 'javascript-time-ago/locale/en'

TimeAgo.addLocale(en);
const timeAgo = new TimeAgo('en-US');

const store = require('../store/').default;
const {COMMENT_LIST} = require('../store/action-types');

export default {
    name: 'Comment',
    mixins: [commentable],
    components: {
        CommentForm
    },
    data() {
        return {
            currentPage: 1,
            timeAgo: timeAgo
        };
    },
    mounted() {
        this.fetchComments();
    },
    methods: {
        fetchComments() {
            let params = {
                commentableType: this.commentableType,
                commentableId: this.commentableId,
                page: this.currentPage,
                successCb: res => {
                    eventBus.$emit('fetchedComment', JSON.parse(JSON.stringify(res.data.data)), res.data.hasAuth)
                },
                errorCb: error => {}
            };
            store.dispatch(COMMENT_LIST, params);
        },
        getTimeAgo(timestamp) {
            return timeAgo.format(Date.now() - (((Date.now() / 1000) - timestamp) * 1000));
        }
    }
}
</script>
