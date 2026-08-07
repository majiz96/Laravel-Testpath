<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Livewire\Dashboard\Home;
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
            ->set('password', 'Abc#123D')
            ->set('password_confirmation', 'Abc#123D')
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

    public function test_user_can_register()
    {
        Notification::fake();
        Livewire::test(Register::class)
            ->set('name', 'Test')
            ->set('email','test@mail.com')
            ->set('password', 'Abc#123D')
            ->set('password_confirmation', 'Abc#123D')
            ->call('register');

        $this->assertAuthenticated();
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->assertAuthenticated();

        Livewire::test(Home::class)->call('logout');

        $this->assertGuest();
    }

   public function test_redirect_after_logout()
   {
       $user = User::factory()->create();
       $this->actingAs($user);

       $component = Livewire::test(Home::class)->call('logout');

       $component->assertRedirect(config('fortify.home'));

   }

   public function test_guest_cannot_access_home()
   {
       $response = $this->get('/home');

       $response->assertRedirect('/login');
   }

   public function test_user_can_access_home()
   {
       $user = User::factory()->create();


       $response = $this->actingAs($user)->get('/home');
       $response->assertOk();
   }

   public function test_event_can_be_dispatched()
   {
       Event::fake();

       Notification::fake();

       Livewire::test(Register::class)
           ->set('name', 'Test')
           ->set('email','someone@mail.com')
           ->set('password', 'Abc#123D')
           ->set('password_confirmation', 'Abc#123D')
           ->call('register');

       Event::assertDispatched(Registered::class);
   }

   public function test_event_can_email_is_correct()
   {
       Event::fake();
       Notification::fake();

       Livewire::test(Register::class)
           ->set('name', 'Test')
           ->set('email','someone@mail.com')
           ->set('password', 'Abc#123D')
           ->set('password_confirmation', 'Abc#123D')
           ->call('register');

       Event::assertDispatched(Registered::class, function (Registered $event) {
           return $event->user->email === 'someone@mail.com';
       });
   }


}
