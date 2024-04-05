<script setup>
import { ref, defineProps } from 'vue';
import {useTranslationStore} from "@/stores/translationsStore.js";
import {useTitleStore} from "@/stores/titleStore.js";
import { Inertia } from '@inertiajs/inertia';

// defineProps te permite declarar las props que tu componente espera recibir.
const { lang, list_of_lang } = defineProps({
    lang: String,
    list_of_lang: Object
});

// Usar `ref` para reactividad en componentes compuestos (opcional en este caso).
const selectedLang = ref(lang);

console.log("En dropdown:", list_of_lang);

// Esta función se llama cuando un usuario selecciona un nuevo idioma.
const change_lang = async (selectedLang) => {
    try{
        const response = await axios.get(`/set_lang?locale=${selectedLang}`);
        const translationStore = useTranslationStore();
        const titleStore = useTitleStore();
        console.log(response.data.translation);
        translationStore.updateTranslations(JSON.parse(response.data.translation));
        titleStore.updateTitle(response.data.title);
        console.log(`cambiando a ${selectedLang}`);
        // console.log(response.data.translations);
    }catch (error){
        console.error("Error al cambiar el idioma:", error);
    }
    // Inertia.get("/set_lang", { locale: selectedLang }, {
    //     preserveState: true, // Mantén el estado actual del componente.
    //     onBefore: () => console.log("Cambiando el idioma..."),
    //     onSuccess: () =>{
    //         console.log("Idioma cambiado exitosamente.");
    //         const newTranslations = JSON.parse(page.props.translations);
    //         // Asumiendo que 'page.props.translations' es un string JSON
    //         translationStore.updateTranslations(newTranslations);
    //
    //     },
    //     onError: () => console.log("Error al cambiar el idioma."),
    // });
};
</script>

<template>

    <details class="dropdown bg-amber-100 rounded-2xl relative">
        <summary class="m-1 btn ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>

        </summary>
        <ul class="p-2 shadow right-0 menu dropdown-content z-[1]
         bg-base-100
         rounded-box w-52 absolute ">
            <li v-for="(lang, index) in list_of_lang" :key="index">
                <button class="btn-sm " @click="change_lang(index)">{{ lang.lang_name }}</button>
            </li>


        </ul>
    </details>


</template>

<style scoped>

</style>
