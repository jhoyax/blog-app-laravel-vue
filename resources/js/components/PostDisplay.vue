<template>
    <article class="article__post">
        <div class="article__post-actions" v-if="$cookies.get('token') && post.canEdit">
            <a href="#" @click.prevent="handleEditPost">Edit Post</a>
        </div>
        <time datetime="2020-02-20">{{$formatter('dashToDot', post.date)}}</time>
        <h1>{{post.title}}</h1>
        <div class="article__post-image" v-if="post.image" :style="`background-image:url('` + post.image + `')`"></div>
        <div class="article__post-content">{{post.content}}</div>
    </article>
</template>
<script>
import singlePost from '../mixins/singlePost';

export default {
    name: 'PostForm',
    mixins: [singlePost],
    methods: {
        handleEditPost() {
            this.$emit('editPost');
        }
    }
}
</script>
