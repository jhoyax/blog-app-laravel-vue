<template>
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><router-link :to="{ name: 'home' }">{{ $t('home') }}</router-link></li>
                <li v-for="(item, index) in links" :key="index">
                    <a :href="item.link" v-if="index === links.length-1">{{item.title}}</a>
                    <span v-else>{{item.title}}</span>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Breadcrumb',
    props: {
        links: {
            type: Array,
            default: []
        },
    }
}
</script>
