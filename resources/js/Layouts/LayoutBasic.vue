<script setup>
import DropDownLang from "@/Components/DropDown-lang.vue";
import {usePage} from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";

defineProps({
    title: String,
})
const list_of_lang = usePage().props.list_of_lang;

</script>

<template>
    <Head :title="title"/>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
     <header class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 flex justify-around mx-3">
         <!-- Logo -->
             <a href="https://cpilosenlaces.com/">
                 <ApplicationMark class=" h-9 w-auto" />
             </a>
<nav>
            <div class="self-stretch flex justify-end">
                <DropDownLang :list_of_lang=list_of_lang />
            </div>
        </nav>
     </header>
        <slot />
    </div>
</template>

<style scoped>

</style>
