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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('address')->nullable();
            $table->string('national_id')->nullable();
            $table->string('admission_time')->nullable();
            $table->string('admission_date')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('surgical_procedure')->nullable();
            $table->string('insurance')->nullable();
            $table->bigInteger('room_number')->nullable();
            $table->string('physician')->nullable();
            $table->bigInteger('physician_code')->nullable();
            $table->string('relative_name')->nullable();
            $table->string('degree')->nullable();
            $table->string('relative_national_id')->nullable();
            $table->string('relative_phone')->nullable();
            $table->string('relative_another_phone')->nullable();
            $table->string('type')->nullable();
            $table->longtext('patient_form')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
