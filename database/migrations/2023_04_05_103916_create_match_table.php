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
        Schema::create('matchs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->dateTime('date');
            $table->boolean('isTicket');
            $table->integer('price')->nullable();
            $table->integer('ticketsNumber')->nullable();
            $table->foreignId('field_id')
            ->constrained('fields')
            ->onDelete('cascade');

            $table->foreignId('referee_id')
            ->constrained('referees')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchs');
    }
};
