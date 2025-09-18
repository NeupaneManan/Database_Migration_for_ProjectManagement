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
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('meeting_id');
            $table->string('title');
            $table->text('agenda')->nullable();

            $table->unsignedBigInteger('organizer_id')->nullable(); // CEO or PM
            $table->unsignedBigInteger('project_id')->nullable();  // project-specific meeting

            $table->enum('meeting_type', ['organization','project_group','selected_staff'])->default('selected_staff');
            $table->boolean('for_all')->default(false); // shorthand for "all staff"
            $table->dateTime('start_at');
            $table->integer('duration_minutes')->nullable();
            $table->string('location_or_link')->nullable();

            $table->timestamps();

            $table->foreign('organizer_id')->references('user_id')->on('users')->onDelete('set null');
            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('set null');

            $table->index(['start_at', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
