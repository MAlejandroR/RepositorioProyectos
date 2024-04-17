<script setup>
import {Head} from '@inertiajs/vue3';
import Login from "@/Pages/Auth/Login.vue";
import { defineProps  } from "vue";
import DropDownLang from "@/Components/DropDown-lang.vue";
import {__} from "@/Hooks/useTranslation.js";
import RegisterModal from "@/Pages/Auth/RegisterModal.vue";
import {ref} from "vue";

const showModal=ref(false);

const datos = defineProps({
    translate: Object,
    list_of_lang: Object,
});
console.log ("Listado de lenguajes "+datos.list_of_lang)

console.log (`Wellcome.vue l-17 showmodal ${showModal.value}`)
function updateShowModal(newValue){
    console.log(`En Welcome update show modal a ${newValue}`)
    showModal.value=newValue;
}
</script>
<template>
    <RegisterModal :visible="showModal" @update:visible="showModal = $event" />

    <Head title="Proyectos"/>
    <div class="flex flex-row sm:flex-row h-screen w-screen">
        <div class="w-2/3 flex justify-center items-center p-10 rounded rounded-2xl
                bg-hero-pattern bg-cover bg-no-repeat bg-center h-screen">

            <div class="backdrop-brightness-50 p-5 rounded rounded-2xl bg-black/30">
                <h1 class="text-6xl font-bold bg-clip-text
                text-transparent bg-gradient-to-r from-start via-middle to-end">

                    {{ __("Project Repository") }}

                </h1>
            </div>
        </div>
        <div class="w-1/3 h-screen flex flex-col justify-start
         items-center bg-white rounded-3xl p-5">
            <div class="self-stretch flex justify-end">
                <DropDownLang :list_of_lang=list_of_lang />
            </div>
            <div class=" p-5 mb-10">
                <img class="w-3/4" src="/images/logo.png" alt="logo Enlaces">
            </div>

            <div class=" flex justify-center items-center h-full">


                <div class="shadow-2xl h-4/6 bg-white p-10 rounded-lg">
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
