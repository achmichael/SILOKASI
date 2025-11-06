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
        Schema::create('criteria_dependencies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('criteria_id_from');
            $table->uuid('criteria_id_to');
            $table->float('dependency_value');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('criteria_id_from')
                  ->references('id')
                  ->on('criteria')
                  ->onDelete('cascade');
            
            $table->foreign('criteria_id_to')
                  ->references('id')
                  ->on('criteria')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria_dependencies');
    }
};
