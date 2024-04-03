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
        Schema::create('latrine_progress', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('selection_id')->unsigned()->index();
            $table->foreign('selection_id')->references('id')->on('selected_beneficiaries')->onDelete('cascade');
            $table->bigInteger('step_id')->unsigned()->index();
            $table->foreign('step_id')->references('id')->on('latrine_steps')->onDelete('cascade');

            $table->boolean('is_completed')->default(0)->comment('0=>no, 1=>yes');
            $table->boolean('out_of_location')->default(0)->comment('0=>no, 1=>yes');
            $table->multiLineString('photo')->nullable();

            $table->double('latitude')->default(10, 8)->nullable()->index();
            $table->double('longitude')->default(11, 8)->nullable()->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latrine_progress');
    }
};
