<script>
  // Import Swiper Vue.js components
  import { Swiper, SwiperSlide } from 'swiper/vue';

  // Import Swiper styles
  import 'swiper/css';

  import 'swiper/css/pagination';
  import 'swiper/css/navigation';

  // import required modules
  import { Autoplay, Pagination, Navigation } from 'swiper/modules';

  export default {
    components: {
      Swiper,
      SwiperSlide,
    },
    setup() {
      return {
        modules: [Autoplay, Pagination, Navigation],
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
            <swiper-slide  v-for="(banner, index) in limitedBanners" :key="banner.id" class="p-4 bg-gray-100"><img class="" :src="banner.image"><!--<div class="px-4"><h1>TESTE IMAGEM</h1><p>aqui vai a descrição desse evento.<br>Dia: xx/xx/xxxx Horário: xx:xx<br>Local: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx--></swiper-slide>
          </swiper>
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
  --swiper-navigation-size: 32px; /* To edit the size of the arrows */
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

  /* Center slide text vertically */
  display: flex;
  justify-content: center;
  align-items: center;
  /* max-width: 800px !important; */
}

.swiper-slide img {
  display: block;
  width: 100%;
  object-fit: cover;
  max-width: 100% !important;
  background-size: cover;
  /* max-width: 800px !important; */
}

.swiper .swiper-button-prev {
  left: 20px !important;
  margin-top: 0px !important;
}

.swiper .swiper-button-next {
  right: 20px !important;
  margin-top: 0px !important;
}

@media (max-width: 768px) {
  .swiper-pagination {
    bottom: 20px !important;
  } 
  :root{
    --swiper-navigation-size: 24px;
  }
  .swiper .swiper-button-prev {
    left: 20px !important;
    margin-top: 15px !important;
  }

  .swiper .swiper-button-next {
    right: 20px !important;
    margin-top: 15px !important;
  }
}
</style>