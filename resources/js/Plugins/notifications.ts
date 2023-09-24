import useToast from '@/composables/useToast';
import { router, usePage } from '@inertiajs/vue3';
import { NotificationProps } from '@/types/notification';

const toast = useToast();

export const notifications = () => {
    router.on('finish', () => {
        const flashNotification: NotificationProps | [] = usePage().props.notification as NotificationProps | [];

        if (flashNotification instanceof Array) return;

        toast.showToast(flashNotification);
    });
};
