<template>
    <footer>
        <div class="footer__links">
            <div class="footer__brand">
                <logo fill="#ffffff"/>
                <router-link :to="{ name: 'home' }">{{ $t('site_title') }}</router-link>
            </div>
            <nav>
                <ul>
                    <li><a href="#">{{ $t('login') }}</a></li>
                    <li><a href="#">{{ $t('login') }}</a></li>
                    <li><a href="#">{{ $t('login') }}</a></li>
                </ul>
            </nav>
        </div>
        <div class="footer__copyright">
            
        </div>
    </footer>
</template>

<script>
import Logo from './Logo';

export default {
    name: 'Footer',
    components: {
        Logo
    }
}
</script>
