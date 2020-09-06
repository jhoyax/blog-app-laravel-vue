<template>
    <form method="POST" action="/comments" class="form__comment">
        <div class="form__group">
            <textarea 
                class="form__field" 
                v-model="fields.content" 
                required 
                placeholder="Write Comment" 
                rows="3"></textarea>
            <messages-list :items="messages.content"/>
        </div>
        <div class="form__group form__actions-comment">
            <button
                type="submit"
                @click.prevent="handleSubmit"
            >Submit</button>
            <messages-list :items="messages.general" :isSuccess="isSuccess"/>
        </div>
    </form>
</template>
<script>
import MessagesList from './MessagesList';
import commentable from '../mixins/commentable';

const store = require('../store/').default;
const {COMMENT_STORE} = require('../store/action-types');

export default {
    name: 'CommentForm',
    mixins: [commentable],
    components: {
        MessagesList
    },
    data() {
        return {
            messages: {
                general: [],
                content: []
            },
            fields: {
                content: ''
            },
            isSuccess: false
        }
    },
    methods: {
        handleSubmit() {
            let params = {
                commentableType: this.commentableType,
                commentableId: this.commentableId,
                content: this.fields.content,
                successCb: res => {
                    // reset
                    Object.assign(this.$data, this.$options.data.apply(this));
                    
                    this.messages.general = [this.$t('success')];
                    this.isSuccess = true;
                },
                errorCb: error => {
                    this.isSuccess = false;

                    this.messages.general = [error.response.data.message];
                    this.messages.content = error.response.data.errors.content;
                }
            };
            store.dispatch(COMMENT_STORE, params);
        }
    }
}
</script>
