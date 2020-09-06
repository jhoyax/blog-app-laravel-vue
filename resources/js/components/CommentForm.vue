<template>
    <form method="POST" action="/comments" class="form__comment">
        <div class="form__group">
            <textarea 
                class="form__field" 
                v-model="fields.comment" 
                required 
                placeholder="Write Comment" 
                rows="3"></textarea>
            <messages-list :items="messages.title"/>
        </div>
        <div class="form__group form__actions">
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
export default {
    name: 'CommentForm',
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

        }
    }
}
</script>
