<script setup>
import {usePage} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import {defineProps} from "vue";
import {__} from "@/Hooks/useTranslation.js";

const datos = defineProps({
    translate: Object,
    list_of_lang: Object,
    departaments: Array
});

const user = usePage().props.user
const list_of_lang = usePage().props.list_of_lang;

const departaments = usePage().props.departaments;


</script>


<template>
    <AppLayout title="Repositorio Proyectos">
        <template #header>-->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __("Project repository administration") }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
