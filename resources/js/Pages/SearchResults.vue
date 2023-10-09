<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed, watch, watchEffect } from 'vue';
import Pagination from '@/Components/Pagination.vue';
import { Inertia } from '@inertiajs/inertia';
import debounce from "lodash/debounce";
import { onMounted } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';

const { canLogin, canRegister, laravelVersion, phpVersion, data, event, searchButtonMenu, filter, events } = defineProps([
    'canLogin',
    'canRegister',
    'laravelVersion',
    'phpVersion',
    'data',
    'event',
    'searchButtonMenu',
    'filter',
    'events'
]);

const companyConfigs = data.company.configs;
const items = events.data;

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

let search = ref(filter === null ? '' : filter);


const handleSearchInput = debounce(async (value) => {
    value = value.target.value.toString();
    console.log('Valor da pesquisa:', value);

    try {
        const response = await Inertia.get(route('buscar'), { q: value }, { preserveState: true, replace: true });
        console.log('Resposta do servidor:', response);
        
        if (response && response.status === 200) {
            console.log('Sucesso! A resposta do servidor:', response);
        } else {
            console.error('Resposta inesperada do servidor:', response);
        }
    } catch (error) {
        if (!error.response || error.response.status !== 409) {
            console.error('Erro ao fazer a chamada Inertia.get():', error);
        }
    }
}, 300);

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

<template class="bg-green-500">
    <Head :title="'Busca - ' + storeTitle">
        <link rel="icon" :href="data.faviconUrl.value" type="image/x-icon">
    </Head>

    <AppLayout :data="data" :searchButtonMenu="searchButtonMenu">
    
    <div class="bg-gray-100">
        <div class="flex justify-center items-center">
            <div class="max-w-7xl w-full lg:mt-32 xs:mt-12">
                <section class="text-gray-600 body-font">
                    <div class="container lg:px-5 md:px-4 px-2">
                        <div class="flex flex-wrap lg:-m-4 mt-8">
                            <div class="p-4 -pr-4 lg:w-2/4 lg:w-2/4">
                                <h1 class="text-black font-bold xs:text-lg md:text-2xl">Procure por um evento:</h1>
                                <div class="flex items-center mx-auto mt-2 mb-2">
                                    <div id="search" class="relative w-full h-full">
                                        <InputLabel label="Pesquise por eventos...">
                                        <input
                                            class="custom-focus block p-2.5 w-80 xs:w-full h-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg rounded-r-lg border border-gray-300 dark:bg-gray-700 dark:border-l-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                            type="text"
                                            id="buscar"
                                            @input="handleSearchInput"
                                            :value="search"
                                        />
                                        </InputLabel>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="bg-gray-100">
        <div class="flex justify-center items-center">
            <div class="max-w-7xl w-full">
                <section class="text-gray-600 body-font">
                    <div class="container md:px-5 py-8 lg:py-24 mx-auto">
                        <div class="flex flex-wrap -m-4">
                            <div v-if="items.length !== 0" v-for="ev in items" :key="ev.id" class="p-4 sm:w-2/4 lg:w-1/4">
                                <a :href="route('event.show', { category: ev.category_uri, uri: ev.uri })">
                                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                    <img class="lg:h-48 lg:h-36 w-full object-cover object-center" :src="ev.image" :alt="ev.name">
                                    <div class="p-6 pb-1">
                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ ev.name }}</h1>
                                        <div class="flex items-center flex-wrap">
                                            <span class="text-black mr-1 inline-flex items-center mb-3 leading-none pr-1 py-1" :style="{ color: primaryColor ?? 'black' }">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                </svg>
                                                {{ formatDate(ev.date) }}
                                            </span>
                                        </div>
                                        <div class="flex items-center flex-wrap">
                                            <span class="text-gray-400 mr-1 inline-flex items-center leading-none text-xs pr-1 py-1" :style="{ color: primaryColor ?? 'black' }">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Abertura: {{ ev.place_open_hour }} 
                                            </span>
                                            <span class="text-gray-400 inline-flex items-center leading-none text-xs" :style="{ color: primaryColor ?? 'black' }">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Inicio: {{ ev.start_hour }}
                                            </span>
                                        </div>
                                        <div class="flex items-center flex-wrap">
                                            <span class="text-black mr-1 inline-flex items-center leading-none text-xs pr-1 py-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                            </svg>
                                            {{ ev.place_name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div v-else class="md:m-4 md:-mt-10 xs:m-0 xs:mt-2 xs:mb-24">
                                <h1 class="font-bold text-lg">Nenhum evento encontrado.</h1>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <Pagination :data="events" :primaryColor="primaryColor" />

    </AppLayout>

</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
[type='text']:focus{
    box-shadow: none !important;
    outline: none !important;
}
.custom-focus {
    outline: none !important; /* Remove a borda de foco padrão (contorno) */
    border: none !important; /* Remove a borda */
    border-color: transparent !important; /* Define a cor da borda como transparente */
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
