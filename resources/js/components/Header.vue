<template>
    <header>
        <div class="header__brand">
            <router-link :to="{ name: 'home' }"><logo/> {{ $t('site_title') }}</router-link>
        </div>
        <nav>
            <ul  class="header__menu">
                <li><a href="#">{{ $t('login') }}</a></li>
                <li><a href="#">{{ $t('register') }}</a></li>
            </ul>
        </nav>
    </header>
</template>

<script>
import Logo from './Logo';

export default {
    name: 'Header',
    components: {
        Logo
    }
}
</script>
