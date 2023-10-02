<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const { canLogin, canRegister, laravelVersion, phpVersion, data, searchButtonMenu, faviconUrl, events } = defineProps([
    'canLogin',
    'canRegister',
    'laravelVersion',
    'phpVersion',
    'data',
    'events',
    'searchButtonMenu',
    'faviconUrl',
]);

const companyConfigs = data.company.configs;

let primaryColor = null;
let secondColor = null;
let storeTitle = null;

const primaryColorObject = companyConfigs.find(config => config.key === 'STORE_TPL_PRIMARY_COLOR');
const secondColorObject = companyConfigs.find(config => config.key === 'STORE_TPL_SECONDARY_COLOR');
const storeTitleObject = companyConfigs.find(config => config.key === 'STORE_TITLE');

if (primaryColorObject !== undefined) {
    primaryColor = primaryColorObject.value;
}
if (secondColorObject !== undefined) {
    secondColor = secondColorObject.value;
}
if (storeTitleObject !== undefined) {
    storeTitle = storeTitleObject.value;
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

function getValue(array, key) {
    for (let i = 0; i < array.length; i++) {
        if (array[i].key === key) {
            return array[i].value;
        }
    }
    return null;
}

defineExpose({ primaryColor, secondColor, storeTitle });
</script>

<template class="bg-green-100">
    <Head :title="'Meia Entrada - ' + storeTitle">
        <link rel="icon" :href="data.faviconUrl" type="image/x-icon">
        <meta name="description" :content="data.faviconUrl" />
    </Head>

    <AppLayout :data="data" :searchButtonMenu="searchButtonMenu">

    
    <div class="container-fluid background-image" :style="{'background-color': primaryColor || ''}">
        <div class="flex justify-center items-center title-category">
            <div class="max-w-7xl w-full">
                <div class="container px-5 pt-8 lg:pt-none mx-auto">
                    <div class="pb-20"></div>
                    <h1 class="text-3xl font-semibold text-white">Meia Entrada</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-100">
        <div class="flex justify-center items-center min-h-screen">
            <div class="max-w-7xl w-full">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-8 lg:pb-24 lg:pt-8 mx-auto">
                        <div class="flex flex-wrap">
                            <div v-if="getValue(data.config, 'STORE_CMS_HALF_ENTRY')" v-html="getValue(data.config, 'STORE_CMS_HALF_ENTRY')" class="w-full w-2/3 mb-4" />
                            <div class="w-full md:w-1/3 mb-4">
                                <div class="w-full min-h-screen overflow-hidden">
                                    <div>
                                        <ul class="text-white-500 text-gray-900 dark:text-white-400 font-medium border-b border-gray-900">
                                            <li v-if="getValue(data.config, 'STORE_CMS_TERMS_OF_USE_FL_SHOW') == true" class="mb-4">
                                                <a :href="route('footer.showTermsOfUse')" class="hover:underline">Termos de Uso</a>
                                            </li>
                                            <li v-if="getValue(data.config, 'STORE_CMS_PRIVACY_POLICY_FL_SHOW') == true" class="mb-4">
                                                <a :href="route('footer.showPrivacyPolicy')" class="hover:underline">Política de Privacidade</a>
                                            </li>
                                            <li v-if="getValue(data.config, 'STORE_CMS_SERVICE_TAX_FL_SHOW') == true" class="mb-4">
                                                <a :href="route('footer.showServiceTax')" class="hover:underline">Taxa de Serviço</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <h1 class="mt-2 mb-4 text-black text-3xl" :style="{ color: primaryColor ? primaryColor : '' }">Próximos Eventos</h1>
                                    <div v-for="event in events" :key="event.id" class="mb-4 mt-6">
                                        <a :href="route('event.show', { category: event.category_uri, uri: event.uri })">
                                            <div class="flex mb-2">
                                                <div class="w-1/3">
                                                    <img :src="event.image" alt="Imagem do Evento" class="w-full h-auto rounded">
                                                </div>
                                                <div class="w-2/3 ml-4">
                                                    <h1 class="title-font text-md font-medium text-gray-900 mb-1">{{ event.name }}</h1>
                                                    <div class="flex items-center flex-wrap">
                                                        <span class="text-xs text-black mr-1 inline-flex items-center leading-none pr-1" :style="{ color: primaryColor ?? 'black' }">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                            </svg>
                                                            {{ formatDate(event.date) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
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
.title-category{
    min-height: 200px;
}
</style>
