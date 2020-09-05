<template>
    <form method="POST" action="/posts">
        <div class="form__group form__actions">
            <a href="#" @click.prevent="handleSave">{{ $t('save_post') }}</a>
            <a href="#" @click.prevent="handleCancel">{{ $t('cancel') }}</a>
        </div>
        <div class="form__group">
            <time datetime="2020-02-20">2020.02.20</time>
        </div>
        <div class="form__group">
            <textarea 
                class="form__field form__title" 
                v-model="fields.title" 
                required 
                :placeholder="$t('title')" 
                rows="3"></textarea>
            <messages-list :items="messages.title"/>
        </div>
        <div class="form__group form__file-upload" :style="uploadedImage">
            <input type="file" class="form__field" required accept="image/*" @change="handleFileChange" :style="fileUploadBackground"/>
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

export default {
    name: 'PostForm',
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
            uploadedImageURL: ''
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
    methods: {
        handleCancel() {
            this.$emit('cancelEdit');
        },
        handleSave() {

        },
        handleFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            console.log(files);
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
