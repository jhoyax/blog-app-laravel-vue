<template>
    <main>
        <section class="container container--center" v-if="showAuthForm">
            <login-form v-if="showLoginForm"/>
            <register-form v-if="showRegisterForm"/>
        </section>
        <slider v-if="showSlider"/>
        <news/>
    </main>
</template>
<script>
import Slider from '../components/Slider';
import News from '../components/News';
import LoginForm from '../components/LoginForm';
import RegisterForm from '../components/RegisterForm';
import { bus } from '../app'

export default {
    name: 'Home',
    components: {
        Slider,
        News,
        LoginForm,
        RegisterForm
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
        bus.$on('showAuthForm', (isShow) => {
            this.showAuthForm = isShow;

            this.showLoginForm = isShow;
            this.showSlider = !isShow;
            this.showRegisterForm = false;
        });
        bus.$on('showLoginForm', () => {
            this.showLoginForm = true;
            this.showRegisterForm = false;
        });
        bus.$on('showRegisterForm', () => {
            this.showLoginForm = false;
            this.showRegisterForm = true;
        });
    }
}
</script>
