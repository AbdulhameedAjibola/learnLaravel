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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('principal', 10, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->decimal('total_amount', 10, 2);
            $table->integer('duration');
            $table->enum('duration_type', ['months', 'years'])->default('months');
            $table->date('loan_start_date');
            $table->date('expected_end_date');
            $table->enum('status', ['pending', 'approved', 'rejected', 'paid'])->default('pending');
            $table->boolean('is_due')->default(false);
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
