<script setup>
import DropDownLang from "@/Components/DropDown-lang.vue";
import {usePage} from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import {Head} from "@inertiajs/vue3";
import {defineProps} from "vue";




const {title, lang, list_of_lang}=defineProps({
    title: String,
    lang : String,
    list_of_lang: Object
});

console.log ("en layouts-basic")
console.log("Listado de lenguajes "+list_of_lang);
console.log("lenguajae  "+lang);

</script>

<template>
    <Head :title="title"/>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
     <header class="bg-white dark:bg-gray-800 border-b
     border-gray-100 dark:border-gray-700 flex justify-around mx-3">
         <!-- Logo -->
             <a href="https://cpilosenlaces.com/">
                 <ApplicationMark class=" h-9 w-auto" />
             </a>
<nav>
            <div class="self-stretch flex justify-end">
                <DropDownLang :list_of_lang="list_of_lang" :lang="lang" />
            </div>
        </nav>
     </header>
        <slot />

    </div>
</template>

<style scoped>

</style>
