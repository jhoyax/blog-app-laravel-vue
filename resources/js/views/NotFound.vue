<template>
    <main>
        <breadcrumb :links="breadCrumbLinks" v-if="showChildren"/>
        <section class="container">
            <div class="section__header">
                <h1>{{ $t('404') }}</h1>
            </div>
            <div class="section__content">
                <p>{{ $t('404_description') }}</p>
            </div>
        </section>
    </main>
</template>
<script>
import Breadcrumb from '../components/Breadcrumb';
import authOptions from '../mixins/authOptions';

export default {
    name: 'NotFound',
    mixins: [authOptions],
    components: {
        Breadcrumb
    },
    data() {
        return {
            breadCrumbLinks: [
                {
                    title: this.$t('404')
                }
            ]
        }
    }
}
</script>
