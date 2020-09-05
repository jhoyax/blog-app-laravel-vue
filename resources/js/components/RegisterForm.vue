<template>
    <form method="POST" action="/register">
        <div class="form__group">
            <p class="form__title">{{ $t('register') }}</p>
        </div>
        <div class="form__group">
            <label>{{ $t('name') }}</label>
            <input type="text" class="form__field" v-model="fields.name" required/>
            <messages-list :items="messages.name"/>
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
            <label>{{ $t('password_confirmation') }}</label>
            <input type="password" class="form__field" v-model="fields.password_confirmation" required/>
            <messages-list :items="messages.password_confirmation"/>
        </div>
        <div class="form__group">
            <button
                type="submit"
                @click.prevent="handleSubmit"
            >{{ $t('register') }}</button>
            <messages-list :items="messages.general" :isSuccess="isSuccess"/>
        </div>
        <div class="form__group form__group--center">
            {{ $t('already_have_account') }}
            <a href="#" @click.prevent="handleShowLoginForm">{{ $t('login_here') }}</a>
        </div>
    </form>
</template>

<script>
import { bus } from '../app'
const store = require('../store/').default;
const {REGISTER} = require('../store/action-types');
import MessagesList from './MessagesList';

export default {
    name: 'RegisterForm',
    components: {
        MessagesList
    },
    data() {
        return {
            messages: {
                general: [],
                name: [],
                email: [],
                password: [],
                password_confirmation: [],
            },
            fields: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            isSuccess: false,
        }
    },
    methods: {
        handleSubmit() {
            let params = {
                name: this.fields.name,
                email: this.fields.email,
                password: this.fields.password,
                password_confirmation: this.fields.password_confirmation,
                successCb: res => {
                    // reset
                    Object.assign(this.$data, this.$options.data.apply(this));

                    this.isSuccess = true;

                    this.$router.push('/')
                },
                errorCb: error => {
                    this.isSuccess = false;

                    this.messages.general = [error.response.data.message];
                    this.messages.name = error.response.data.errors.name;
                    this.messages.email = error.response.data.errors.email;
                    this.messages.password = error.response.data.errors.password;
                    this.messages.password_confirmation = error.response.data.errors.password_confirmation;
                }
            };
            store.dispatch(REGISTER, params);
        },
        handleShowLoginForm() {
            bus.$emit('showLoginForm')
        }
    }
}
</script>
