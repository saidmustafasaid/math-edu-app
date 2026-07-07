<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formulas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('formula');
            $table->text('description')->nullable();
            $table->string('subject');
            $table->enum('level', ['primary', 'secondary', 'highschool', 'university']);
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formulas');
    }
};
