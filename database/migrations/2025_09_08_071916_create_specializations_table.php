<?php
// database/migrations/2025_09_08_000003_create_specializations_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('specializations', function (Blueprint $table) {
            $table->id('specialization_id');
            $table->string('specialization_name')->unique();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('specializations');
    }
};
