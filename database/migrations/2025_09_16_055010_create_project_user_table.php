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
        Schema::create('project_user', function (Blueprint $table) {
           $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('user_id'); // staff or other user

            $table->enum('role_in_project', ['staff','viewer'])->default('staff'); // optional role label within project
            $table->timestamp('assigned_at')->useCurrent();

            $table->primary(['project_id', 'user_id']);

            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_user');
    }
};
