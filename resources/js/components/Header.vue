<template>
    <header class="container">
        <div class="header__brand">
            <router-link :to="{ name: 'home' }"><logo/> <span>{{ $t('site_title') }}</span></router-link>
        </div>
        <nav>
            <ul  class="header__menu">
                <li><a href="#" @click.prevent="handleToggleDisplayAuthForm">{{ loginText }}</a></li>
            </ul>
        </nav>
    </header>
</template>

<script>
import { bus } from '../app'
import Logo from './Logo';

export default {
    name: 'Header',
    components: {
        Logo
    },
    data() {
        return {
            loginText: this.$t('login'),
            showAuthForm: false
        }
    },
    methods: {
        handleToggleDisplayAuthForm() {
            this.showAuthForm = !this.showAuthForm;

            bus.$emit('showAuthForm', this.showAuthForm)
            this.loginText = this.showAuthForm ? this.$t('close') : this.$t('login');
        }
    }
}
</script>
