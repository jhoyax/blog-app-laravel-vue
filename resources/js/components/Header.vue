<template>
    <header class="container">
        <div class="header__brand">
            <router-link :to="{ name: 'home' }"><logo/> <span>{{ $t('site_title') }}</span></router-link>
        </div>
        <nav>
            <ul  class="header__menu">
                <li><a href="#">{{ $t('login') }}</a></li>
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
