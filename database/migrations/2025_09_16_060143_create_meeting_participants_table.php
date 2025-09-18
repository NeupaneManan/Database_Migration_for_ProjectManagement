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
        Schema::create('meeting_participants', function (Blueprint $table) {
           $table->unsignedBigInteger('meeting_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['invited','accepted','declined','maybe'])->default('invited');
            $table->timestamp('notified_at')->nullable();
            $table->timestamps();

            $table->primary(['meeting_id','user_id']);

            $table->foreign('meeting_id')->references('meeting_id')->on('meetings')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_participants');
    }
};
