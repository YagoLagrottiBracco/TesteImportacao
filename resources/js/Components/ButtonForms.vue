<script setup>
    defineProps({
        message: String,
        href: String,
        color: String,
    });
</script>
<template>
    <div class="mt-8 gap-x-4 mb-5 ml-2">
        <a :href="href" :class="'inline-block rounded-lg bg-' + color +'-600 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-' + color +'-600 hover:bg-' + color +'-700 hover:ring-' + color +'-700'">
            {{ message }}
        </a>
    </div>
</template>