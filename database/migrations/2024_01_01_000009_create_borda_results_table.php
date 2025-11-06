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
        Schema::create('borda_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('alternative_id');
            $table->float('borda_points');
            $table->integer('final_rank');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('alternative_id')
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
        Schema::dropIfExists('borda_results');
    }
};
