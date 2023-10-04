<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const { canLogin, canRegister, laravelVersion, phpVersion, data, searchButtonMenu, faviconUrl } = defineProps([
    'canLogin',
    'canRegister',
    'laravelVersion',
    'phpVersion',
    'data',
    'searchButtonMenu',
    'faviconUrl',
]);

const companyConfigs = data.company.configs;

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
    <Head :title="'Sobre nós - ' + storeTitle">
        <link rel="icon" :href="data.faviconUrl.value" type="image/x-icon">
    </Head>

    <AppLayout :data="data" :searchButtonMenu="searchButtonMenu">

    
    <div class="container-fluid background-image" :style="{'background-color': primaryColor || ''}">
        <div class="flex justify-center items-center title-category">
            <div class="max-w-7xl w-full">
                <div class="container px-5 pt-8 lg:pt-none mx-auto">
                    <div class="pb-20"></div>
                    <h1 class="text-3xl font-semibold text-white">Sobre nós</h1>
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
                            <div v-if="getValue(data.config, 'STORE_CMS_ABOUT_US')" v-html="getValue(data.config, 'STORE_CMS_ABOUT_US')" class="w-full min-h-screen mt-6 overflow-hidden" />
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
