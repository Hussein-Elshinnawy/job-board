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

        Schema::create('jobs_technologies', function (Blueprint $table) {
            $table->integer('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->integer('technologies_id');
            $table->foreign('technologies_id')->references('id')->on('technologies');//? CHECK
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_technologies');
    }
};
