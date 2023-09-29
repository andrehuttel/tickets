<script>
  // Import Swiper Vue.js components
  import { Swiper, SwiperSlide } from 'swiper/vue';

  // Import Swiper styles
  import 'swiper/css';
  import 'swiper/css/effect-fade';
  import 'swiper/css/pagination';
  import 'swiper/css/navigation';

  // import required modules
  import { Autoplay, EffectFade, Pagination, Navigation } from 'swiper/modules';
  import { ref } from 'vue';

  export default {
    components: {
      Swiper,
      SwiperSlide,
    },
    setup() {
      const titleValue = ref('');
      const subtitleValue = ref('');
      const onSwiper = (swiper) => {
        const currentSlide = swiper.slides[swiper.activeIndex];
        titleValue.value = currentSlide.querySelector('.swiper-text h1').textContent;
        subtitleValue.value = currentSlide.querySelector('.swiper-text p').textContent;
        
      };
      const onSlideChange = (swiper) => {
        const currentSlide = swiper.slides[swiper.activeIndex];
        titleValue.value = currentSlide.querySelector('.swiper-text h1').textContent;
        subtitleValue.value = currentSlide.querySelector('.swiper-text p').textContent;
      };
      return {
        onSwiper,
        onSlideChange,
        titleValue,
        subtitleValue,
        modules: [Autoplay, EffectFade, Pagination, Navigation],
      };
    },
    props: {
      primaryColor: String,
      secondColor: String,
      data: Object,
      eventsQtd: String,
    },
    computed: {
      limitedBanners() {
        return this.data.banners.slice(0, this.eventsQtd);
      },
    },
  };
</script>

<template>
  <div class="bg-gray-100">
    <div class="flex justify-center items-center">
      <div class="container py-8 mx-auto">
        <div class="flex flex-wrap -m-4">
          <swiper
            :centeredSlides="true"
            :effect="'fade'"
            @swiper="onSwiper"
            @slideChange="onSlideChange"
            :autoplay="{
              delay: 4000,
              disableOnInteraction: false,
            }"
            :pagination="{
              clickable: true,
            }"
            :navigation="true"
            :modules="modules"
            class="mySwiper"
            :style="{ '--swiper-navigation-color': secondColor ?? primaryColor ?? 'background-green', '--swiper-theme-color': secondColor ?? primaryColor ?? 'background-green' }"
          >
            <swiper-slide  v-for="(banner, index) in limitedBanners" :key="banner.id" class="p-4 bg-gray-100"><img class="rounded" :href="banner.link" :src="banner.image">
              <div class="swiper-text xs:hidden md:block"><h1 class="text-3xl font-semibold">{{ banner.title }}</h1><br><p>{{ banner.subtitle }}</p></div>
            </swiper-slide>
          </swiper>
          <div class="swiper-text-xs items-center xs:block md:hidden">
            <h1 class="text-lg font-semibold text-center">{{ titleValue }}</h1><p class="text-center text-xs pt-1">{{ subtitleValue }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.background-green{
    background-color: rgb(0, 155, 114);
}
:root {
  --swiper-navigation-size: 32px;
}

body {
  background: #eee;
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
  font-size: 14px;
  color: #000;
  margin: 0;
  padding: 0;
}

.swiper {
  width: 100%;
  height: 100%;
  max-height: 490px !important;
  max-width: 1280px !important;
}

.swiper-slide {
  text-align: center;
  font-size: 18px;

  display: flex;
  justify-content: center;
  align-items: center;
}

.swiper-slide img {
  display: block;
  width: 100%;
  max-width: 100% !important;
}

.swiper-text{
  width: 30%;
  margin-right: 30px;
}

.swiper-text-xs {
  flex-direction: column;
  width: 100%; /* Ocupa toda a largura */
  margin-right: 0; /* Remove a margem */
}

.swiper .swiper-button-prev {
  left: 20px !important;
  margin-top: -15px !important;
}

.swiper .swiper-button-next {
  right: 20px !important;
  margin-top: -15px !important;
}

.swiper-pagination {
  bottom: 20px !important;
} 

@media (max-width: 1280px) {
  .swiper-pagination {
    bottom: 30px !important;
  } 
  :root{
    --swiper-navigation-size: 24px;
  }
  .swiper .swiper-button-prev {
    left: 20px !important;
  }

  .swiper .swiper-button-next {
    right: 20px !important;
  }
}
</style>