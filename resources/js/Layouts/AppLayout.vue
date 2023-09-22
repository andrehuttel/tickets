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

let primaryColor = null;
let secondColor = null;

const primaryColorObject = companyConfigs.find(config => config.key === 'STORE_TPL_PRIMARY_COLOR');
const secondColorObject = companyConfigs.find(config => config.key === 'STORE_TPL_SECONDARY_COLOR');

if (primaryColorObject !== undefined) {
    primaryColor = primaryColorObject.value;
}
if (secondColorObject !== undefined) {
    secondColor = secondColorObject.value;
}

defineExpose({ primaryColor, secondColor });
</script>

<template>
    <div>
        <Nav :data="data" :primaryColor="primaryColor" :secondColor="secondColor" :searchButtonMenu="searchButtonMenu" />

        <main>
            <slot />
        </main>

        <Footer :data="data" :primaryColor="primaryColor" />
    </div>
</template>
