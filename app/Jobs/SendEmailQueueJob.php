<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MyMail;
use Mail;

class SendEmailQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $send_mail;
    protected $send_name;
    /**
     * Create a new job instance.
     */
    public function __construct($send_mail,$name)
    {
        $this->send_mail = $send_mail;
        $this->send_name = $name;
    }
  
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data['email'] = $this->send_mail;
        $data['name'] = $this->send_name;

    Mail::send('emails.send-mail', $data, function($message)use($data) {
        $message->from('shakirfaisalktk873@gmail.com','Shakir Faisal')
        ->to($data['email'], $data['email'])
        ->subject("Email Test");                
    });
    }
}

