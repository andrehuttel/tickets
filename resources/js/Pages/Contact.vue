<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import $ from 'jquery';

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
    fone: '',
    message: ''
});

const successMessage = ref('');
const errorMessage = ref('');

$(document).ready(function() {
    const foneInput = $('#fone');

    foneInput.on('input', function() {
        const numericValue = this.value.replace(/\D/g, '');
        const formattedValue = formatPhoneNumber(numericValue);
        this.value = formattedValue;
    });

    function formatPhoneNumber(phoneNumber) {
        if (phoneNumber.length === 0) {
            return '';
        } else if (phoneNumber.length <= 2) {
            return '(' + phoneNumber;
        } else if (phoneNumber.length <= 7) {
            return '(' + phoneNumber.substr(0, 2) + ') ' + phoneNumber.substr(2);
        } else if (phoneNumber.length <= 10) {
            return '(' + phoneNumber.substr(0, 2) + ') ' + phoneNumber.substr(2, 4) + '-' + phoneNumber.substr(6);
        } else {
            return '(' + phoneNumber.substr(0, 2) + ') ' + phoneNumber.substr(2, 5) + '-' + phoneNumber.substr(7);
        }
    }
});

const submitForm = async () => {
    // Limpa mensagens anteriores
    successMessage.value = '';
    errorMessage.value = '';

    try {
        const response = await axios.post('/contato/enviar-email', form.value);
        if (response.data.message) {
            successMessage.value = response.data.message;
        } else if (response.data.errors) {
            // Mensagens de erro
            const errorMessages = Object.values(response.data.errors).flat();
            errorMessage.value = errorMessages.join('\n');
        }
    } catch (error) {
        console.error("error", error);
        errorMessage.value = 'Não foi possível enviar a mensagem. Por favor, preencha todos os campos.';
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
                            <div v-if="getValue(data.config, 'STORE_CONTACT_FL_SHOW_FORM') == true" class="w-full md:w-1/2 mb-4">
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
                                        <label for="fone" class="block text-gray-700 text-sm font-bold mb-2">Telefone:</label>
                                        <input
                                            type="text"
                                            id="fone"
                                            maxlength="15"
                                            inputmode="numeric"
                                            v-model="form.fone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                        />
                                    </div>
                                    <div class="mb-4">
                                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Mensagem:</label>
                                        <textarea id="message" v-model="form.message" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"></textarea>
                                    </div>
                                    <button type="submit" class="bg-indigo-500 text-white hover:bg-indigo-600 py-2 px-4 rounded-md focus:outline-none" :style="{ backgroundColor: secondColor ?? primaryColor ?? '' }">Enviar</button>
                                    <!-- Feedback ao usuário -->
                                    <div v-if="successMessage" class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-md">{{ successMessage }}</div>
                                    <div v-if="errorMessage" class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-md">{{ errorMessage }}</div>
                                </form>
                            </div>

                            <div class="w-full md:w-1/2 mb-4">
                                <div class="w-full min-h-screen overflow-hidden">
                                    <h1 class="text-2xl font-bold mb-4">
                                        Caso desejar, entre em contato através do email:
                                        <span>{{ getValue(data.config, 'STORE_CONTACT_EMAIL_PRIMARY') }}</span>
                                        ou através do número:
                                        <span>{{ getValue(data.config, 'STORE_CONTACT_PHONE_PRIMARY') }}</span>
                                    </h1>
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
