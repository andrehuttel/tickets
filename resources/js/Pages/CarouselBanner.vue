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
      data: Object,
    },
  };
</script>

<template>
  <div class="bg-gray-500" :style="{ backgroundColor: primaryColor ? primaryColor : '' }">
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
            :style="{ '--swiper-navigation-color': primaryColor, '--swiper-theme-color': primaryColor }"
          >
            <swiper-slide class="p-4" :style="{ 'background-color': primaryColor }"><img class="" src="/images/festeja.png" alt="blog"><!--<div class="px-4"><h1>TESTE IMAGEM</h1><p>aqui vai a descrição desse evento.<br>Dia: xx/xx/xxxx Horário: xx:xx<br>Local: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
            </p></div>--></swiper-slide>
            <swiper-slide>Slide 2</swiper-slide><swiper-slide>Slide 3</swiper-slide>
            <swiper-slide>Slide 4</swiper-slide><swiper-slide>Slide 5</swiper-slide>
            <swiper-slide>Slide 6</swiper-slide><swiper-slide>Slide 7</swiper-slide>
            <swiper-slide>Slide 8</swiper-slide><swiper-slide>Slide 9</swiper-slide>
          </swiper>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
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
  background: #fff;

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