<script setup>
import {ref, defineProps, onMounted, onBeforeUnmount, computed} from 'vue';

import {useTranslationStore} from "@/stores/translationsStore.js";

import {useTitleStore} from "@/stores/titleStore.js";

import {Inertia} from '@inertiajs/inertia';
// import {usePage} from '@inertiajs/inertia-vue3'


// defineProps te permite declarar las props que tu componente espera recibir.
// const { lang, list_of_lang } = defineProps({
//     lang: String,
//     list_of_lang: Object
// });
const {list_of_lang, lang} = defineProps({
    list_of_lang: Object,
    lang: String
})


// Usar `ref` para reactividad en componentes compuestos (opcional en este caso).

// const selectedLang = computed(()=>lang);
const selectedLang= ref(lang ?? "es");
const dropDownRef=ref(null);

console.log("En dropdown lang:", lang);
console.log("En dropdown list of lang:", list_of_lang);
console.log("En dropdown, selectedLang:", selectedLang);


// Esta función se llama cuando un usuario selecciona un nuevo idioma.
const change_lang = async (newLangCode) => {
    console.log(`DropDown change_lang -${newLangCode}-`)
    try {
        const response = await axios.get(`/set_lang?locale=${newLangCode}`);
        const translationStore = useTranslationStore();
        const titleStore = useTitleStore();
        translationStore.updateTranslations(JSON.parse(response.data.translation));
        titleStore.updateTitle(response.data.title);
        console.log(`cambiando a ${selectedLang}`);
        // console.log(response.data.translations);
        // Cerrar el desplegable
        selectedLang.value = newLangCode;
        if (dropDownRef.value) {
            dropDownRef.value.open = false;
        }
    } catch (error) {
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

//Añadimos el evento de click cuando el componente está montado (solo se ejecuta una vez)
//Así se puede recuperar el click de fuera del componente
onMounted(() => {
    document.addEventListener('click', handleClickOutsite)
});

//Se ejecuta justo antes de que el componente se destruya del DOM.
//Elimina el evento que se había añadido antes para evitar fugas de memoria o errores.
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutsite);
});

//para cerrar el dropdown si hace click fuera de él
const handleClickOutsite = (event) => {
    if (dropDownRef.value && !dropDownRef.value.contains(event.target)) {
        dropDownRef.value.open = false;
    }
}

</script>

<template>


    <details ref="dropDownRef" class="dropdown bg-amber-100 rounded-2xl relative cursor-pointer">
        <summary class="m-1 btn cursor-pointer">
            <!-El símbolo de idioma-->

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
            </svg>
            <!-- Bandera del idioma actual -->
            <span v-if="list_of_lang[selectedLang]">
                    {{ list_of_lang[selectedLang].flag }}
            </span>
            <span v-else>
                ❓
            </span>


            <!--La flechita para seleccionar-->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
            </svg>

        </summary>
        <ul class="p-2 shadow right-0  menu dropdown-content z-[1]
         bg-base-100
         rounded-box w-32 absolute ">
            <li v-for="(lang, code) in list_of_lang" :key="code">
                <button class="btn-sm cursor-pointer" @click="change_lang(code)">{{lang.lang_name}} &nbsp{{ lang.flag }} </button>
            </li>


        </ul>
    </details>
</template>

<style scoped>

</style>
