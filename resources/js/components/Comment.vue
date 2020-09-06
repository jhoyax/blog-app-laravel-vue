<template>
    <section class="container">
        <div class="section__header">
            <h2>Comment</h2>
        </div>
        <div class="section__content">
            <article class="article__comment" v-for="(item, index) in comments" :key="index">
                <span>{{item.user}}</span>
                <div class="article__comment-content">
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
                    user: 'user 1',
                    content: 'サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト',
                    date: '2019-06-21'
                },
                {
                    user: 'Luffy',
                    content: 'サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト サンプルテキストサンプルテキストサンプルテキスト',
                    date: '2019-06-21'
                }
            ]
        };
    }
}
</script>
