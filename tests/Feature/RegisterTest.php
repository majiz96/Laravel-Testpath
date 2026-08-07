<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use Livewire\Livewire;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Notification;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use refreshDatabase, WithFaker;

    public function test_the_register_route()
    {
        Notification::fake();

        Livewire::test(Register::class)
            ->set('name', 'Test')
            ->set('email','test@mail.com')
            ->set('password', 'Abc#123D')
            ->set('password_confirmation', 'Abc#123D')
            ->call('register');

        $this->assertDatabaseHas('users', ['email'=>'test@mail.com']);
    }
    public function test_the_register_password_validation()
    {
        Notification::fake();

        Livewire::test(Register::class)
            ->set('name', 'Test')
            ->set('email','test@mail.com')
            ->set('password', 'Abc')
            ->set('password_confirmation', 'Abc')
            ->call('register');

        $this->assertDatabaseMissing('users', ['email'=>'test@mail.com']);
    }
    public function test_the_register_password_validation3()
    {
        Notification::fake();

        Livewire::test(Register::class)
            ->set('name', 'Test')
            ->set('email','test@mail.com')
            ->set('password', 'abcd123e')
            ->set('password_confirmation', 'abcd123e')
            ->call('register');

        $this->assertDatabaseHas('users', ['email'=>'test@mail.com']);
    }

    public function test_register_reject_short_password()
    {
        Notification::fake();
        Livewire::test(Register::class)
            ->set('name', 'Test')
            ->set('email','test@mail.com')
            ->set('password', 'Abc')
            ->set('password_confirmation', 'Abc')
            ->call('register')
            ->assertHasErrors(['password']);
    }
    public function test_register_reject_wrong_password_confirmation()
    {
        Notification::fake();
        Livewire::test(Register::class)
            ->set('name', 'Test')
            ->set('email','test@mail.com')
            ->set('password', 'Abc')
            ->set('password_confirmation', 'Abc1')
            ->call('register')
            ->assertHasErrors(['password']);

    }
    public function test_register_reject_duplicate_email()
    {
        Notification::fake();

        User::factory()->create([
           'email'=>'test@mail.com'
        ]);

        Livewire::test(Register::class)
            ->set('name', 'Test')
            ->set('email','test@mail.com')
            ->set('password', 'Abcdefg1')
            ->set('password_confirmation', 'Abcdefg1')
            ->call('register')
            ->assertHasErrors(['email']);

    }

    public function test_register_send_notification()
    {
        Notification::fake();
        Livewire::test(Register::class)
            ->set('name', 'Test')
            ->set('email','test@mail.com')
            ->set('password', 'Abc#123D')
            ->set('password_confirmation', 'Abc#123D')
            ->call('register');

        $user = User::where('email','test@mail.com')->first();

        $this->assertNotNull($user);
        Notification::assertSentTo($user,WelcomeNotification::class);
    }

}
