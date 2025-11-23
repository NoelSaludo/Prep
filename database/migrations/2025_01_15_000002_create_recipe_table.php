<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipe', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->text('instruction')->nullable();
            $table->integer('min_calorie')->nullable();
            $table->integer('max_calorie')->nullable();

            $table->unsignedBigInteger('difficulty_id')->nullable();
            $table->foreign('difficulty_id')->references('id')->on('difficulty');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipe');
    }
};
