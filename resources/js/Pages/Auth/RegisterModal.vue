<script setup>
import { ref } from 'vue';
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { __ } from "@/Hooks/useTranslation.js";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const datos = defineProps({
    visible: Boolean,
    departaments: Array
});

console.log("En RegisterModal Departamentos" + datos.departaments);
//Definimos un evento para notificar al padre una modificación de la propiedad visible para q
const emit = defineEmits(['update:visible']);


const form = useForm({
    email:"",
    name:"",
    departamento:"",
    password:"",
    password_confirmation: '',
    terms: false,
});
// const email = ref('');
// const name = ref('');
// const password = ref('');
// const departamento= ref('');

const submit = () => {
    console.log("En RegisterModal - submit")
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
        onSuccess:()=>    emit('update:visible', false)

    });
    // form.post('/register', {
    //     onFinish: () => form.reset('password', 'password_confirmation'),
    //     preserveScroll: true,
    //     onSuccess: () => console.log('Registro completado con éxito')
    // });
};
function close() {
    console.log("Resiter-modal, close");
    emit('update:visible', false);
}
</script>

<template>
    <div v-if="visible" class="my-modal">
        <div class="modal-box">
            <h2 class="font-bold">{{ __("Register") }}</h2>
            <form @submit.prevent="submit">
                <div class="form-control mt-4">
                    <InputLabel class="text-xl">
                        <span class="label-text">{{ __('Name') }}</span>
                    </InputLabel>
                    <TextInput type="text" v-model="form.name" placeholder="name"
                               class="input input-bordered text-xl" required/>
                </div>
                <div class="form-control mt-4">
                    <InputLabel class="text-xl">
                        <span class="label-text">{{ __('Email') }}</span>
                    </InputLabel>
                    <TextInput type="email" v-model="form.email" placeholder="email"
                               class="input input-bordered text-xl" required/>
                </div>

                <div class="form-control mt-4">
                    <InputLabel class="text-xl">
                        <span class="label-text">{{ __("Password") }}</span>
                    </InputLabel>
                    <TextInput type="password" v-model="form.password" placeholder="password" class="input input-bordered" required/>
                </div>
                <div class="mt-4">
                    <InputLabel for="password_confirmation"
                                value="Confirm Password" />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>
                <div class="form-control mt-4">
                    <InputLabel class="text-xl">
                        <span class="label-text">{{ __("Department") }}</span>
                    </InputLabel>
                    <select name="departamento" v-model="form.departamento" placeholder="departamento" class="input input-bordered" required>
                        <option v-for="departament in departaments">
                        {{departament}}
                        </option>

                    </select>


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
