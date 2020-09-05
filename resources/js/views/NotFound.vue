<template>
    <main>
        <breadcrumb :links="links"/>
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

export default {
    name: 'NotFound',
    components: {
        Breadcrumb
    },
    data() {
        return {
            links: [
                {
                    title: this.$t('404')
                }
            ]
        }
    }
}
</script>
