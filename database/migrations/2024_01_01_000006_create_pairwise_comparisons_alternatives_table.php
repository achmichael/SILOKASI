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
        Schema::create('pairwise_comparisons_alternatives', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('criteria_id');
            $table->uuid('alternative_id_1');
            $table->uuid('alternative_id_2');
            $table->float('comparison_value');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->foreign('criteria_id')
                  ->references('id')
                  ->on('criteria')
                  ->onDelete('cascade');
            
            $table->foreign('alternative_id_1')
                  ->references('id')
                  ->on('alternatives')
                  ->onDelete('cascade');
            
            $table->foreign('alternative_id_2')
                  ->references('id')
                  ->on('alternatives')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pairwise_comparisons_alternatives');
    }
};
