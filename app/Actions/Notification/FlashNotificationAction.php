<?php

declare(strict_types=1);

namespace App\Actions\Notification;

use App\Enum\NotificationType;
use Illuminate\Support\Facades\Session;

class FlashNotificationAction
{
    public function success(string $message): void
    {
        $this->flashToSession(NotificationType::SUCCESS, $message);
    }

    public function error(string $message): void
    {
        $this->flashToSession(NotificationType::ERROR, $message);
    }

    public function warning(string $message): void
    {
        $this->flashToSession(NotificationType::WARNING, $message);
    }

    private function flashToSession(NotificationType $type, string $message): void
    {
        Session::flash($type->value, $message);
    }
}
