<?php

namespace Tests\Feature;

use App\Jobs\SendWelcomeJob;
use App\Mail\TestWelcomeMail;
use App\Mail\TestSimpleMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QueueTest extends TestCase
{

    public function test_send_welcome_job_is_dispatching()
    {
        Queue::fake();

        $str = "Test";

        SendWelcomeJob::dispatch($str);
        Queue::assertPushed(SendWelcomeJob::class);
    }

    public function test_send_welcome_job_is_sending_mail()
    {
       Mail::fake();

       $job = new SendWelcomeJob('Test');

       $job->handle();

       Mail::assertSent(TestWelcomeMail::Class , function($mail){
           return $mail->hasTo('test@example.com');
       });
    }

    public function test_mail_subject_is_correct()
    {
        $mail = new TestSimpleMail();

        $mail->assertHasSubject('Test Simple Mail');
    }

    public function test_mail_content_is_correct()
    {
        $mail = new TestSimpleMail();

        $mail->assertSeeInHtml('Hello Test');
    }

}
