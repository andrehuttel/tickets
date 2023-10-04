<script setup>
import CarouselBanner from '@/Pages/CarouselBanner.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const { canLogin, canRegister, laravelVersion, phpVersion, data, searchButtonMenu } = defineProps([
    'canLogin',
    'canRegister',
    'laravelVersion',
    'phpVersion',
    'data',
    'searchButtonMenu',
]);

const companyConfigs = data.company.configs;
const events = data.events;
const events_featured = data.events_featured;

let primaryColor = null;
let secondColor = null;
let storeTitle = null;
let storeMetaDescription = null;

const primaryColorObject = companyConfigs.find(config => config.key === 'STORE_TPL_PRIMARY_COLOR');
const secondColorObject = companyConfigs.find(config => config.key === 'STORE_TPL_SECONDARY_COLOR');
const storeTitleObject = companyConfigs.find(config => config.key === 'STORE_TITLE');
const storeMetaDescriptionObject = companyConfigs.find(config => config.key === 'STORE_META_DESCRIPTION');

if (primaryColorObject !== undefined) {
    primaryColor = primaryColorObject.value;
}
if (secondColorObject !== undefined) {
    secondColor = secondColorObject.value;
}
if (storeTitleObject !== undefined) {
    storeTitle = storeTitleObject.value;
}
if (storeMetaDescriptionObject !== undefined) {
    storeMetaDescription = storeMetaDescriptionObject.value;
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
    
    return capitalizeFirstLetter(dateFormatted).replace('.', '');
}

function getValue(array, key) {
    for (let i = 0; i < array.length; i++) {
        if (array[i].key === key) {
            return array[i].value;
        }
    }
    return null;
}

onMounted(() => {
  const descriptionMeta = document.createElement('meta');
  descriptionMeta.name = 'description';
  descriptionMeta.content = storeMetaDescription;

  const existingDescriptionMeta = document.querySelector('meta[name="description"]');
  if (existingDescriptionMeta) {
    existingDescriptionMeta.remove();
  }
  document.head.appendChild(descriptionMeta);
});

defineExpose({ primaryColor, secondColor, storeTitle });
</script>

<template class="bg-green-100">
    <Head :title="'Home - ' + storeTitle">
        <link rel="icon" :href="data.faviconUrl.value" type="image/x-icon">
    </Head>

    <AppLayout :data="data" :searchButtonMenu="searchButtonMenu">

    <CarouselBanner v-if="getValue(data.config, 'STORE_TPL_FL_SHOW_FEAT_EVENTS') == true" :data="data" :primaryColor="primaryColor" :secondColor="secondColor" :eventsQtd="getValue(data.config, 'STORE_TPL_FEAT_EVENTS_QTY')" />
    <div class="bg-gray-100">
        <div class="flex justify-center items-center min-h-screen">
            <div class="max-w-7xl w-full">
                <section class="text-gray-600 body-font">
                    <div class="container md:px-5 py-8 lg:pb-24 lg:pt-8 mx-auto">
                        <div class="flex flex-wrap -m-4">
                            <div v-for="event in events_featured" :key="event.id" class="p-4 sm:w-2/4 lg:w-1/4">
                                <a :href="route('event.show', { category: event.category_uri, uri: event.uri })">
                                    <div class="h-full shadow-2xl rounded-lg overflow-hidden">
                                        <img class="object-cover object-center" :src="event.image" :alt="event.name">
                                        <div class="p-6">
                                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ event.name }}</h1>
                                            <div class="flex items-center flex-wrap">
                                                <span class="text-black mr-1 inline-flex items-center mb-3 leading-none pr-1 py-1" :style="{ color: primaryColor ?? 'black' }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                    </svg>
                                                    {{ formatDate(event.date) }}
                                                </span>
                                            </div>
                                            <div class="flex items-center flex-wrap">
                                                <span class="text-gray-400 mr-1 inline-flex items-center leading-none text-xs pr-1 py-1" :style="{ color: primaryColor ?? 'black' }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Abertura: {{ event.place_open_hour }} 
                                                </span>
                                                <span class="text-gray-400 inline-flex items-center leading-none text-xs" :style="{ color: primaryColor ?? 'black' }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Inicio: {{ event.start_hour }}
                                                </span>
                                            </div>
                                            <div class="flex items-center flex-wrap">
                                                <span class="text-black mr-1 inline-flex items-center leading-none text-xs pr-1 py-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                                </svg>
                                                {{ event.place_name }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-wrap -m-4">
                            <div v-for="event in events" :key="event.id" class="p-4 sm:w-2/4 lg:w-1/4">
                                <a :href="route('event.show', { category: event.category_uri, uri: event.uri })">
                                    <div class="h-full shadow-2xl rounded-lg overflow-hidden">
                                        <img class="object-cover object-center" :src="event.image" :alt="event.name">
                                        <div class="p-6">
                                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ event.name }}</h1>
                                            <div class="flex items-center flex-wrap">
                                                <span class="text-black mr-1 inline-flex items-center mb-3 leading-none pr-1 py-1" :style="{ color: primaryColor ?? 'black' }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                    </svg>
                                                    {{ formatDate(event.date) }}
                                                </span>
                                            </div>
                                            <div class="flex items-center flex-wrap">
                                                <span class="text-gray-400 mr-1 inline-flex items-center leading-none text-xs pr-1 py-1" :style="{ color: primaryColor ?? 'black' }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Abertura: {{ event.place_open_hour }} 
                                                </span>
                                                <span class="text-gray-400 inline-flex items-center leading-none text-xs" :style="{ color: primaryColor ?? 'black' }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Inicio: {{ event.start_hour }}
                                                </span>
                                            </div>
                                            <div class="flex items-center flex-wrap">
                                                <span class="text-black mr-1 inline-flex items-center leading-none text-xs pr-1 py-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                                </svg>
                                                {{ event.place_name }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    </AppLayout>

</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
input:focus {
    box-shadow: 0 0 0 0;
    outline: 0;
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
