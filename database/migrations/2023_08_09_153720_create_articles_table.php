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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('author');
            $table->string('title');
            $table->string('title_ar');
            $table->longText('description');
            $table->longText('description_ar');
            $table->longText('content');
            $table->longText('content_ar');
            $table->string('tags');
            $table->string('tags_ar');
            $table->longText('image')->default('images/articles/thumbnails/default.png');
            $table->longText('image_ar')->default('images/articles/thumbnails/default.png');
            $table->tinyInteger('verified')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
