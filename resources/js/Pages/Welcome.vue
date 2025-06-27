<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import Login from "@/Pages/Auth/Login.vue";
import { defineProps, onMounted } from "vue";
import DropDownLang from "@/Components/DropDown-lang.vue";
import Register from "@/Pages/Auth/Register.vue";
import { ref } from "vue";
import { __ } from "@/Hooks/useTranslation.js";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Banner from "@/Components/Banner.vue";
import { useTranslationStore } from '@/stores/translationsStore'; // 👈 Correcto


const showModal = ref(false);

const {translate, list_of_lang, lang}=usePage().props;

const datos = defineProps({
    departaments: Array
    }
);


// console.log("sessiones " + usePage().flash);
// console.log("Departamentos  " + datos.departaments);
// console.log("Listado de lenguajes ");
 console.log( "datos");
 console.log( datos);
// console.log(`Wellcome.vue l-17 showmodal ${showModal.value}`);
// console.log(datos.translate);

const translationStore = useTranslationStore(); // 👈 Muy importante, crear la instancia

// 👇 cuando el componente se monte
onMounted(() => {
    if (translate) {
        console.log("Actualizando store de traducciones");
         translationStore.updateTranslations(translate);
    } else {
        console.log("datos.translate está vacío o undefined");
    }
});


function updateShowModal(newValue) {
    console.log(`En Welcome update show modal a ${newValue}`);
    showModal.value = newValue;
}

// const lang = usePage().props.lang;


</script>

<template>
    <Register :departaments="departaments" :visible="showModal" @update:visible="showModal = $event" />
    <Head title="Proyectos"/>
    <Banner />

    <div class="flex flex-col sm:flex-row h-screen w-screen">
        <div class="w-full sm:w-2/3 flex justify-center items-center p-10 rounded-2xl
                bg-hero-pattern bg-cover bg-no-repeat bg-center h-1/2 sm:h-screen">
            <div class="backdrop-brightness-50 p-5 rounded-2xl bg-black/30">
                <h1 class="text-4xl sm:text-6xl font-bold bg-clip-text
                text-transparent bg-gradient-to-r from-start via-middle to-end">
                    {{ __("Project Repository") }}
                </h1>
            </div>
        </div>
        <div class="w-full sm:w-1/3 h-1/2 sm:h-screen flex flex-col justify-start
         items-center bg-gray-100 rounded-3xl p-5">
            <div class="self-stretch flex justify-between">
                <img class="w-1/2" src="/images/logo.png" alt="logo Enlaces">
                <DropDownLang :list_of_lang="list_of_lang" :lang="lang" />
            </div>

            <div class="flex justify-center items-center h-full">
                <div class="shadow-2xl w-full bg-white p-5 sm:p-10 rounded-lg">
                    <Login :showModal="showModal" @update:showModal="updateShowModal"/>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
