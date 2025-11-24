<?php

namespace App\Http\Controllers;

use App\Jobs\SendLoanReminderJob;
use Illuminate\Http\Request;
use App\Models\Loan;

class EmailController extends Controller
{
    public function sendEmail()
{
    $overdueLoans = Loan::where('is_due', true)->get();

    foreach ($overdueLoans as $loan) {
        SendLoanReminderJob::dispatch($loan->id);
    }

    return response()->json(['message' => 'Loan reminder jobs dispatched']);
}

}
