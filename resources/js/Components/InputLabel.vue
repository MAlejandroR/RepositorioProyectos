<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="block font-medium
     text-2xl text-gray-700 dark:text-gray-300 mt-3">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
