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
        Schema::create('latrine_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('selection_id')->unsigned()->index();
            $table->foreign('selection_id')->references('id')->on('selected_beneficiaries')->onDelete('cascade');
            $table->foreignId('status_id')->constrained()->onDelete('cascade');
            $table->date('date')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latrine_status_logs');
    }
};
