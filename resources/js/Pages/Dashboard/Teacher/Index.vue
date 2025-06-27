<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { router, usePage,useForm } from '@inertiajs/vue3'
import { ref, onMounted, defineProps } from "vue"
import { useTranslationStore } from "@/stores/translationsStore.js"
import { __ } from "@/Hooks/useTranslation.js"


const { translate, lang, list_of_lang, user, password_is_null } = usePage().props;

const showPasswordModal = ref(false)


const form=useForm({
    password:'',
    password_confirmation:''
})




const submitPassword = () => {
    form.post('/set-password', {
        onSuccess: () => {
            showPasswordModal.value = false
            form.reset()
        }
    })
}

console.log ("usuario")
console.log (user);


const translationStore = useTranslationStore()

onMounted(() => {
    if (translate) {
        translationStore.updateTranslations(translate)
    }
    console.log (`Pass del user ${user.name}`);
    console.log (user.password);
    if (password_is_null) {
        showPasswordModal.value = true
    }
})

function goTo(path) {
    router.visit(path)
}
function getToBladeRoute(url){
    window.location.href=url
}
</script>

<template>
    <AppLayout title="projects" :lang="lang" :list_of_lang="list_of_lang">
        <div class="min-h-screen bg-gray-100">
<!--
            <!-- Header
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-gray-900">{{ __("Bienvenido/a al Panel de Profesores") }}</h1>
                </div>
            </header>
            -->

            <!-- Main Content -->
            <main class="py-12 min-h-screen  bg-gradient-to-b from-[#d4c2d9] via-[#f4eff6] to-[#e5dee8]">

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                        <!-- Text Column -->
                        <div class="space-y-6">
                            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                                {{ __("Gestión de Proyectos Escolares") }}
                            </h2>
                            <p class="text-xl text-gray-700">
                                {{ __("Como profesor, puedes gestionar y supervisar los proyectos de tus estudiantes.") }}
                            </p>
                            <ul class="list-disc list-inside space-y-2 text-gray-600">
                                <li>{{ __("Supervisar proyectos de tus estudiantes") }}</li>
                                <li>{{ __("Evaluar y dar retroalimentación") }}</li>
                                <li>{{ __("Seguir el progreso de los proyectos") }}</li>
                                <li>{{ __("Comunicarte con estudiantes y padres") }}</li>
                            </ul>

                                <div class="mt-8 flex flex-wrap justify-center gap-4">


                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl"
                                        @click="getToBladeRoute('/admin/projects')">
                                    {{__("Administrar Proyectos")}}
                                </button>
                                <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl"
                                        @click="goTo('/chatbot')">
                                    {{__("Consultar con frase")}}
                                </button>
                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl"
                                        @click="goTo('/projects/query')">
                                    {{__("Realizar Consultas")}}
                                </button>
                            </div>
                        </div>

                        <!-- Image Column -->
                        <div class="mt-12 -mx-4 relative sm:mt-16 sm:-mx-0 sm:relative lg:mt-0">
                            <div class="relative">
                                <img class="w-full rounded-lg shadow-2xl"
                                     src="/images/projects/teacher-projects.jpg"
                                     :alt="__('Estudiantes trabajando en proyectos escolares')">
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div v-if="showPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">{{ __("Establecer contraseña") }}</h2>
                <p class="text-sm text-gray-600 mb-4">{{ __("Debes establecer una contraseña para continuar.") }}</p>

                <div class="mb-4">
                    <label class="block text-sm font-medium">{{ __("Nueva contraseña") }}</label>
                    <input type="password" v-model="form.password" class="input input-bordered w-full mt-1" />
                    <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">{{ __("Confirmar contraseña") }}</label>
                    <input type="password" v-model="form.password_confirmation" class="input input-bordered w-full mt-1" />
                    <div v-if="form.errors.password_confirmation" class="text-red-500 text-sm mt-1">{{ form.errors.password_confirmation }}</div>
                </div>

                <div class="flex justify-end space-x-2">
                    <button class="btn btn-primary" @click="submitPassword">{{ __("Guardar") }}</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
