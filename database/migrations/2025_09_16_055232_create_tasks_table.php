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
        Schema::create('tasks', function (Blueprint $table) {
           $table->bigIncrements('task_id');
            $table->unsignedBigInteger('project_id');

            $table->string('title');
            $table->text('description')->nullable();

            $table->unsignedBigInteger('assigned_by')->nullable(); // PM or CEO
            $table->unsignedBigInteger('assigned_to')->nullable(); // staff

            $table->enum('priority', ['low','medium','high','critical'])->default('medium');
            $table->enum('status', ['pending','in_progress','finished','completed','reassigned','cancelled'])->default('pending');

            $table->date('due_date')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();

            $table->string('github_link')->nullable();
            $table->string('file_path')->nullable(); // storage path for uploaded file

            $table->timestamps();

            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
            $table->foreign('assigned_by')->references('user_id')->on('users')->onDelete('set null');
            $table->foreign('assigned_to')->references('user_id')->on('users')->onDelete('set null');

            $table->index(['project_id', 'assigned_to', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
