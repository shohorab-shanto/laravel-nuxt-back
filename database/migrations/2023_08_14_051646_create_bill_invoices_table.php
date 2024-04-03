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
        Schema::create('bill_invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('selection_id')->unsigned()->index();
            $table->foreign('selection_id')->references('id')->on('selected_beneficiaries')->onDelete('cascade');
            $table->date('date')->nullable()->index();
            $table->decimal('sub_total', 10, 2)->nullable();
            $table->string('vat')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->string('remark')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->date('paid_date')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_invoices');
    }
};
