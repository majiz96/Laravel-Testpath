<?php

namespace App\Services;

class RegistrationService
{
    public function __construct(private NotificationService $notification)
    {
        //
    }

    public function register(string $email):bool
    {
        return $this->notification->sendWelcome($email);
    }
}
