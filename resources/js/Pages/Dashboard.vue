<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import InnerAuthenticatedLayout from '@/Layouts/InnerAuthenticatedLayout.vue';

defineOptions({
    layout: AuthenticatedLayout,
});
</script>

<template>
    <Head title="Dashboard" />
    <InnerAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">You're logged in!</div>
            </div>
        </div>
    </InnerAuthenticatedLayout>
</template>
