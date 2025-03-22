<script setup>

import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Register from "@/Pages/Auth/Register.vue";
import {__} from "@/Hooks/useTranslation.js";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";


const props = defineProps({
    showModal: Boolean
});

const emit = defineEmits(['update:showModal']);

function register(){
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
            <InputLabel class="text-3xl ">
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
        <PrimaryButton @click="register" class="btn btn-primary">{{ __("Register") }}</PrimaryButton>
    </div>

    <div class="divider">{{__("Or continue with")}}</div>

    <div class="grid grid-cols-2 gap-4">
        <a href="/auth/google" class="btn btn-outline flex items-center justify-center">
            <svg aria-hidden="true" viewBox="0 0 18 18"
                 class="h-6 w-6"><path d="M17.64 9.205c0-.639-.057-1.252-.164-1.841H9v3.481h4.844a4.14 4.14 0 0 1-1.796 2.716v2.259h2.908c1.702-1.567 2.684-3.875 2.684-6.615Z" fill="#4285F4"></path><path d="M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 0 0 9 18Z" fill="#34A853"></path><path d="M3.964 10.71A5.41 5.41 0 0 1 3.682 9c0-.593.102-1.17.282-1.71V4.958H.957A8.996 8.996 0 0 0 0 9c0 1.452.348 2.827.957 4.042l3.007-2.332Z" fill="#FBBC05"></path><path d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 0 0 .957 4.958L3.964 7.29C4.672 5.163 6.656 3.58 9 3.58Z" fill="#EA4335"></path></svg>
            Google
        </a>
        <a href="/auth/microsoft" class="btn btn-outline flex items-center justify-center">
            <svg aria-hidden="true" viewBox="0 0 21 21" class="h-6 w-6"><path fill="#f25022" d="M1 1h9v9H1z"></path><path fill="#00a4ef" d="M1 11h9v9H1z"></path><path fill="#7fba00" d="M11 1h9v9h-9z"></path><path fill="#ffb900" d="M11 11h9v9h-9z"></path></svg>
            Microsoft
        </a>
        <a href="/auth/apple" class="btn btn-outline flex items-center justify-center">
            <svg aria-hidden="true" fill="currentColor"
                 viewBox="0 0 170 170"
                 class="h-6 w-6"><path d="M150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.197-2.12-9.973-3.17-14.34-3.17-4.58 0-9.492 1.05-14.746 3.17-5.262 2.13-9.501 3.24-12.742 3.35-4.929.21-9.842-1.96-14.746-6.52-3.13-2.73-7.045-7.41-11.735-14.04-5.032-7.08-9.169-15.29-12.41-24.65-3.471-10.11-5.211-19.9-5.211-29.378 0-10.857 2.346-20.221 7.045-28.068 3.693-6.303 8.606-11.275 14.755-14.925s12.793-5.51 19.948-5.629c3.915 0 9.049 1.211 15.429 3.591 6.362 2.388 10.447 3.599 12.238 3.599 1.339 0 5.877-1.416 13.57-4.239 7.275-2.618 13.415-3.702 18.445-3.275 13.63 1.1 23.87 6.473 30.68 16.153-12.19 7.386-18.22 17.731-18.1 31.002.11 10.337 3.86 18.939 11.23 25.769 3.34 3.17 7.07 5.62 11.22 7.36-.9 2.61-1.85 5.11-2.86 7.51zM119.11 7.24c0 8.102-2.96 15.667-8.86 22.669-7.12 8.324-15.732 13.134-25.071 12.375a25.222 25.222 0 0 1-.188-3.07c0-7.778 3.386-16.102 9.399-22.908 3.002-3.446 6.82-6.311 11.45-8.597 4.62-2.252 8.99-3.497 13.1-3.71.12 1.083.17 2.166.17 3.24z"></path></svg>
            Apple
        </a>
        <a href="/auth/slack" class="btn btn-outline flex items-center justify-center">
            <svg aria-hidden="true" viewBox="0 0 127 127"
                 class="w-6 h-6"><path d="M27.2 80c0 7.3-5.9 13.2-13.2 13.2C6.7 93.2.8 87.3.8 80c0-7.3 5.9-13.2 13.2-13.2h13.2V80zm6.6 0c0-7.3 5.9-13.2 13.2-13.2 7.3 0 13.2 5.9 13.2 13.2v33c0 7.3-5.9 13.2-13.2 13.2-7.3 0-13.2-5.9-13.2-13.2V80z" fill="#E01E5A"></path><path d="M47 27c-7.3 0-13.2-5.9-13.2-13.2C33.8 6.5 39.7.6 47 .6c7.3 0 13.2 5.9 13.2 13.2V27H47zm0 6.7c7.3 0 13.2 5.9 13.2 13.2 0 7.3-5.9 13.2-13.2 13.2H13.9C6.6 60.1.7 54.2.7 46.9c0-7.3 5.9-13.2 13.2-13.2H47z" fill="#36C5F0"></path><path d="M99.9 46.9c0-7.3 5.9-13.2 13.2-13.2 7.3 0 13.2 5.9 13.2 13.2 0 7.3-5.9 13.2-13.2 13.2H99.9V46.9zm-6.6 0c0 7.3-5.9 13.2-13.2 13.2-7.3 0-13.2-5.9-13.2-13.2V13.8C66.9 6.5 72.8.6 80.1.6c7.3 0 13.2 5.9 13.2 13.2v33.1z" fill="#2EB67D"></path><path d="M80.1 99.8c7.3 0 13.2 5.9 13.2 13.2 0 7.3-5.9 13.2-13.2 13.2-7.3 0-13.2-5.9-13.2-13.2V99.8h13.2zm0-6.6c-7.3 0-13.2-5.9-13.2-13.2 0-7.3 5.9-13.2 13.2-13.2h33.1c7.3 0 13.2 5.9 13.2 13.2 0 7.3-5.9 13.2-13.2 13.2H80.1z" fill="#ECB22E"></path></svg>
            Slack
        </a>
    </div>


</template>



<style scoped>

</style>
