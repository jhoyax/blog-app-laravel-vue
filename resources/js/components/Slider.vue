<template>
    <div class="slider">
        <div :class="addActiveClass('slider__item', item.active)" v-for="(item, index) in sliderItems" :key="index">
            <img :src="item.image" class="slider__item-image"/>
            <div class="slider__item-text">
                <span>{{item.title}}</span>
                <time :datetime="item.date">{{$dashToDot(item.date)}}</time>
            </div>
        </div>
        <a href="#" 
            @click.prevent="handleNextSlider(-1)" 
            class="slider__arrow slider__arrow--left"><div class="arrow arrow--left"></div></a>
        <a href="#" 
            @click.prevent="handleNextSlider(1)" 
            class="slider__arrow slider__arrow--right"><div class="arrow arrow--right"></div></a>
        <div class="slider__pagination">
            <a href="#" 
                @click.prevent="handlePagination(index)"
                :class="addActiveClass('slider__pagination-item', item.active)" 
                v-for="(item, index) in sliderItems" 
                :key="index"></a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Slider',
    data() {
        return {
            sliderItems: [
                {
                    image: '/img/slider/slider1.jpg',
                    title: 'Title Here 1',
                    date: '2019-06-19',
                    active: false
                },
                {
                    image: '/img/slider/slider2.jpg',
                    title: 'Title Here 2',
                    date: '2019-06-20',
                    active: false
                },
                {
                    image: '/img/slider/slider3.jpg',
                    title: 'サンプルテキストサンプルテキストサンプルテキスト',
                    date: '2019-06-21',
                    active: true
                }
            ]
        };
    },
    methods: {
        addActiveClass(className, active = false) {
            if(active) {
                className += ' ' + className + '--active';
            }
            return className;
        },
        handleNextSlider(action) {
            let activeIndex = 0;
            let totalIndex = this.sliderItems.length - 1;

            this.sliderItems.map((el, index) => {
                if (el.active === true) {
                    activeIndex = index;
                }
            });

            activeIndex += action;

            if (activeIndex > totalIndex) {
                activeIndex = 0;
            }
            if (activeIndex === -1) {
                activeIndex = totalIndex;
            }

            this.handlePagination(activeIndex);
        },
        handlePagination(page) {
            this.sliderItems = this.sliderItems.map((el, index) => {
                el.active = page === index ? true : false;
                return el;
            });
        }
    }
}
</script>
