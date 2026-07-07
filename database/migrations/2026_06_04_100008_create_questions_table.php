<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests')->onDelete('cascade');
            $table->text('question_text');
            $table->string('option_a', 500)->nullable();
            $table->string('option_b', 500)->nullable();
            $table->string('option_c', 500)->nullable();
            $table->string('option_d', 500)->nullable();
            $table->string('correct_answer', 1);
            $table->integer('marks')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
