<template>
    <fragment>
        <app-header/>
        <router-view/>
    </fragment>
</template>

<script>
import {Fragment} from 'vue-fragment';
import AppHeader from './components/Header';

export default {
    name: 'App',
    components: {
        AppHeader,
        Fragment
    }
}
</script>
