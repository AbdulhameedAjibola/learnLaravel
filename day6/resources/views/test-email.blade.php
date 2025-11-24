<h2>Loan Payment Reminder</h2>

<p>Hello {{ $loan->user->name }},</p>

<p>Your loan of ₦{{ number_format($loan->principal, 2) }} is past the due date.</p>

<p>Please log in and make your repayment immediately to avoid penalties.</p>

<p>Thank you.</p>
