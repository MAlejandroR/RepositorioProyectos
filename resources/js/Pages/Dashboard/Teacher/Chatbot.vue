<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { router, usePage } from '@inertiajs/vue3'
import { onMounted, defineProps } from "vue"
import { useTranslationStore } from "@/stores/translationsStore.js"
import { __ } from "@/Hooks/useTranslation.js"
import { ref } from 'vue'
import axios from 'axios'

const { translate, lang, list_of_lang } = defineProps({
    translate:Object,
    lang:String,
    list_of_lang: Object
})

const translationStore = useTranslationStore()

onMounted(() => {
    if (translate) {
        translationStore.updateTranslations(translate)
    }
})


const question = ref('')
const results = ref([])

async function ask() {
    const response = await axios.post('/chatbot/query', {
        question: question.value
    })
    results.value = response.data.results
    console.log(results.value);
}
</script>

<template>
    <AppLayout title="projects" :lang="lang" :list_of_lang="list_of_lang">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">Chat de búsqueda de proyectos</h2>
            <input v-model="question" class="border rounded px-4 py-2 w-full mb-4" placeholder="¿Qué quieres buscar?" />
            <button @click="ask" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Buscar
            </button>
            <div v-if="results.length" class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Proyectos encontrados:</h3>
                <ul class="list-disc pl-6">
                    <li v-for="p in results" :key="p.id">
                        <a :href="p.enlace_recursos"  class="text-blue-600 hover:underline">{{ p.titulo }}</a> — {{ p.familia_profesional }} ({{ p.palabras_clave }})
                    </li>
                </ul>
            </div>
            <div v-else class="mt-6">
                <h3 class="text-lg font-semibold mb-2">No se han encontrado Proyectos con el criterio indicado </h3>
            </div>
        </div>
    </AppLayout>
</template>
