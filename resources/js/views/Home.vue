<template>
    <fragment>
        <slider v-if="showChildren"/>
        <news/>
    </fragment>
</template>

<script>
import { Fragment } from 'vue-fragment';
import News from '../components/News';
import Slider from '../components/Slider';
import authOptions from '../mixins/authOptions';

export default {
    name: 'Home',
    mixins: [authOptions],
    components: {
        Fragment,
        Slider,
        News
    }
}
</script>
