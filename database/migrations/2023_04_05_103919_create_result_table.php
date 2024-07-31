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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->integer('team1_goals');
            $table->integer('team2_goals');
            $table->float('team1_possession');
            $table->float('team2_possession');
            $table->integer('fullTime');
            $table->foreignId('winner_id')
            ->constrained('teams')
            ->onDelete('cascade');
            
            $table->foreignId('match_id')
            ->constrained('matchs')
            ->onDelete('cascade');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
