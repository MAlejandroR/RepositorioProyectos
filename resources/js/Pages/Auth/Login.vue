<script setup>

import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {watch} from "vue";
import RegisterModal from "@/Pages/Auth/RegisterModal.vue";
import {ref} from "vue";
import {__} from "@/Hooks/useTranslation.js";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";


// const props = defineProps({
//     showModal: Boolean
// });

const emit = defineEmits(['update:showModal']);

function register(){
    console.log("Login. register. emitiendo el evento");
    console.log(errors);
    emit('update:showModal',true);
}
const form = useForm({
    email: "",
    password: "",
    remember: false
});

const submit = () => {
    console.log(form.post)
    try {
        form.post('login', {
            preserveScroll: true,
            onSuccess: () => console.log('Login successful'),
            onError: () => console.log('Error during login')
        });
    }catch(error){
        console.log ("Login.submit error" );
        console.log (error );

    }
};




</script>

<template>
    <form @submit.prevent="submit">
        <div class="form-control mt-4">
            <InputLabel class="text-xl ">
                <span class="label-text">  {{ __('Email') }}</span>
            </InputLabel>
            <TextInput type="email" placeholder="email" name="email"
                       v-model="form.email"
                       class="input input-bordered text-xl" required
            />
            <InputError class="mt-2" :message="form.errors.email" />

        </div>
        <div class="form-control mt-4">
            <InputLabel class="text-xl">
                <span class="label-text">{{ __("Password") }}</span>
            </InputLabel>
            <TextInput type="password" name="password"
                       placeholder="password"
                       v-model="form.password"
                       class="input input-bordered" required/>
            <InputLabel class="label">
                <a href="#" class="label-text-alt link link-hover">{{ __("Forgot password?") }}</a>
            </InputLabel>
            <InputError class="mt-2" :message="form.errors.password" />

        </div>
        <div class="form-control mt-6">
            <PrimaryButton class="btn btn-primary">{{ __("Login") }}</PrimaryButton>
        </div>

    </form>
    <div class="form-control mt-6">
        <PrimaryButton @click=register class="btn btn-primary">{{ __("Register") }}</PrimaryButton>
    </div>

</template>

<style scoped>

</style>
