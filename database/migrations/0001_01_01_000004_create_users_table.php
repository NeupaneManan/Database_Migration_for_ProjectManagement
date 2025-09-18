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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('id_no')->unique(); // National/Employee ID
            $table->string('name');
            $table->string('address')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->date('dob')->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_picture')->nullable(); // store file path
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->string('blood_group', 5)->nullable(); // e.g., A+, B-
            $table->string('id_image')->nullable(); // scanned ID card path

            // role relationship
            $table->foreignId('role_id')->constrained('roles', 'role_id')->onDelete('cascade');
            
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
