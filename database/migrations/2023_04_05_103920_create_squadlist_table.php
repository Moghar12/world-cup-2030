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
        Schema::create('squadlists', function (Blueprint $table) {
            $table->id();
            $table->string("formation");

            $table->foreignId('match_id')
            ->constrained('matchs')
            ->onDelete('cascade');

            $table->foreignId('team_id')
            ->constrained('teams')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('squadlists');
    }
};
