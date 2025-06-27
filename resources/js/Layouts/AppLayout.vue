<script setup>
import { ref,defineProps } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {__} from "@/Hooks/useTranslation.js";
import DropDownLang from "@/Components/DropDown-lang.vue";
import FooterHead from "@/Components/FooterHead.vue";
import TopMenu from "@/Components/TopMenu.vue";


const {title, lang, list_of_lang}=defineProps({
    title: String,
    lang : String,
    list_of_lang: Object
});

// const list_of_lang = usePage().props.list_of_lang;
const rol = usePage().props.rol;
// const lang = usePage().props.lang
const showingNavigationDropdown = ref(false);


console.log(`App layout Valor de lang ${lang}`);
console.log(`App-Layout Valor de list_of_lang `);
console.log(list_of_lang);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    console.log("en logout")
    router.post(route('logout'));
};
</script>

<template>
    <div class="h-full">
        <Head :title="title" />
        <TopMenu />
       <!-- <NavHead />-->
       <div class="min-h-screen bg-gray-300 dark:bg-gray-900 w-screen">


           <nav class="h-11v bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700
flex flex-row justify-between items-center w-screen p-6">
                <!-- Primary Navigation Menu -->
<!--                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">-->

                            <!-- Logo -->
<!--                            <div class="shrink-0">-->
                                <a href="https://cpilosenlaces.com/">
                                    <ApplicationMark class="block h-12 w-auto" />
                                </a>
<!--                            </div>-->

                            <!-- Navigation Links -->
<!--                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">-->
<!--                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">-->
<!--                                    {{ __("Main page") }}-->
<!--                                </NavLink>-->
<!--                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">-->
<!--                                    {{ __("Main page") }}-->
<!--                                </NavLink>-->
<!--                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">-->
<!--                                    {{ __("Main page") }}-->
<!--                                </NavLink>-->
<!--                            </div>-->


                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                     <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{__("Manage Account")}}
                                        </div>

                                        <DropdownLink :href="route('profile.show')">
                                            {{__("Profile")}}
                                        </DropdownLink>



                                        <div class="border-t border-gray-200 dark:border-gray-600" />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                    {{__("Log Out")}}
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                            <div class="ms-3 relative">
<!--                                <Dropdown align="right" width="48">-->
<!--                                    <template #trigger>-->
<!--                                        <button class="flex text-sm border-2-->
<!--                                         border-transparent rounded-full focus:outline-none-->
<!--                                         focus:border-gray-300 transition">-->

                                            <DropDownLang :list_of_lang="list_of_lang" :lang="lang" />

<!--                                        </button>-->


<!--                                    </template>-->


<!--                                </Dropdown>-->
                            </div>
                        </div>

<!--                </div>-->

                <!-- Responsive Navigation Menu -->
              </nav>

<!--            {{__("Type of user")}} : {{rol}}-->
                <header v-if="$slots.header" class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
