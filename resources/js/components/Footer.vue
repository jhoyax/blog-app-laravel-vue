<template>
    <footer>
        <div class="footer__links">
            <div class="container">
                <div class="footer__brand">
                    <router-link :to="{ name: 'home' }"><logo fill="#ffffff"/> <span>{{ $t('site_title') }}</span></router-link>
                </div>
                <nav>
                    <ul>
                        <li v-for="(item, index) in newsItems" :key="index">
                            <a :href="item.link">{{item.title}}</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="footer__copyright">
            <p>{{ $t('copyright') }}©2007-{{new Date().getFullYear()}} {{ $t('site_title') }} Inc.</p>
        </div>
    </footer>
</template>

<script>
import Logo from './Logo';

export default {
    name: 'Footer',
    components: {
        Logo
    },
    data() {
        return {
            newsItems: [
                {
                    link: '/news/1',
                    title: 'サンプルテキストサンプルテキストサンプルテキスト'
                },
                {
                    link: '/news/2',
                    title: 'サンプルテキストサンプルテキスト'
                },
                {
                    link: '/news/3',
                    title: 'サンプルテキストサンプルテキストサンプルテキスト'
                }
            ]
        };
    }
}
</script>
