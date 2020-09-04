<template>
    <fragment>
        <app-header/>
        <router-view/>
        <app-footer/>
    </fragment>
</template>

<script>
import { Fragment } from 'vue-fragment';
import AppHeader from './components/Header';
import AppFooter from './components/Footer';

export default {
    name: 'App',
    components: {
        Fragment,
        AppHeader,
        AppFooter
    }
}
</script>
