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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->nullable()->index();
            $table->string('name')->nullable();
            $table->string('nid', 20)->unique()->nullable()->index();
            $table->string('phone', 14)->nullable()->unique()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('terms')->default(0);
            $table->boolean('status')->default(1)->comment('1=>yes, 0=>no');
            $table->string('religion')->nullable();
            $table->string('gender')->nullable();
            $table->multiLineString('photo')->nullable();
            $table->string('type', 20)->enum(['official', 'le'])->default('official')->comment('le, official')->index();
            $table->foreignId('designation_id')->nullable()->constrained();
            $table->bigInteger('division_id')->nullable()->index();
            $table->bigInteger('district_id')->nullable()->index();
            $table->bigInteger('upazila_id')->nullable()->index();
            $table->bigInteger('union_id')->nullable()->index();
            $table->bigInteger('ward_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
