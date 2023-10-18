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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_id')->nullable();
            $table->string('patient')->nullable();
            $table->bigInteger('doctor_id')->nullable();
            $table->string('doctor')->nullable();
            $table->string('date')->nullable();
            $table->string('day')->nullable();
            $table->string('hour')->nullable();
            $table->longText('history')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('laboratory')->nullable();
            $table->string('radiology')->nullable();
            $table->string('medicine')->nullable();
            $table->string('lab_img')->nullable();
            $table->string('rad_img')->nullable();
            $table->string('med_img')->nullable();
            $table->string('status')->default('on_progress')->nullable();
            $table->string('user_state')->default('available')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
