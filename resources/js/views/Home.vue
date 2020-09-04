<template>
    <main>
        <slider/>
        <news/>
    </main>
</template>
<script>
import Slider from '../components/Slider';
import News from '../components/News';

export default {
    name: 'Home',
    components: {
        Slider,
        News
    }
}
</script>
