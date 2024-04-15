<script setup>

import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import R1 from "@/Pages/Auth/R1.vue";



function register(){
    console.log("Login. register. emitiendo el evento");
    emit('change-modal-visibility',true);
}


const emit = defineEmits(['change-modal-visibility']);
const props = defineProps({
    showModal: Boolean
});
</script>

<template>
    <form>
        <div class="form-control mt-4">
            <InputLabel class="text-xl ">
                <span class="label-text">  'Email'</span>
            </InputLabel>
            <TextInput type="email" placeholder="email"
                       class="input input-bordered text-xl" required/>
        </div>
        <div class="form-control mt-4">
            <InputLabel class="text-xl">
                <span class="label-text">"Password"</span>
            </InputLabel>
            <TextInput type="password" placeholder="password" class="input input-bordered" required/>
            <InputLabel class="label">
                <a href="#" class="label-text-alt link link-hover">"Forgot password?"</a>
            </InputLabel>
        </div>
        <div class="form-control mt-6">
            <PrimaryButton class="btn btn-primary"> "Login" </PrimaryButton>
        </div>
        <div class="form-control mt-6">
            <PrimaryButton @click=register class="btn btn-primary">"Register"</PrimaryButton>
        </div>
    </form>

</template>

<style scoped>

</style>
