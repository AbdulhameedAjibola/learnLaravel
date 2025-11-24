<?php
namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Log;
use App\Models\Loan;

class SendLoanReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $loanId;
    
    public function __construct($loanId)
    {
        $this->loanId = $loanId;
    }

    public function handle(): void
    {
        $loan = Loan::with('user')->find($this->loanId);
        
        // Add return statement here to stop execution
        if (!$loan || !$loan->user) {
            Log::error("Loan {$this->loanId} has no user or doesn't exist.");
            return; // This is the critical fix!
        }
        
        Mail::to($loan->user->email)->send(new SendMailable($loan));
    }
}