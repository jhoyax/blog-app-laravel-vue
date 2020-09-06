<template>
    <form method="POST" action="/login">
        <div class="form__group">
            <p class="form__title">{{ $t('login') }}</p>
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
                @click.prevent="handleSubmit"
            >{{ $t('login') }}</button>
            <messages-list :items="messages.general" :isSuccess="isSuccess"/>
        </div>
        <div class="form__group form__group--center">
            {{ $t('no_account_yet') }}
            <a href="#" @click.prevent="handleShowRegisterForm">{{ $t('register_here') }}</a>
        </div>
    </form>
</template>

<script>
import MessagesList from './MessagesList';
import { eventBus } from '../services/eventBus';

const store = require('../store/').default;
const {LOGIN} = require('../store/action-types');

export default {
    name: 'LoginForm',
    components: {
        MessagesList
    },
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
        handleSubmit() {
            let params = {
                email: this.fields.email,
                password: this.fields.password,
                successCb: res => {
                    // reset
                    Object.assign(this.$data, this.$options.data.apply(this));
                    
                    this.messages.general = [this.$t('success')];
                    this.isSuccess = true;
                    eventBus.$emit('userLoggedIn', true);
                    
                    if(this.$route.name !== 'home'){
                        // redirect to home
                        this.$router.push({name: 'home'});
                    }
                },
                errorCb: error => {
                    this.isSuccess = false;

                    this.messages.general = [error.response.data.message];
                    this.messages.email = error.response.data.errors.email;
                    this.messages.password = error.response.data.errors.password;
                }
            };
            store.dispatch(LOGIN, params);
        },
        handleShowRegisterForm() {
            eventBus.$emit('showRegisterForm')
        }
    }
}
</script>
