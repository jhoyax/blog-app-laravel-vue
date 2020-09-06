<template>
    <form method="POST" action="/posts">
        <div class="form__group form__actions">
            <div>
                <a href="#" @click.prevent="handleSave">{{ $t('save_post') }}</a>
                <a href="#" @click.prevent="handleCancel">{{ $t('cancel') }}</a>
            </div>
            <messages-list :items="messages.general" :isSuccess="isSuccess"/>
        </div>
        <div class="form__group">
            <time datetime="2020-02-20">2020.02.20</time>
        </div>
        <div class="form__group">
            <textarea 
                class="form__field form__field-title" 
                v-model="fields.title" 
                required 
                :placeholder="$t('title')" 
                rows="3"></textarea>
            <messages-list :items="messages.title"/>
        </div>
        <div class="form__group form__file-upload" :style="uploadedImage">
            <input type="file" class="form__field" required accept=".jpg, .png, .gif" @change="handleFileChange" :style="fileUploadBackground"/>
            <label>{{ $t('upload_image') }}</label>
        </div>
        <div class="form__group">
            <messages-list :items="messages.image"/>
        </div>
        <div class="form__group">
            <textarea 
                class="form__field" 
                v-model="fields.content" 
                required 
                :placeholder="$t('content')" 
                rows="15"></textarea>
            <messages-list :items="messages.content"/>
        </div>
    </form>
</template>
<script>
import MessagesList from './MessagesList';
import singlePost from '../mixins/singlePost';

const store = require('../store/').default;
const {POST_STORE, POST_UPDATE} = require('../store/action-types');

export default {
    name: 'PostForm',
    mixins: [singlePost],
    components: {
        MessagesList
    },
    data() {
        return {
            messages: {
                general: [],
                title: [],
                image: [],
                content: [],
            },
            fields: {
                title: '',
                image: null,
                content: '',
            },
            isSuccess: false,
            uploadedImageURL: '',
            holdPost: this.post
        }
    },
    computed: {
        uploadedImage() {
            return this.uploadedImageURL.length ? "background-image:url('" + this.uploadedImageURL + "');" : '';
        },
        fileUploadBackground() {
            return this.uploadedImageURL.length ? "background-color:unset;" : '';
        }
    },
    mounted() {
        if (this.post.hasOwnProperty('id')) {
            this.fields.title = this.post.title;
            this.fields.content = this.post.content;
            this.uploadedImageURL = this.post.image || '';
        }
    },
    methods: {
        handleCancel() {
            if (this.post.hasOwnProperty('id')) {
                this.$emit('cancelEdit', JSON.parse(JSON.stringify(this.holdPost)));
            } else {
                if(this.$route.name !== 'home'){
                    // redirect to home
                    this.$router.push({name: 'home'});
                }
            }
        },
        handleSave() {
            if (this.post.hasOwnProperty('id')) {
                this.updatePost();
            } else {
                this.storePost();
            }
        },
        storePost() {
            let params = {
                title: this.fields.title,
                content: this.fields.content,
                image: this.fields.image,
                successCb: res => {
                    // reset
                    Object.assign(this.$data, this.$options.data.apply(this));
                    
                    this.messages.general = [this.$t('success')];
                    this.isSuccess = true;
                },
                errorCb: error => {
                    this.isSuccess = false;

                    this.messages.general = [error.response.data.message];
                    this.messages.title = error.response.data.errors.title;
                    this.messages.content = error.response.data.errors.content;
                    this.messages.image = error.response.data.errors.image;
                }
            };
            store.dispatch(POST_STORE, params);
        },
        updatePost() {
            let params = {
                id: this.post.id,
                title: this.fields.title,
                content: this.fields.content,
                image: this.fields.image,
                successCb: res => {
                    this.messages.general = [this.$t('success')];
                    this.isSuccess = true;
                    this.holdPost = res.data.data;
                    
                    this.handleCancel();
                },
                errorCb: error => {
                    this.isSuccess = false;

                    this.messages.general = [error.response.data.message];
                    this.messages.title = error.response.data.errors.title;
                    this.messages.content = error.response.data.errors.content;
                    this.messages.image = error.response.data.errors.image;
                }
            };
            store.dispatch(POST_UPDATE, params);
        },
        handleFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            
            this.fields.image = files[0];

            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.uploadedImageURL = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
}
</script>
