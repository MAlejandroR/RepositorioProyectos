<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import {__} from "@/Hooks/useTranslation.js";
import {defineProps} from "vue";
import NavLink from "@/Components/NavLink.vue";
import SidebarArea from '@/Components/Sidebar/SidebarArea.vue'
import Sidebar from "@/Components/Dashboard/Sidebar.vue";
import Footer from "@/Components/Dashboard/Footer.vue";
import Header from "@/Components/Dashboard/Header.vue";
import Main from "@/Components/Dashboard/Main.vue";
const datos = defineProps({
    translate: Object,
    list_of_lang: Object,
    models: Object
});
</script>

<!-- resources/js/Pages/Index.vue -->
<template>
    <AppLayout>
        <div class="flex h-screen">
            <!-- Sidebar -->
            <Sidebar class="w-1/4 bg-gray-100 p-4 shadow-lg" />

            <!-- Main content -->

            <div class="flex flex-col w-3/4">
                <Header class="shadow-md p-4 bg-white" />

                <Main class="flex-grow flex items-center justify-center">
                    <!-- Centered role-based image -->

                    <div class="text-center">
                        <img src="images/admin.jpeg" alt="User Role Image" class="w-48 h-48 object-cover rounded-full shadow-lg border-4 border-gray-300">
                        <h2 class="mt-4 text-2xl font-bold text-gray-700 capitalize">{{ role }}</h2>
                    </div>
                </Main>
                <Footer class="p-4 bg-gray-100 text-center text-sm text-gray-600" />
            </div>
        </div>
    </AppLayout>
</template>
<style scoped>
/* Aquí puedes añadir estilos específicos para este componente */
</style>
