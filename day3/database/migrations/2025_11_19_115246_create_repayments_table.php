<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repayments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained('loans')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('installment_amount', 10, 2);
            $table->decimal('remaining_balance', 12, 2)->default(0.00);
            $table->date('payment_date');
            $table->enum('payment_status', ['paid', 'processing', 'failed']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repayments');
    }
};
