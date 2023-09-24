<template>
    <div
        class="[ animate-toast-mount ] relative mb-3 flex w-full items-center border bg-gray-800 p-4 text-sm text-white md:rounded-xl"
        :class="{
            'border-green-400': props.notification.type === NotificationType.SUCCESS,
            'bg-red-400': props.notification.type === NotificationType.ERROR,
            'bg-orange-400': props.notification.type === NotificationType.WARNING,
        }"
        role="alert">
        <div
            class="inline-flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-white"
            :class="{
                'text-green-400': props.notification.type === NotificationType.SUCCESS,
                'text-red-400': props.notification.type === NotificationType.ERROR,
                'text-orange-400': props.notification.type === NotificationType.WARNING,
            }">
            <IconTickCircle v-if="props.notification.type === NotificationType.SUCCESS" />
            <IconCrossCircle v-if="props.notification.type === NotificationType.ERROR" />
            <IconExclamationCircle v-if="props.notification.type === NotificationType.WARNING" />
        </div>
        <div class="pl-4 text-sm font-normal">{{ props.notification.body }}</div>
    </div>
</template>

<script lang="ts" setup>
import { NotificationType, Notification } from '@/types/notification';
import IconTickCircle from '@/Components/Icons/IconTickCircle.vue';
import IconCrossCircle from '@/Components/Icons/IconCrossCircle.vue';
import IconExclamationCircle from '@/Components/Icons/IconExclamationCircle.vue';

const props = defineProps<{
    notification: Notification;
}>();
</script>

<style scoped>
@keyframes toast-mount {
    0% {
        opacity: 0;
        transform: scale(0.8);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-toast-mount {
    animation: toast-mount 0.2s ease-in-out;
    transform-origin: center;
}
</style>
