<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { Carousel, Slide } from "vue-carousel";

const { canLogin, canRegister, laravelVersion, phpVersion, data } = defineProps([
    'canLogin',
    'canRegister',
    'laravelVersion',
    'phpVersion',
    'data',
]);

const logout = () => {
    router.post(route('logout'));
};

const companyConfigs = data.company.configs;
const events = data.events;
const items = data.events;
console.log(items);

let primaryColor = null;
let secondColor = null;

const primaryColorObject = companyConfigs.find(config => config.key === 'primary_color');
const secondColorObject = companyConfigs.find(config => config.key === 'second_color');

if (primaryColorObject !== undefined) {
    primaryColor = primaryColorObject.value;
}
if (secondColorObject !== undefined) {
    secondColor = secondColorObject.value;
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function formatDate(data) {
    const optionsDate = { weekday: 'short', day: 'numeric', month: 'long', year: 'numeric' };
    const dateFormatted = new Date(data).toLocaleDateString('pt-BR', optionsDate);
    
    return this.capitalizeFirstLetter(dateFormatted).replace('.', '');
}
function formatTime(data) {
  const optionsTime = { hour: 'numeric', minute: 'numeric' };
  const timeFormatted = new Date(data).toLocaleTimeString('pt-BR', optionsTime);

  return timeFormatted;
}

defineExpose({ primaryColor, secondColor });
</script>

<template>
    <div class="carousel-container">
      <carousel :per-page="1" :autoplay="true" :autoplay-timeout="5000">
        <slide v-for="(item, index) in items" :key="index">
          <img :src="item.image" alt="Carousel Image" class="w-full">
        </slide>
      </carousel>
    </div>
</template>
  
<style scoped>
  .carousel-container {
    max-width: 800px; /* Defina a largura máxima desejada para o carousel */
    margin: 0 auto;
  }
</style>
  