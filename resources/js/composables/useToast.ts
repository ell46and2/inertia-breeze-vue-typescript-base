import { Notification, NotificationProps } from '@/types/notification';
import { ref } from 'vue';

export const notifications = ref<Notification[]>([]);
let id = 0;

export default () => {
    const showToast = ({ type, body }: NotificationProps) => {
        const newNotification: Notification = { id: id++, type, body };
        notifications.value.push(newNotification);

        console.log('notifications.value', notifications.value);

        setTimeout(() => {
            notifications.value = notifications.value.filter((notification) => notification.id !== newNotification.id);
        }, 5000);
    };

    return {
        showToast,
    };
};
