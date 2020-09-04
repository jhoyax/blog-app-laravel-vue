<template>
    <header class="container">
        <div class="header__brand">
            <router-link :to="{ name: 'home' }">{{ $t('site_title') }}</router-link>
        </div>
        <nav :class="{ 'nav--show' : showNav}">
            <router-link :to="{ name: 'login' }" v-if="!isLoggedIn">{{ $t('login') }}</router-link>
            <router-link :to="{ name: 'register' }" v-if="!isLoggedIn">{{ $t('register') }}</router-link>
            <a href="#" v-if="isLoggedIn" @click="handleLogout">{{ $t('logout') }}</a>
        </nav>
        <div class="header__burger" @click="handleBurgerClick">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            isLoggedIn: false,
            showNav: false,
        }
    },
    methods: {
        handleLogout(e) {
            e.preventDefault();
        },
        handleBurgerClick(e) {
            e.preventDefault();
            this.showNav = !this.showNav;
        }
    }
}
</script>
