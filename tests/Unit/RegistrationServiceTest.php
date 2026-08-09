<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Services\NotificationService;
use App\Services\RegistrationService;

class RegistrationServiceTest extends TestCase
{
    public function test_registration_test_can_send_welcome_email(): void
    {
        $notification = $this->createMock(NotificationService::class);

        $notification->expects($this->once())
            ->method('sendWelcome')
            ->with('test@example.com')
            ->willReturn(true);

        $service = new RegistrationService($notification);

        $result = $service->register('test@example.com');

        $this->assertTrue($result);
    }
}
