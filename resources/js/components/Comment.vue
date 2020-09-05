<template>
    <section class="container">
        <div class="section__header">
            <h1>Comment</h1>
        </div>
        <div class="section__content">
            <article class="article__comment" v-for="(item, index) in comments" :key="index">
                <div>
                    {{ item.content }}    
                </div>
                <time :datetime="item.date">{{$dashToDot(item.date)}}</time>
            </article>
        </div>
        <div class="section__footer">
            <comment-form/>
        </div>
    </section>
</template>
<script>
import CommentForm from './CommentForm';

export default {
    name: 'Comment',
    components: {
        CommentForm
    },
    data() {
        return {
            comments: [
                {
                    content: 'サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト',
                    date: '2019-06-21'
                },
                {
                    content: 'サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト',
                    date: '2019-06-21'
                }
            ]
        };
    }
}
</script>
