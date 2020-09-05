<template>
    <fragment>
        <app-header/>
        <router-view/>
        <app-footer/>
        <scroll-top/>
    </fragment>
</template>

<script>
import { Fragment } from 'vue-fragment';
import AppHeader from './components/Header';
import AppFooter from './components/Footer';
import ScrollTop from './components/ScrollTop';

export default {
    name: 'App',
    components: {
        Fragment,
        AppHeader,
        AppFooter,
        ScrollTop
    }
}
</script>
