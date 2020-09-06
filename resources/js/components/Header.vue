<template>
    <header class="container">
        <div class="header__brand">
            <router-link :to="{ name: 'home' }"><logo/> <span>{{ $t('site_title') }}</span></router-link>
        </div>
        <nav>
            <ul  class="header__menu">
                <li v-if="hasUser"><a href="#" @click.prevent="handleLogout">{{$t('logout')}}</a></i>
                <li v-else><a href="#" @click.prevent="handleToggleDisplayAuthForm">{{ loginText }}</a></li>
            </ul>
        </nav>
    </header>
</template>

<script>
import Logo from './Logo';
const store = require('../store/').default;
import { eventBus } from '../services/eventBus';
const {LOGOUT} = require('../store/action-types');

export default {
    name: 'Header',
    components: {
        Logo
    },
    data() {
        return {
            loginText: this.$t('login'),
            showAuthForm: false,
            hasUser: false
        }
    },
    mounted() {
        eventBus.$on('userLoggedIn', (data) => {
            this.hasUser = data;
            if(data) {
                this.handleToggleDisplayAuthForm();
            }
        });

        if ($cookies.get('token')) {
            this.hasUser = true;
        }
    },
    methods: {
        handleToggleDisplayAuthForm() {
            this.showAuthForm = !this.showAuthForm;

            eventBus.$emit('showAuthForm', this.showAuthForm)
            this.loginText = this.showAuthForm ? this.$t('close') : this.$t('login');
        },
        handleLogout() {
            let params = {
                successCb: res => {
                    this.hasUser = false;
                    eventBus.$emit('userLoggedIn', false);
                },
                errorCb: error => {}
            }
            store.dispatch(LOGOUT, params);
        }
    }
}
</script>
