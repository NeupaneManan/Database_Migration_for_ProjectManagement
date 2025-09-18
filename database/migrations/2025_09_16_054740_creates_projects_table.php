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
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('project_id');
            $table->string('title');
            $table->text('description')->nullable();

            // PM for the project (user_id from users)
            $table->unsignedBigInteger('pm_id')->nullable();
            // who created/assigned the project (usually CEO)
            $table->unsignedBigInteger('created_by')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['planning','active','on_hold','completed','cancelled'])->default('planning');

            $table->timestamps();

            $table->foreign('pm_id')->references('user_id')->on('users')->onDelete('set null');
            $table->foreign('created_by')->references('user_id')->on('users')->onDelete('set null');
            $table->index('pm_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
