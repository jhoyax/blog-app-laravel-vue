<template>
    <main>
        <breadcrumb :links="breadCrumbLinks"/>
        <section class="container">
            <post-form :post="{}"/>
        </section>
    </main>
</template>
<script>
import Breadcrumb from '../components/Breadcrumb';
import PostForm from '../components/PostForm';

export default {
    name: 'CreatePost',
    components: {
        Breadcrumb,
        PostForm
    },
    data() {
        return {
            breadCrumbLinks: [
                {
                    title: this.$t('create_new_post')
                }
            ]
        }
    }
}
</script>
