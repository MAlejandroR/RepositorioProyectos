<script setup>

</script>

<template>
    <div>
        <h2>Introduce el código enviado a tu correo</h2>
        <input v-model="code" type="text" placeholder="Código de 6 dígitos" />
        <button @click="verifyCode">Verificar</button>
        <p v-if="error">{{ error }}</p>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const code = ref('')
const error = ref(null)

const verifyCode = async () => {
    try {
        const response = await axios.post('/email/verify-code', { code: code.value })
        router.visit('/dashboard') // redirige si es correcto
    } catch (err) {
        error.value = 'Código incorrecto o caducado.'
    }
}
</script>


<style scoped>

</style>
