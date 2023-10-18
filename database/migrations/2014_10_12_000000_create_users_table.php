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
            $table->string('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('date_of_brith')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood')->nullable();
            $table->string('disease')->nullable();
            $table->bigInteger('height')->nullable();
            $table->bigInteger('weight')->nullable();
            $table->string('phone')->nullable();
            $table->bigInteger('national_id')->nullable();
            $table->longText('investigations')->nullable();
            $table->string('insurance')->nullable();
            $table->longText('insurance_card')->nullable();
            $table->longText('insurance_id')->nullable();
            $table->longText('image')->nullable()->default('images/profiles/default.jpg');
            $table->string('social_id')->nullable();
            $table->string('social')->nullable();
            $table->string('verification_code')->nullable();
            $table->tinyInteger('verified')->nullable()->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
