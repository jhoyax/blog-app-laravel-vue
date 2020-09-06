<template>
    <main>
        <auth-section 
            v-if="showAuthForm" 
            :showLoginForm="showLoginForm" 
            :showRegisterForm="showRegisterForm"/>
        <router-view :showChildren="showChildren"/>
    </main>
</template>

<script>
import { eventBus } from '../services/eventBus';
import AuthSection from '../components/AuthSection';

export default {
    name: 'MainContainer',
    components: {
        AuthSection
    },
    data() {
        return {
            showAuthForm: false,
            showLoginForm: false,
            showRegisterForm: false,
            showChildren: true
        }
    },
    mounted() {
        eventBus.$on('showAuthForm', (isShow) => {
            this.showAuthForm = isShow;

            this.showLoginForm = isShow;
            this.showChildren = !isShow;
            this.showRegisterForm = false;
        });
        eventBus.$on('showLoginForm', () => {
            this.showLoginForm = true;
            this.showRegisterForm = false;
        });
        eventBus.$on('showRegisterForm', () => {
            this.showLoginForm = false;
            this.showRegisterForm = true;
        });
    }
}
</script>
