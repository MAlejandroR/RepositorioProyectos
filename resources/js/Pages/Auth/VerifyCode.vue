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

<template>
    <layout-basic :title="title">
        <AuthenticationCard>
            <h1 class="text-4xl flex justify-center w-full mb-8">{{ __("Verify Your Account") }}</h1>

            <div class="w-full flex justify-center">
                <img class="w-12 h-12 mb-8" src="/images/code_lock.webp" alt="OTP Code" />
            </div>

            <div class="mb-4 text-xl text-gray-700 dark:text-gray-300 text-center">
                {{ __("Please enter the 6-digit code we sent to your email.") }}
            </div>

            <div class="w-full flex justify-center mt-4">
                <input
                    v-model="code"
                    type="text"
                    maxlength="6"
                    class="rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="123456"
                />
            </div>

            <div class="mt-2 text-red-500 text-sm text-center" v-if="error">
                {{ error }}
            </div>

            <div class="w-full mt-4 flex flex-col space-y-2 justify-center items-center">
                <PrimaryButton @click="verify">
                    {{ __("Verify Code") }}
                </PrimaryButton>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="btn btn-primary underline text-sm text-white dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md mt-4"
                >
                    {{ __("Log Out") }}
                </Link>
            </div>
        </AuthenticationCard>
    </layout-basic>
</template>
