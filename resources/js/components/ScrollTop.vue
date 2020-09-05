<template>
    <a href="#" @click.prevent="handleClick" :class="'scroll--top ' + showScroll">
        <div class="arrow arrow--up"></div>
        <span>Top</span>
    </a>
</template>

<script>
export default {
    name: 'ScrollTop',
    data() {
        return {
            show: false
        }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    computed: {
        showScroll() {
            return this.show ? 'scroll--show' : '';
        }
    },
    methods: {
        handleScroll() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                this.show = true;
            } else {
                this.show = false;
            }
        },
        handleClick() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    }
}
</script>
