<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { router, usePage } from '@inertiajs/vue3'
import {  onMounted, defineProps } from "vue";
import {useTranslationStore} from "@/stores/translationsStore.js";
import { __ } from "@/Hooks/useTranslation.js";



const {translate, lang, list_of_lang}=usePage().props;
console.log(`Valor de lang ${lang}`);
console.log(`Valor de list_of_lang `);
console.log(list_of_lang);

// const datos = defineProps({
//     translate: Object,
//     // list_of_lang: Object,
//
// });

// 👇 cuando el componente se monte

const translationStore = useTranslationStore(); // 👈 Muy importante, crear la instancia

onMounted(() => {
    if (translate) {
        console.log("Actualizando store de traducciones");
        translationStore.updateTranslations(translate);
    } else {
        console.log("datos.translate está vacío o undefined");
    }
});

function goTo(path) {
    router.visit(path)
}
function getToBladeRoute(url){
    window.location.href=url
}
</script>

<template>
    <AppLayout title="projects" :lang="lang" :list_of_lang="list_of_lang">
        <div class="flex flex-col items-center justify-center min-h-screen

        bg-gradient-to-b from-[#d4c2d9] via-[#f4eff6] to-[#e5dee8]">
            <div class="flex flex-row justify-center">
<!--            <img src="/images/projects/img1.jpeg" alt="Bienvenida" class="w-64 h-64 mb-6" />-->
            <img src="/images/projects/gif1.gif" alt="Bienvenida" class="w-64 h-64 mb-6" />
            <img src="/images/projects/gif2.gif" alt="Bienvenida" class="w-64 h-64 mb-6" />
            <img src="/images/projects/img2.jpeg" alt="Bienvenida" class="w-64 h-64 mb-6" />
            </div>

            <h1 class="text-3xl font-bold mb-4">{{__("¡Bienvenido/a al repositorio de proyectos!")}}</h1>
            <p class="mb-6 text-gray-600 text-center max-w-xl">
                Desde aquí puedes gestionar los proyectos, importar datos o realizar consultas.
            </p>

            <div class="flex flex-wrap justify-center gap-4">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl"
                        @click="getToBladeRoute('/admin/projects')">
                    Administrar Proyectos
                </button>
                <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl"
                        @click="goTo('/chatbot')">
                    Chat boot
                </button>
                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl"
                        @click="goTo('/projects/query')">
                    Realizar Consultas
                </button>
            </div>
        </div>
    </AppLayout>
</template>
