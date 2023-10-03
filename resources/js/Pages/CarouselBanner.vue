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
  <div class="bg-gray-100" :style="{ backgroundColor: primaryColor ? primaryColor : '' }">
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
            :navigation="true"
            :modules="modules"
            class="mySwiper"
            :style="{ '--swiper-navigation-color': secondColor ?? primaryColor ?? 'background-green', '--swiper-theme-color': secondColor ?? primaryColor ?? 'background-green' }"
          >
            <swiper-slide  v-for="(banner, index) in limitedBanners" :key="banner.id" class="p-4" :style="{ backgroundColor: primaryColor ? primaryColor : '' }">
              <a :href="banner.link">
                <img class="rounded" :href="banner.link" :src="banner.image">
                <div class="swiper-text md:block text-left text-white">
                  <h1 class="lg:text-3xl xs:text-lg font-semibold">{{ banner.title }}</h1>
                  <p class="lg:text-lg xs:text-xs mt-4">{{ banner.subtitle }}</p>
                  <button class="rounded-full py-2 xs:mt-4 xs:font-sm xs:text-xs xs:px-6 lg:text-base px-12 mr-4 text-white"
                      :style="{ backgroundColor: (secondColor || primaryColor || 'background-green') }">
                      Ver Detalhes 
                  </button>
                </div>
              </a>
            </swiper-slide>
          </swiper>
          <!-- <div class="swiper-text-xs items-center xs:block md:hidden">
            <h1 class="text-lg font-semibold text-center">{{ titleValue }}</h1><p class="text-center text-xs pt-1">{{ subtitleValue }}</p>
          </div> -->
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

.mySwiper .swiper-slide {
  text-align: center;
  font-size: 18px;
}

.mySwiper .swiper-text{
  width: 30%;
  /* margin-right: 50px; */
  margin-left: 50px;
  margin-top: -250px !important;
  float: right;
}

.swiper-text-xs {
  flex-direction: column;
  width: 100%; /* Ocupa toda a largura */
  margin-right: 0; /* Remove a margem */
  color: white;
}

.swiper-pagination {
  bottom: 20px !important;
} 

@media (min-width: 1280px) { 
  .mySwiper .swiper-slide img {
    display: block;
    width: 70%;
    max-width: 800px !important;
    max-height: 300px !important;
    margin-left: 50px !important;
  }

  .swiper .swiper-button-prev {
    left: 20px !important;
    margin-top: -15px !important;
  }

  .swiper .swiper-button-next {
    right: 20px !important;
    margin-top: -15px !important;
  }
}

@media (max-width: 1280px) { 
  .mySwiper .swiper-text{
    width: 100%;
    /* margin-right: 50px; */
    margin-left: 0px;
    margin-top: 5px !important;
    float: none;
    text-align: center;
  }

  .mySwiper .swiper-slide img {
    margin: auto;
  }
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
    margin-top: -80px !important;
  }

  .swiper .swiper-button-next {
    right: 20px !important;
    margin-top: -80px !important;
  }
}
</style>