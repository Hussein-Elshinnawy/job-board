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

        Schema::create('jobs_categories', function (Blueprint $table) {
            $table->integer('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');// ?not sure what to do on delete
            $table->integer('category_id');
            $table->foreign('category_id')->references('id')->on('categories');// ?not sure what to do on delete
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_categories');
    }
};
