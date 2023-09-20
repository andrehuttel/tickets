<script setup>
import Slider from '@/Pages/Slider.vue';
// import Footer from '@/Pages/Footer.vue';
import Nav from '@/Pages/Nav.vue';
import Footer from '@/Pages/Footer.vue';
import CarouselBanner from '@/Pages/CarouselBanner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
//import { Carousel, Slide } from "vue-carousel";
// import Carousel from '@/Pages/Carousel.vue';

const { canLogin, canRegister, laravelVersion, phpVersion, data, searchButtonMenu } = defineProps([
    'canLogin',
    'canRegister',
    'laravelVersion',
    'phpVersion',
    'data',
    'searchButtonMenu',
]);
const logout = () => {
    router.post(route('logout'));
};
const companyConfigs = data.company.configs;
const events = data.events;

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
    const parts = string.split(' ');
    if (parts.length >= 3) {
        parts[0] = parts[0].charAt(0).toUpperCase() + parts[0].slice(1);
        parts[3] = parts[3].charAt(0).toUpperCase() + parts[3].slice(1);
        return parts.join(' ');
    }
    return string;
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
    <div>
        <Head :title="title" />

        <Nav :data="data" :primaryColor="primaryColor" :searchButtonMenu="searchButtonMenu" />

        <main>
            <slot />
        </main>

        <Footer :data="data" :primaryColor="primaryColor" />
    </div>
</template>
