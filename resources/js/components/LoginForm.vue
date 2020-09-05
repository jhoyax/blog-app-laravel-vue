<template>
    <form method="POST" action="/login">
        <div class="form__group">
            <h1 class="form__title">{{ $t('form.login.title') }}</h1>
        </div>
        <div class="form__group">
            <label>{{ $t('email') }}</label>
            <input type="email" class="form__field" v-model="fields.email" required/>
            <messages-list :items="messages.email"/>
        </div>
        <div class="form__group">
            <label>{{ $t('password') }}</label>
            <input type="password" class="form__field" v-model="fields.password" required/>
            <messages-list :items="messages.password"/>
        </div>
        <div class="form__group">
            <button
                type="submit"
                class="form__action"
                @click="handleSubmit"
            >{{ $t('login') }}</button>
            <messages-list :items="messages.general" :isSuccess="isSuccess"/>
        </div>
        <div class="form__group">
            {{ $t('no_account_yet') }} <router-link :to="{ name: 'register' }">{{ $t('register_now') }}</router-link>.
        </div>
    </form>
</template>

<script>
const store = require('../store/').default;
const {LOGIN} = require('../store/action-types');

export default {
    name: 'LoginForm',
    data() {
        return {
            messages: {
                general: [],
                email: [],
                password: [],
            },
            fields: {
                email: '',
                password: '',
            },
            isSuccess: false,
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();

            let params = {
                name: this.fields.name,
                email: this.fields.email,
                successCb: res => {
                    this.isSuccess = true;

                    this.messages.general = [response.data.message];
                    this.messages.email = [];
                    this.messages.password = [];

                    this.fields.email = '';
                    this.fields.password = '';

                    this.$router.push('/')
                },
                errorCb: error => {
                    this.isSuccess = false;

                    this.messages.general = [error.response.data.message];
                    this.messages.email = error.response.data.errors.email;
                    this.messages.password = error.response.data.errors.password;
                }
            };
            store.dispatch(LOGIN, params);
        }
    }
}
</script>
