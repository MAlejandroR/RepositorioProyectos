
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
        await axios.post('/email/verify-code', { code: code.value })
        router.visit('/dashboard')
    } catch (err) {
        error.value = 'Código incorrecto o expirado.'
    }
}
</script>


<style scoped>

</style>


<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import { Head, Link } from '@inertiajs/vue3'
import AuthenticationCard from '@/Components/AuthenticationCard.vue'
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import LayoutBasic from "@/Layouts/LayoutBasic.vue"
import { __ } from "@/Hooks/useTranslation.js"

const code = ref('')
const error = ref(null)

const title = computed(() => __("Verify with Code"))

const verify = async () => {
    try {
        await axios.post('/email/verify-code', { code: code.value })
        router.visit('/dashboard')
    } catch (err) {
        error.value = __("Invalid or expired code.")
    }
}
</script>
