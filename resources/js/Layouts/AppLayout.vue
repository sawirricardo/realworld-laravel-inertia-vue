<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>
<template>
    <div>
        <Head :title="title" />
        <header></header>
        <main><slot /></main>
    </div>
</template>
