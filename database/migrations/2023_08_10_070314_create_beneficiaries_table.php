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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->unique()->index();
            $table->string('type')->default('beneficiary')->index();
            $table->string('password');
            $table->longText('address')->nullable();
            $table->bigInteger('nid')->unique()->index();
            $table->multiLineString('photo')->nullable();
            $table->tinyInteger('status')->nullable();

            $table->string('religion')->nullable();
            $table->string('gender')->nullable();

            $table->double('latitude')->default(10, 8)->nullable()->index();
            $table->double('longitude')->default(11, 8)->nullable()->index();

            $table->bigInteger('division_id')->nullable()->index();
            $table->bigInteger('district_id')->nullable()->index();
            $table->bigInteger('upazila_id')->nullable()->index();
            $table->bigInteger('union_id')->nullable()->index();
            $table->bigInteger('ward_id')->nullable()->index();
            $table->boolean('is_selected')->enum('1=>yes', '0=>no')->nullable()->index();

            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
