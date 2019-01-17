
<template>
    <div>
                                
        <swiper :options="swiperOption">
            <swiper-slide v-for="(image, index) in images" :key="index">
                <div class="single-article-thumbnail my-10">
                    <img class="block w-full" :src="`${basePublicUrl}images/${image.large}`" >
                </div>
            </swiper-slide>
        <div class="swiper-pagination" slot="pagination"></div>
      </swiper>
        
    </div>
</template>


<script>

import { swiper, swiperSlide } from 'vue-awesome-swiper';

export default {
    props: ['images'],
    data () {
        return {
            basePublicUrl: Laravel.basePublicUrl,
            swiperOption: {
            slidesPerView: 'auto',
            centeredSlides: true,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
                }
            }
        }
    },
    components: {
        swiper,
        swiperSlide
    }
}
</script>