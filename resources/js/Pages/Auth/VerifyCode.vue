<script setup>
import {ref, computed, onMounted} from 'vue';
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import LayoutBasic from "@/Layouts/LayoutBasic.vue";
import { __ } from "@/Hooks/useTranslation.js";
import {useTranslationStore} from "@/stores/translationsStore.js";

const code = ref('');
const error = ref(null);
const digits = Array.from({ length: 6 }, () => ref(''));
const inputs = Array.from({ length: 6 }, () => ref(null));

const translationStore = useTranslationStore();
const { translate } = usePage().props;


onMounted(() => {
    if (translate) {
        translationStore.updateTranslations(translate);
    }
});

const form = useForm({
    code: ''
});
const {lang, list_of_lang}=defineProps({
    lang: String,
    list_of_lang: Object
})
const title = computed(() => __("Verify Code"));
console.log(`VERIFY-CODE Valor de title ${title.value}`);

//Funciones para pasar el foco al anterior o siguiente caja de texto
const focusNext = (index) => {
    if (digits[index].value && index < inputs.length - 1) {
        inputs[index + 1]?.value?.focus?.();
    }
};

const focusPrev = (index, event) => {
    if (event.key === 'Backspace' && !digits[index].value && index > 0) {
        inputs[index - 1]?.value?.focus?.();
    }
};

const onPaste = (event)=>{
    event.preventDefault();// Para evitar que se pegue todo el texto en el primer text
    const text =  event.clipboardData.getData('text'); //Obtener el texto del portapapeles
    console.log(`en envento on paste con el texto ${text}`);

    if (text.length ===6 && /^\d{6}$/.test(text)){
        [...text].forEach((char, i)=>{
            digits[i].value=char;
        });
        inputs[5]?.value?.focus?.();
    }else {
        error.value = __("Please paste a valid 6-digit code.");
    }

}
const submit = () => {
    form.code = digits.map(d=>d.value).join('');
    form.post(route('verify-code-post'), {
        onSuccess: () => {
            console.log("vengo de validar correctamente!!!!!");
            router.visit('/admin');
        },
        onError: (errors) => {
            error.value = __('Invalid or expired code.');
        },
    });
};
</script>

<template>
    <layout-basic :title="title" :lang="lang", :list_of_lang="list_of_lang">
        <AuthenticationCard>
            <h1 class="text-4xl flex justify-center w-full mb-8">
                {{ __("Project Repository of CPI FP Los Enlaces.") }}
            </h1>
            <div class="w-full flex justify-center">
                <img class="w-12 h-12 mb-8" src="/images/opt.avif" alt="otp code image" />
            </div>
            <h1 class="text-green-800 text-3xl">
                {{ __("Two-Factor Authentication") }}
            </h1>
            <div class="mb-4 text-2xl text-green-600 dark:text-green-300">
                {{ __("Please enter the 6-digit code we have sent to your email address.") }}
            </div>

            <form @submit.prevent="submit">
                <div class="w-full mt-4 flex flex-col space-y-4 justify-center items-center">
                    <!--                    <input-->
                    <!--                        v-model="form.code"-->
                    <!--                        type="text"-->
                    <!--                        maxlength="6"-->
                    <!--                        placeholder="123456"-->
                    <!--                        class="input input-bordered text-xl w-1/2"-->
                    <!--                        required-->
                    <!--                    />-->
                    <div class="flex justify-center space-x-2 mb-4">
                        <template v-for="(digit, index) in digits" :key="index">
                            <input
                                ref="el => inputs[index] = el"
                                v-model="digit.value"
                                @input="focusNext(index)"
                                @keydown="e => focusPrev(index, e)"
                                @paste="onPaste"
                                type="text"
                                maxlength="1"
                                class="w-12 h-12 text-center text-2xl border rounded-md"
                                inputmode="numeric"
                                pattern="[0-9]*"
                                autocomplete="one-time-code"
                                name="code[]"
                            />
                        </template>
                    </div>
                    <div v-if="form.errors.code" class="text-red-600">
                        {{ form.errors.code }}
                    </div>
                    <div v-if="error" class="text-red-600">
                        {{ error }}
                    </div>

                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        {{ __("Verify Code") }}
                    </PrimaryButton>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="btn btn-primary underline text-sm text-white dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mt-4"
                    >
                        {{ __("Log Out") }}
                    </Link>
                </div>
            </form>
        </AuthenticationCard>
    </layout-basic>
</template>
