<template>
    <article class="article__post">
        <div class="article__post-actions">
            <a href="#" @click.prevent="handleEditPost">Edit Post</a>
        </div>
        <time datetime="2020-02-20">2020.02.20</time>
        <h1>サンプルテキストサンプルテキストサンプルテキスト ササンプルテキストサンプルテキ</h1>
        <img src="/img/slider/slider1.jpg"/>
        <div class="article__post-content">
            サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト
            サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト
            
            サンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキスト
        </div>
    </article>
</template>
<script>
export default {
    name: 'PostForm',
    methods: {
        handleEditPost() {
            this.$emit('editPost');
        }
    }
}
</script>
