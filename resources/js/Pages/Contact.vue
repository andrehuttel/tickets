<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';

const { canLogin, canRegister, laravelVersion, phpVersion, data, searchButtonMenu, faviconUrl } = defineProps([
    'canLogin',
    'canRegister',
    'laravelVersion',
    'phpVersion',
    'data',
    'searchButtonMenu',
    'faviconUrl',
]);

const form = ref({
    name: '',
    email: '',
    subject: '',
    message: ''
});

const successMessage = ref('');
const errorMessage = ref('');

const submitForm = async () => {
    // Limpa mensagens anteriores
    successMessage.value = '';
    errorMessage.value = '';

    try {
        const response = await axios.post('/contato/enviar-email', form.value);
        successMessage.value = response.data.message;
    } catch (error) {
        errorMessage.value = 'Erro ao enviar a mensagem. Por favor, tente novamente.';
    }
};

const logout = () => {
    router.post(route('logout'));
};
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
    <Head :title="'Contato - ' + storeTitle">
        <link rel="icon" :href="data.faviconUrl" type="image/x-icon">
        <meta name="description" :content="data.faviconUrl" />
    </Head>

    <AppLayout :data="data" :searchButtonMenu="searchButtonMenu">

    
    <div class="container-fluid background-image" :style="{'background-color': primaryColor || ''}">
        <div class="flex justify-center items-center title-category">
            <div class="max-w-7xl w-full">
                <div class="container px-5 pt-8 lg:pt-none mx-auto">
                    <div class="pb-20"></div>
                    <h1 class="text-3xl font-semibold text-white">Contato</h1>
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
                            <div v-if="getValue(data.config, 'STORE_CONTACT_FL_SHOW_FORM') == true" class="w-full min-h-screen mt-6 overflow-hidden">
                                <form @submit.prevent="submitForm" class="max-w-md">
                                    <div class="mb-4">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                                        <input type="text" id="name" v-model="form.name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" />
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                        <input type="email" id="email" v-model="form.email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" />
                                    </div>
                                    <div class="mb-4">
                                        <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">Assunto:</label>
                                        <input type="text" id="subject" v-model="form.subject" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" />
                                    </div>
                                    <div class="mb-4">
                                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Mensagem:</label>
                                        <textarea id="message" v-model="form.message" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"></textarea>
                                    </div>
                                    <button type="submit" class="bg-indigo-500 text-white hover:bg-indigo-600 py-2 px-4 rounded-md focus:outline-none" :style="{ backgroundColor: secondColor ?? primaryColor ?? '' }">Enviar</button>
                                </form>

                                <!-- Feedback ao usuário -->
                                <div v-if="successMessage" class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-md">{{ successMessage }}</div>
                                <div v-if="errorMessage" class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-md">{{ errorMessage }}</div>
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
