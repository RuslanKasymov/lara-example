<?php

namespace App\Interfaces;

use App\Channels\Interfaces\IMailChannel;
use App\Channels\Interfaces\PushInterface;
use App\Enum\NotificationChannel;

interface INotificationSender
{
    public function sendNotification(int $userId, INotification $notification): void;

    public function sendNotificationMultipleUsers(array $usersIds, INotification $notification): void;
}
