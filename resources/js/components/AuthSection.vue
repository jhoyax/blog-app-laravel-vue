<template>
    <section class="container container--center">
        <login-form v-if="showLoginForm"/>
        <register-form v-if="showRegisterForm"/>
    </section>
</template>
<script>
import LoginForm from '../components/LoginForm';
import RegisterForm from '../components/RegisterForm';

export default {
    name: 'AuthSection',
    props: {
        showLoginForm: {
            type: Boolean,
            default: true
        },
        showRegisterForm: {
            type: Boolean,
            default: true
        }
    },
    components: {
        LoginForm,
        RegisterForm
    }
}
</script>
