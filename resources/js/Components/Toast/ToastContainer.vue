<template>
    <div class="fixed top-0 z-50 w-full md:right-5 md:top-5 md:w-[300px]">
        <ToastNotification v-for="notification in notifications" :key="notification.id" :notification="notification" />
    </div>
</template>

<script lang="ts" setup>
import useToast, { notifications } from '@/composables/useToast';
import ToastNotification from '@/Components/Toast/ToastNotification.vue';
</script>
