export interface NotificationProps {
    type: NotificationType;
    body: string;
}

export interface Notification extends NotificationProps {
    id: number;
}

export const enum NotificationType {
    SUCCESS = 'success',
    ERROR = 'error',
    WARNING = 'warning',
}
