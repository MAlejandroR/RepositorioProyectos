<script setup>
import {computed} from 'vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import LayoutBasic from "@/Layouts/LayoutBasic.vue";
import {__} from "@/Hooks/useTranslation.js";


const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};
const title = computed(()=>__("Email verified"));

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>
<template>
    <layout-basic :title="title">

        <AuthenticationCard>
            <h1 class="text-4xl flex justify-center w-full mb-8">{{__("Project Repository of CPI FP Los Enlaces.")}}</h1>
            <div class="w-full flex justify-center">
                <img class="w-12 h-12 mb-8 " src="/images/web_verified.webp" alt="email image" />
            </div>
            <h1 class="text-green-800 text-3xl">{{__("Thank you for registering")}}</h1>
            <div class="mb-4 text-2xl  text-green-600 dark:text-green-300">
                {{ __("Before continuing, could you verify your email address by clicking on the link we just emailed to you?" ) }}
            </div>
            <div class="mb-4 text-2xl  text-green-600 dark:text-green-300">
                {{ __("If you didn't receive the email, we will gladly send you another.") }}
            </div>




            <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __("A new verification link has been sent to the email address you provided in your profile settings.") }}
            </div>

            <form @submit.prevent="submit">
                <div class="w-full mt-4 flex flex-col space-y-2 justify-center items-center justify-between">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        {{ __("Resend Verification Email") }}
                    </PrimaryButton>


                    <div class=" flex justify-end">
                        <Link
                            :href="route('profile.show')"
                            class="btn btn-accent underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        >
                            {{ __("Edit Profile") }}
                        </Link>

                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="btn btn-primary underline text-sm text-white dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ms-2"
                        >
                            {{ __("Log Out") }}
                        </Link>
                    </div>
                </div>
            </form>
        </AuthenticationCard>
    </layout-basic>
</template>
