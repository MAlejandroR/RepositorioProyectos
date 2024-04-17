<template>
    <div v-if="visible" class="my-modal">
        <div class="modal-box">
            <h2 class="font-bold">{{ __("Register") }}</h2>
            <form @submit.prevent="register">
                <div class="form-control mt-4">
                    <InputLabel class="text-xl">
                        <span class="label-text">{{ __('Email') }}</span>
                    </InputLabel>
                    <TextInput type="email" v-model="email" placeholder="email"
                               class="input input-bordered text-xl" required/>
                </div>
                <div class="form-control mt-4">
                    <InputLabel class="text-xl">
                        <span class="label-text">{{ __("Password") }}</span>
                    </InputLabel>
                    <TextInput type="password" v-model="password" placeholder="password" class="input input-bordered" required/>
                </div>
                <div class="form-control mt-6">
                    <PrimaryButton class="btn btn-primary">{{ __("Register") }}</PrimaryButton>
                </div>
            </form>
            <div class="modal-action">
                <PrimaryButton @click="close">{{ __("Close") }}</PrimaryButton>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { __ } from "@/Hooks/useTranslation.js";

const props = defineProps({
    visible: Boolean
});

//Definimos un evento para notificar al padre una modificación de la propiedad visible para q
const emit = defineEmits(['update:visible']);

const email = ref('');
const password = ref('');

function register() {
    // Aquí iría la lógica de registro, por ejemplo, utilizando Inertia.js para enviar los datos al servidor.
    console.log('Registrando:', email.value, password.value);
}

function close() {
    console.log("Resiter-modal, close");
    emit('update:visible', false);
}
</script>

<style scoped>
.my-modal {
    /* Estilos del modal */
    position: fixed; /* or absolute */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 100000;
}
</style>
