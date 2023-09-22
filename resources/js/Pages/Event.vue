<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import Nav from '@/Pages/Nav.vue';
import Footer from '@/Pages/Footer.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const { canLogin, canRegister, laravelVersion, phpVersion, data, event, searchButtonMenu } = defineProps([
    'canLogin',
    'canRegister',
    'laravelVersion',
    'phpVersion',
    'data',
    'event',
    'searchButtonMenu'
]);

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

function backgroundStyle() {
    return backgroundImage = url('https://d2hnilqqbw3vnf.cloudfront.net/images/imagens/full/mCteMLfK1gxdLahIe5j8qdcB0yYg2K0r2F0QOu2o.jpeg');
}

defineExpose({ primaryColor, secondColor, storeTitle });
</script>

<template class="bg-green-500">
    <!-- <Head title="Evento"></Head> -->
    <!-- <Head :title="event.name ? `${event.name}` : ''"></Head> -->
    <Head :title="event.name ? event.name + ' - ' + storeTitle : storeTitle" />
    <!-- <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>

        <template v-else>
            <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>

            <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
        </template>
    </div> -->

    <!-- <template> -->
    <AppLayout :data="data" :searchButtonMenu="searchButtonMenu">
    <main>
        <div class="container-fluid background-image mt-10 pb-8" :style="{
                        'background-color': primaryColor || '',
                        'background-image': primaryColor
                        ? `linear-gradient(${primaryColor}, rgba(0, 0, 0, 0.8)), url(${event.image})`
                        : `linear-gradient(#FFFFFF, rgba(0, 0, 0, 0.8)), url(${event.image})`
                    }">
            <!-- Image gallery -->
            <div class="container mx-auto w-full max-w-screen-xl lg:max-h-[400px]">
                <div class="mt-6 lg:grid lg:grid-cols-4 lg:gap-4 px-4 pt-24">
                    <div class="col-span-2 lg:col-span-2 aspect-h-4 aspect-w-6 lg:block lg:max-h-[320px] object-scale-down">
                        <img :src="event.image" :alt="event.name" class="h-80 lg:h-full w-full rounded object-cover object-center">
                    </div>
                    <div class="lg:col-span-2 lg:pr-8 max-h-[320px] flex flex-col">
                        <h1 class="text-2xl font-bold tracking-tight text-white text-white-900 sm:text-3xl mt-10">{{ event.name }}</h1>
                        <div class="flex items-center flex-wrap">
                            <span class="text-1xl font-bold text-white text-white-900 mr-1 inline-flex items-center mt-3 leading-none pr-1 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                {{ formatDate(event.date) }}
                            </span>
                        </div>
                        <div class="flex items-center flex-wrap">
                            <span class="text-1xl font-bold text-white text-white-900 mr-1 inline-flex items-center leading-none pr-1 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                    Abertura: {{ event.place_open_hour }} 
                            </span>
                            <span class="text-1xl font-bold text-white text-white-900 inline-flex items-center leading-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Inicio: {{ event.start_hour }}
                            </span>
                        </div>
                        <div class="flex items-center flex-wrap">
                            <span class="text-1xl font-bold text-white text-white-900 mr-1 inline-flex items-center leading-none pr-1 py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            {{ event.place_name }}
                            </span>
                        </div>
                        <div class="lg:flex items-center mt-auto">
                            <button class="rounded-full py-2 xs:mt-4 xs:font-sm xs:text-xs xs:px-6 lg:text-base px-12 mr-4 text-white xs:w-full" :style="{ backgroundColor: primaryColor ? primaryColor : '' }">Comprar Ingressos</button>
                            <div class="flex mt-4 sm:justify-center lg:mt-0 w-full xs:w-full">
                                <div class="flex items-center space-x-5 lg:pt-5">
                                    <div>
                                        <p class="text-white font-bold lg:pl-8 pr-3">Compartilhe</p>
                                    </div>
                                    <a :href="'https://api.whatsapp.com/send?phone=&text=' + data.company.name + ' - ' + event.name + ' - ' + $page.props.ziggy.location" class="text-white text-white-400 hover:text-white-900 dark:hover:text-white flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                        </svg>
                                        <span class="sr-only">Whatsapp</span>
                                    </a>
                                    <a :href="'https://www.facebook.com/sharer/sharer.php?s=100&p[url]=&p[summary]=&p[title]=&p[images][0]=&u=' + $page.props.ziggy.location" class="text-white text-white-400 hover:text-white-900 dark:hover:text-white flex items-center">
                                        <svg class="w-4 h-4 mr-1" height="1em" viewBox="0 0 512 512" style="fill: #fff;">
                                            <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/>
                                        </svg>
                                        <span class="sr-only">Facebook</span>
                                    </a>
                                    <a :href="'https://twitter.com/intent/tweet?source=tweetbutton&text=' + data.company.name + ' - ' + event.name + ' - ' + $page.props.ziggy.location" class="text-white text-white-400 hover:text-white-900 dark:hover:text-white flex items-center">
                                        <svg class="w-4 h-4 mr-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 17">
                                            <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="sr-only">Twitter</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container mx-auto w-full max-w-screen-xl">
            <!-- Product info -->
            <div class="mx-auto max-w-2xl px-4 pb-8 pt-4 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-4">
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ event.name }}</h1>
                    <div class="mt-4 text-sm text-gray-900" v-html="event.description"></div>
                    <div class="mt-4 text-sm text-gray-900" v-html="event.description_append"></div>
                </div>

                <!-- Options -->
                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <div class="">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl" :style="{ color: primaryColor ? primaryColor : '' }">Local do Evento</h1>
                        <p class="text-black font-bold mt-4">{{ event.place }}</p>
                        <p class="text-black mt-4">{{ event.place_address }}</p>
                        <div class="mt-4">
                            <a :href="'https://www.google.com/maps/place/' + event.place_address" target="_blank" class="rounded-full py-2 px-12 mr-4 text-white" :style="{ backgroundColor: primaryColor ? primaryColor : '' }">Ver no Mapa</a>
                        </div>
                    </div>

                    <div v-if="event.fl_show_classification == true" class="mt-8">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl" :style="{ color: primaryColor ? primaryColor : '' }">Classificação</h1>
                        <p class="text-black mt-4">{{ event.classification_text }}</p>
                    </div>

                    <div v-if="event.fl_show_payment_methods == true" class="mt-8">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl" :style="{ color: primaryColor ? primaryColor : '' }">Formas de Pagamento</h1>
                        <p class="text-black mt-4">{{ event.payment_methods }}</p>
                        <ul class="flex space-x-1">
                            <li class="icon-payment flex justify-center items-center">
                                <img src="/images/icon_payments/visa.png" class="content-center w-40 h-30" alt="Visa">
                            </li>
                            <li class="icon-payment flex justify-center items-center">
                                <img src="/images/icon_payments/mastercard.png" class="content-center w-40 h-30" alt="Mastercard">
                            </li>
                            <li class="icon-payment flex justify-center items-center">
                                <img src="/images/icon_payments/elo.png" class="content-center w-40 h-30" alt="Elo">
                            </li>
                            <li class="icon-payment flex justify-center items-center">
                                <img src="/images/icon_payments/american_express.png" class="content-center w-40 h-30" alt="American Express">
                            </li>
                            <li class="icon-payment flex justify-center items-center">
                                <img src="/images/icon_payments/cabal.png" class="content-center w-40 h-30" alt="Cabal">
                            </li>
                            <li class="icon-payment flex justify-center items-center">
                                <img src="/images/icon_payments/dinners.png" class="content-center w-40 h-30" alt="Dinner's Club">
                            </li>
                            <li class="icon-payment flex justify-center items-center">
                                <img src="/images/icon_payments/hipercard.png" class="content-center w-40 h-30" alt="Hipercard">
                            </li>
                            <li class="icon-payment flex justify-center items-center">
                                <img src="/images/icon_payments/boleto.png" class="content-center w-40 h-30" alt="Boleto">
                            </li>
                            <li class="icon-payment flex justify-center items-center">
                                <img src="/images/icon_payments/pix.png" class="content-center w-40 h-30" alt="Pix">
                            </li>
                        </ul>
                        <!-- <button type="submit" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add to bag</button> -->
                    </div>
                </div>

                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                    <div class="mt-8 space-y-6">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl" :style="{ color: primaryColor ? primaryColor : '' }">Mapa do Local</h1>
                        <div class="col-span-2 lg:col-span-2 aspect-h-4 aspect-w-6 lg:block">
                            <img src="/images/mapa_evento.jpg" :alt="event.name">
                        </div>
                    </div>
                    <div v-if="event.fl_show_organizer == true">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl mt-8" :style="{ color: primaryColor ? primaryColor : '' }">Organizador</h1>
                        <div class="mt-8 flex items-center space-x-6">
                            <img :src="event.organizer_logo" :alt="event.organizer_name" class="h-20 rounded">
                            <div>
                                <p class="text-gray-600 font-bold md:text-2xl">{{ event.organizer_name }}</p>
                                <div class="lg:flex items-center mt-auto">
                                <div class="flex mt-4 lg:mt-0 w-full xs:w-full">
                                    <div class="flex items-center space-x-2 lg:pt-5">
                                        <!-- <a :href="event.organizer_instagram" class="text-black text-black-400 hover:text-black-900 dark:hover:text-black flex items-center">
                                            <svg class="w-4 h-4 mr-1" height="1em" viewBox="0 0 448 512">
                                                <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                                            <span class="sr-only">Instagram</span>
                                        </a>
                                        <a :href="event.organizer_facebook" class="text-black text-black-400 hover:text-black-900 dark:hover:text-black flex items-center">
                                            <svg class="w-4 h-4 mr-1" height="1em" viewBox="0 0 512 512">
                                                <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/>
                                            </svg>
                                            <span class="sr-only">Facebook</span>
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    </AppLayout>

</template>

<style>
.icon-payment{
    /* display: inline-block; */
    width: 40px;
    height: 30px;
    background: #fff;
    box-shadow: 0 0 5px rgba(0,0,0,.3);
    overflow: hidden;
}
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
input:focus {
    box-shadow: 0 0 0 0;
    outline: 0;
}

.background-image {
    /* position: absolute; */
    background-color: var(rgb(34, 197, 94));
    background-repeat: no-repeat;
    background-size: cover;
    height: 100%;
    width: 100%;
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>