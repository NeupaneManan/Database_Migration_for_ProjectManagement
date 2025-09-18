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
        Schema::create('task_submissions', function (Blueprint $table) {
              $table->bigIncrements('submission_id');
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('user_id'); // who submitted
            $table->string('github_link')->nullable();
            $table->string('file_path')->nullable();
            $table->text('notes')->nullable();

            $table->enum('review_status', ['pending','approved','reassigned','rejected'])->default('pending');
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();

            $table->foreign('task_id')->references('task_id')->on('tasks')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('reviewed_by')->references('user_id')->on('users')->onDelete('set null');

            $table->index(['task_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_submissions');
    }
};
