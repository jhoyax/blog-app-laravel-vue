<template>
    <main>
        <auth-section 
            v-if="showAuthForm" 
            :showLoginForm="showLoginForm" 
            :showRegisterForm="showRegisterForm"/>
        <slider v-if="showSlider"/>
        <news/>
    </main>
</template>
<script>
import News from '../components/News';
import Slider from '../components/Slider';
import LoginForm from '../components/LoginForm';
import { eventBus } from '../services/eventBus';
import AuthSection from '../components/AuthSection';
import RegisterForm from '../components/RegisterForm';

export default {
    name: 'Home',
    components: {
        Slider,
        News,
        LoginForm,
        RegisterForm,
        AuthSection
    },
    data() {
        return {
            showAuthForm: false,
            showLoginForm: false,
            showRegisterForm: false,
            showSlider: true
        }
    },
    mounted() {
        eventBus.$on('showAuthForm', (isShow) => {
            this.showAuthForm = isShow;

            this.showLoginForm = isShow;
            this.showSlider = !isShow;
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
