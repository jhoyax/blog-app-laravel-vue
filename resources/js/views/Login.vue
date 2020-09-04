<template>
    <main class="container">
        <section class="section--center">
            <LoginForm/>
        </section>
    </main>
</template>
<script>
import LoginForm from '../components/LoginForm'

export default {
    name: 'Login',
    components: {
        LoginForm
    }
}
</script>
