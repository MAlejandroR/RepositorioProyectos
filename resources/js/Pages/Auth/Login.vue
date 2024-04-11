<script setup>

import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {__} from "@/Hooks/useTranslation.js";
</script>

<template>
    <form>
        <div class="form-control mt-4">
            <InputLabel class="text-xl ">
                <span class="label-text">  {{ __('Email') }}</span>
            </InputLabel>
            <TextInput type="email" placeholder="email"
                       class="input input-bordered text-xl" required/>
        </div>
        <div class="form-control mt-4">
            <InputLabel class="text-xl">
                <span class="label-text">{{ __("Password") }}</span>
            </InputLabel>
            <TextInput type="password" placeholder="password" class="input input-bordered" required/>
            <InputLabel class="label">
                <a href="#" class="label-text-alt link link-hover">{{ __("Forgot password?") }}</a>
            </InputLabel>
        </div>
        <div class="form-control mt-6">
            <PrimaryButton class="btn btn-primary">{{ __("Login") }}</PrimaryButton>
        </div>
        <div class="form-control mt-6">
            <PrimaryButton class="btn btn-primary">{{ __("Register") }}</PrimaryButton>
        </div>
    </form>

</template>

<style scoped>

</style>
