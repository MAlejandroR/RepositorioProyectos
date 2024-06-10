<!-- resources/js/Components/LoadingSpinner.vue -->

<template>
    <div class="fixed inset-0 flex items-center
    justify-center bg-gray-100 bg-opacity-50
     z-50" v-if="visibleLoading">
        <div class="loader m-5 text-xl text-red-800">{{__("Wait please")}}</div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import {__} from "@/Hooks/useTranslation.js";

const props = defineProps({
    visibleLoading: {
        type: Boolean,
        default: false
    }
});
</script>

<style scoped>
.loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
