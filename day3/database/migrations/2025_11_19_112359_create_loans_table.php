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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
           $table->foreignId('loan_type_id')->constrained('loan_types')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('principal', 10, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->decimal('total_amount', 12, 2);
            $table->integer('duration_months');
            $table->decimal('monthly_installment', 10, 2)->default(0.00);
            $table->decimal('outstanding_balance', 12, 2)->default(0.00);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
