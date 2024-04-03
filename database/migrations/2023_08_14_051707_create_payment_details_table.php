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
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_invoice_id')->constrained()->onDelete('cascade');
            $table->string('payment_method')->nullable()->comment('cash, check, bank');
            $table->bigInteger('check_no')->nullable()->index();
            $table->date('check_date')->nullable()->index();
            $table->bigInteger('paid_by')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
