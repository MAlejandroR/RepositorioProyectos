<script setup>
import {usePage} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const user = usePage().props.user


</script>


    <template>
        <AppLayout title="Repositorio Proyectos">
            <h1>Esto es app layout</h1>

            <h1 v-if="user">Listado de proyectos del usuario {{user.name}}</h1>
        </AppLayout>
    </template>

<style scoped>

</style>
