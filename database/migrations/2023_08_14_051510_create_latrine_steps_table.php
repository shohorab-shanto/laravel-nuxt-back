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
        Schema::create('latrine_steps', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Plot image')->comment('Plot image,Twin pit image,Interior image,Exterior with beneficiary image,Site completion/ Handover image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latrine_steps');
    }
};
