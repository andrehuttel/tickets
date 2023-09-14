<script setup>
    import { ref } from 'vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import ApplicationMark from '@/Components/ApplicationMark.vue';
    import Banner from '@/Components/Banner.vue';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import NavLink from '@/Components/NavLink.vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

    defineProps({
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        data: Object,
        title: String,
        primaryColor: String,
    });
    // const { canLogin, canRegister, laravelVersion, phpVersion, data, title } = defineProps([
    //     'canLogin',
    //     'canRegister',
    //     'laravelVersion',
    //     'phpVersion',
    //     'data',
    // ]);
    // const logout = () => {
    //     router.post(route('logout'));
    // };
    // console.log(data);
    // const companyConfigs = data.company.configs;

    // let primaryColor = null;
    // let secondColor = null;

    // const primaryColorObject = companyConfigs.find(config => config.key === 'primary_color');
    // const secondColorObject = companyConfigs.find(config => config.key === 'second_color');

    // if (primaryColorObject !== undefined) {
    //     primaryColor = primaryColorObject.value;
    // }
    // if (secondColorObject !== undefined) {
    //     secondColor = secondColorObject.value;
    // }
    let mobileMenuOpen = false;

    function toggleMobileMenu() {
        console.log(this.mobileMenuOpen);
        this.mobileMenuOpen = !this.mobileMenuOpen;
    }

    defineExpose({ mobileMenuOpen, toggleMobileMenu });
</script>

<template>
    <div>
        <Head :title="title" />

        <div class="relative">
            <nav class="bg-green-400 border-green-400 dark:bg-green-900 fixed top-0 left-0 right-0 z-50" :style="{ backgroundColor: primaryColor ? primaryColor : '' }">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <div class="flex items-center block flex flex-wrap pb-1 lg:mx-0 mx-auto">
                        <a :href="route('home')" class="flex items-center">
                            <img src="/images/logo-gototem.png" class="h-8 mr-3" alt="Flowbite Logo" />
                        </a>
                    </div>
                    <div class="flex items-center mx-auto md:ml-8">
                        <form>
                            <div id="search" class="relative w-full h-full">
                                <input type="search" id="search-dropdown" class="block p-2.5 w-80 h-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Pesquise por eventos...">
                                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white rounded-r-lg focus:outline-none">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" :style="{ color: primaryColor ? primaryColor : '' }" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="flex items-center md:order-2">
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <Link :href="route('login')" class="font-semibold text-white-600 hover:text-white-900 dark:text-white-400 text-white dark:hover:text-white">Ajuda</Link>
                            </div>
                            <div class="ml-3 relative">
                                <div v-if="$page.props.auth.user">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <button type="button" class="font-semibold text-white-600 hover:text-white-900 dark:text-white-400 text-white dark:hover:text-white inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white text-white-500 hover:text-white-700 focus:outline-none focus:bg-white-50 active:bg-white-50 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}
                                                <svg class="ml-1 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </template>

                                        <template #content>
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Account
                                            </div>

                                            <DropdownLink :href="route('profile.show')">
                                                Profile
                                            </DropdownLink>

                                            <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                                API Tokens
                                            </DropdownLink>

                                            <div class="border-t border-gray-200" />

                                            <!-- Authentication -->
                                            <form @submit.prevent="logout">
                                                <DropdownLink as="button">
                                                    Log Out
                                                </DropdownLink>
                                            </form>
                                        </template>
                                    </Dropdown>
                                </div>
                                <template v-else>
                                    <Link :href="route('login')" class="font-semibold text-white-600 hover:text-white-900 dark:text-white-400 text-white dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Entrar</Link>

                                    <!-- <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link> -->
                                </template>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div v-if="mobileMenuOpen" class="bg-white absolute top-0 left-0 right-0 h-screen flex flex-col items-center justify-center z-40">
                    <Link :href="route('login')" class="font-semibold text-gray-800 hover:text-gray-900 text-xl mb-6">Entrar</Link>
                    <Link :href="route('help')" class="font-semibold text-gray-800 hover:text-gray-900 text-xl">Ajuda</Link>
                </div>
                <button @click="toggleMobileMenu" class="block flex flex-wrap items-center pb-2 justify-between mx-auto sm:hidden text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </nav>
        </div>
    </div>
</template>
