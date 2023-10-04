<script setup>
    import { ref } from 'vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

    defineProps({
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        data: Object,
        title: String,
        primaryColor: String,
        secondColor: String,
        searchButtonMenu: Boolean,
    });

    const showingNavigationDropdown = ref(false);

    function getValue(array, key) {
        for (let i = 0; i < array.length; i++) {
            if (array[i].key === key) {
                return array[i].value;
            }
        }
        return null;
    }

    const logout = () => {
        router.post(route('logout'));
    };

</script>

<template>
    <div>
        <Head :title="title" />

        <div class="relative">
            <nav class="background-green fixed top-0 left-0 right-0 z-50" :style="{ backgroundColor: primaryColor ? primaryColor : '' }">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <div class="flex items-center block flex flex-wrap pb-1 lg:mx-0">
                        <a :href="route('/')" class="flex items-center">
                            <img :src="getValue(data.config, 'STORE_TPL_LOGO')" class="mr-3 md:h-auto xs:h-10" :alt="getValue(data.config, 'STORE_TITLE')" />
                        </a>
                    </div>
                    <!-- Hamburger -->
                    <div class="flex items-center sm:hidden mx-auto mr-0">
                        <div v-if="searchButtonMenu" class="flex sm:hidden xs:block mx-auto md:ml-8 mr-0">
                            <div class="mr-4">
                                <a :href="route('buscar')" class="relative top-0 right-0 p-2.5 text-sm font-medium h-full text-white rounded-r-lg focus:outline-none">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </a>
                            </div>
                        </div>
                        <button title="Menu" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-blue-500 hover:bg-blue-500 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" @click="showingNavigationDropdown = ! showingNavigationDropdown" :style="{ backgroundColor: primaryColor ? primaryColor : '' }">
                            <svg
                                class="h-6 w-6"
                                stroke="#fff"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                    <div v-if="searchButtonMenu" class="flex items-center xs:hidden sm:block mx-auto md:ml-8 mt-2">
                        <form :action="route('buscar')" method="GET">
                            <div id="search" class="relative w-full h-full">
                                <input type="text" id="search-dropdown" name="q" class="custom-focus block p-2.5 w-80 h-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Pesquise por eventos...">
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
                                            <!-- <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Account
                                            </div> -->

                                            <DropdownLink :href="route('profile.show')">
                                                Profile
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
                                    <Link :href="route('login')" class="font-semibold text-white-600 hover:text-white-900 dark:text-white-400 text-white dark:hover:text-white">Entrar</Link>

                                    <!-- <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Register</Link> -->
                                </template>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <!-- <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div> -->

                    <!-- Responsive Settings Options -->
                    <div class="border-t border-gray-200" :style="{ backgroundColor: '#fff' }">
                        <div class="flex flex-col items-center px-4">
                            <div>
                                <Link :href="route('login')" class="font-semibold text-white-600 hover:text-white-900 dark:text-white-400 text-white dark:hover:text-white" :style="{ color: primaryColor ? primaryColor : '' }">Ajuda</Link>
                            </div>
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                            </div>
                            <div>
                                <div v-if="$page.props.auth.user" class="font-medium text-base text-gray-800">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div v-else class="mt-2">
                                    <Link :href="route('login')" class="font-semibold text-white-600 hover:text-white-900 dark:text-white-400 text-white dark:hover:text-white" :style="{ color: primaryColor ? primaryColor : '' }">Entrar</Link>
                                </div>
                                <div v-if="$page.props.auth.user" class="font-medium text-sm text-gray-500">
                                    {{ $page.props.auth.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink v-if="$page.props.auth.user" :href="route('profile.show')" :active="route().current('profile.show')">
                                Profile
                            </ResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" v-if="$page.props.auth.user" @submit.prevent="logout">
                                <ResponsiveNavLink as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>
<style>
.background-green{
    background-color: rgb(0, 155, 114);
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
</style>