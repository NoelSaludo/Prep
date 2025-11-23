<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('difficulty', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
        });

        // Seed values
        DB::table('difficulty')->insert([
            ['name' => 'Easy'],
            ['name' => 'Medium'],
            ['name' => 'Hard']
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('difficulty');
    }
};



