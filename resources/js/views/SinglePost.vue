<template>
    <main>
        <breadcrumb :links="breadCrumbLinks"/>
        <section class="container">
            <post-form v-if="edit" v-on:cancelEdit="handleCancelEdit"/>
            <post-display v-else v-on:editPost="handleEditPost"/>
        </section>
        <div class="container">
            <hr/>
        </div>
        <comment/>
    </main>
</template>
<script>
import Breadcrumb from '../components/Breadcrumb';
import PostForm from '../components/PostForm';
import PostDisplay from '../components/PostDisplay';
import Comment from '../components/Comment';

export default {
    name: 'SinglePost',
    components: {
        Breadcrumb,
        PostForm,
        PostDisplay,
        Comment
    },
    data() {
        return {
            edit: false,
            breadCrumbLinks: [
                {
                    title: 'サンプルテキストサンプルテキストサンプルテキスト'
                }
            ]
        }
    },
    methods: {
        handleEditPost() {
            this.edit = true;
        },
        handleCancelEdit() {
            this.edit = false;
        }
    }
}
</script>
