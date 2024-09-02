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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->date('deadline');
            $table->string('qualification');
            $table->enum('experience', ["Internship, Junior, Mid, Senior, Lead, Managerial "]);
            $table->string('responsibilities');
            $table->string('benefits');
            $table->enum('work_type', ["onside, remote, hybrid, freelance"]);
            $table->integer('vacancies');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
