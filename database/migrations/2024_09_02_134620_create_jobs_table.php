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
        Schema::disableForeignKeyConstraints();

        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employer_id');
            $table->foreign('employer_id')->references('id')->on('companies')->onDelete('CASCADE');//? CHECK
            $table->string('title');
            $table->string('description');
            $table->integer('city_id');
            $table->foreign('city_id')->references('id')->on('city')->onDelete('set null'); //? CHECK
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->date('deadline');
            $table->string('qualification');
            $table->enum('experience', ["Internship, Junior, Mid, Senior, Lead, Managerial "]);
            $table->string('responsibilities');
            $table->string('benefits');
            $table->enum('work_type', ["onside, remote, hybrid, freelance"]);
            $table->integer('technology_id');
            $table->integer('vacancies');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
