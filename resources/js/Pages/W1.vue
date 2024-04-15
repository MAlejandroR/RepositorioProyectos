<script setup>
import {Head} from '@inertiajs/vue3';
import L1 from "@/Pages/Auth/L1.vue";
import R1 from "@/Pages/Auth/R1.vue";
import {ref} from "vue";
import {watch} from "vue";

const showModal=ref(false);

watch(showModal, (newValue)=>{
    console.log("showModal cambió a:"+ newVal); // Esto debe imprimir true cuando presiones Register
})

console.log (`Wellcome.vue l-17 showmodal ${showModal.value}`)

</script>
<template>
    <R1 :visible="showModal" @update:visible="showModal = $event" />

    <Head title="Proyectos"/>
    <h1>Gestión de visible</h1>

            <div class=" flex justify-center items-center h-full">

                <div class="shadow-2xl h-4/6 bg-white p-10 rounded-lg">
                    <L1 :showModal="showModal", @change-modal-visibility="showModal=$event"/>
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
