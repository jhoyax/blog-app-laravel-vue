<template>
    <div class="slider">
        <div :class="addActiveClass('slider__item', item.active)" v-for="(item, index) in sliderItems" :key="index">
            <img :src="item.image" class="slider__item-image"/>
            <div class="slider__item-text">
                <span>{{item.title}}</span>
                <time :datetime="item.date">{{$formatter('dashToDot', item.date)}}</time>
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
import { eventBus } from '../services/eventBus';

export default {
    name: 'Slider',
    data() {
        return {
            sliderItems: []
        }
    },
    mounted() {
        eventBus.$on('fetchedPost', (data) => {
            if (this.sliderItems.length === 0) {
                this.sliderItems = data.splice(0, 3).map((post, index) => {
                    post.active = (index === 0 ? true : false);
                    return post;
                });
            }
        });
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
