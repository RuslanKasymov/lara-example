<?php

namespace App\Service\Notification;

use App\Domain\Users\User\Domain\IUserRepository;
use App\Interfaces\INotification;
use App\Interfaces\INotificationSender;
use Illuminate\Support\Facades\Notification;

class NotificationSender implements INotificationSender
{
    public function __construct(
        private readonly IUserRepository $userRepository,
    ) {
    }

    public function sendNotificationMultipleUsers(array $usersIds, INotification $notification): void
    {
        $users = $this->userRepository->getByIds($usersIds);

        Notification::send($users, $notification);
    }

    public function sendNotification(int $userId, INotification $notification): void
    {
        $user = $this->userRepository->getByIds([$userId])->first();

        if ($user) {
            $user->notify($notification);
        }
    }
}
