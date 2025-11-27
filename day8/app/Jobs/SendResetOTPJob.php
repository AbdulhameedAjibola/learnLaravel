<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendResetOTP; // FIX: Updated class name to match the Mailable provided by you

class SendResetOTPJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $email, 
        public string $token
    ) {
        // The properties are automatically assigned due to the public declaration.
    }

    /**
     * Execute the job.
     * This sends the Mailable asynchronously.
     */
    public function handle(): void
    {
        // FIX: Now passing BOTH required arguments to the Mailable's constructor.
        Mail::to($this->email)->send(new SendResetOTP($this->token, $this->email)); 
    }
}