<script setup>
import {usePage} from "@inertiajs/vue3";

const user = usePage().props.user


</script>

<template>
<h1 v-if="user">Listado de proyectos del usuario {{user.name}}</h1>
<h1 v-else="user">No estás conectado</h1>
</template>

<style scoped>

</style>
