<script setup>
import {Head, Link, usePage} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref, defineProps, onMounted, Transition} from "vue";
import DropDownLang from "@/Components/DropDown-lang.vue";
import {useTranslationStore} from "@/stores/translationsStore.js";
import {useTitleStore} from "@/stores/titleStore.js";
import { watchEffect } from 'vue';
import { computed } from 'vue';
const translationStore = useTranslationStore()  ;
const titleStore = useTitleStore()  ;




const translateFn = computed(() => {
    return (key) => translationStore.translations[key] || key;
});

const titleFn= computed(()=>{
    return  titleStore.title
})


watchEffect(() => {
    console.log("1.- Welcome.vue. Analizando reactividad en "+
        translationStore.translations); // Verás esto cada vez que las traducciones cambien
    const valores = translationStore.translations;
    console.log("2.- Welcome.vue. Analizando reactividad en valores "+valores);
    console.log("3.- Welcome.vue. Analizando reactividad en valores "+valores['Project Repository']);

    // Verás esto cada vez que las traducciones cambien

});


const datos = defineProps({
    // canLogin: Boolean,
    // canRegister: Boolean,
    translate: Object,
    list_of_lang: Object,
});
console.log ("Listado de lenguajes "+datos.list_of_lang)
function __(text) {
    return translationStore.translations[text] || text; // Devuelve la clave como fallback

    // console.log("indice " + text);
    // const palabra = datos.translate[text];
    // console.log("PAlabra " + palabra);
    // return palabra;
}
</script>
<template>
    <Head title="Proyectos"/>
    <div class="flex flex-row sm:flex-row h-screen w-screen">
        <div class="w-2/3 flex justify-center items-center p-10 rounded rounded-2xl
                bg-hero-pattern bg-cover bg-no-repeat bg-center h-screen">

            <div class="backdrop-brightness-50 p-5 rounded rounded-2xl bg-black/30">
                <h1 class="text-6xl font-bold bg-clip-text
                text-transparent bg-gradient-to-r from-start via-middle to-end">
<!--                    {{  translateFn("Project Repository")}}-->
                        {{titleFn}}

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
                    <form>
                        <div class="form-control mt-4">
                            <InputLabel class="text-xl ">
                                <span class="label-text">  {{ translateFn('Email') }}</span>
                            </InputLabel>
                            <TextInput type="email" placeholder="email"
                                       class="input input-bordered text-xl" required/>
                        </div>
                        <div class="form-control mt-4">
                            <InputLabel class="text-xl">
                                <span class="label-text">{{ __("Password") }}</span>
                            </InputLabel>
                            <TextInput type="password" placeholder="password" class="input input-bordered" required/>
                            <InputLabel class="label">
                                <a href="#" class="label-text-alt link link-hover">{{ __("Forgot password?") }}</a>
                            </InputLabel>
                        </div>
                        <div class="form-control mt-6">
                            <PrimaryButton class="btn btn-primary">{{ __("Login") }}</PrimaryButton>
                        </div>
                    </form>
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
