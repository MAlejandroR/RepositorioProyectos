
<template>
    <div>
        <h2>Introduce el código enviado a tu correo</h2>
        <input v-model="code" type="text" placeholder="Código de 6 dígitos" />
        <button @click="verify">Verificar</button>
        <p v-if="error">{{ error }}</p>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const code = ref('')
const error = ref(null)

const verify = async () => {
    try {
        await axios.post('/verify-code', { code: code.value })
        router.visit('/dashboard')
    } catch (err) {
        error.value = 'Código incorrecto o expirado.'
    }
}
</script>


<style scoped>

</style>
