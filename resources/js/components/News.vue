<template>
    <section class="container">
        <div class="section__header">
            <h1>News</h1>
            <router-link :to="{ name: 'createPost' }">{{ $t('create_new_post') }}</router-link>
        </div>
        <div class="section__content">
            <article v-for="(item, index) in newsItems" :key="index">
                <figure>
                    <router-link :to="{ name: 'singlePost', params: { postId: 1 } }">
                        <img :src="item.image"/>
                        <time :datetime="item.date">{{$dashToDot(item.date)}}</time>
                        <figcaption>{{item.title}}</figcaption>
                    </router-link>
                </figure>
            </article>
        </div>
        <div class="section__footer">
            <button>Load More</button>
        </div>
    </section>
</template>

<script>
export default {
    name: 'News',
    data() {
        return {
            newsItems: [
                {
                    image: '/img/article/news.jpg',
                    title: 'サンプルテキストサンプルテキストサンプルテキスト',
                    date: '2019-06-21'
                },
                {
                    image: '/img/article/news.jpg',
                    title: 'サンプルテキストサンプルテキストサンプルテキスト',
                    date: '2019-06-21'
                },
                {
                    image: '/img/article/news.jpg',
                    title: 'サンプルテキストサンプルテキストサンプルテキスト',
                    date: '2019-06-21'
                },
                {
                    image: '/img/article/news.jpg',
                    title: 'サンプルテキストサンプルテキストサンプルテキスト',
                    date: '2019-06-21'
                },
                {
                    image: '/img/article/news.jpg',
                    title: 'サンプルテキストサンプルテキストサンプルテキスト',
                    date: '2019-06-21'
                },
                {
                    image: '/img/article/news.jpg',
                    title: 'サンプルテキストサンプルテキストサンプルテキスト',
                    date: '2019-06-21'
                }
            ]
        };
    }
}
</script>
