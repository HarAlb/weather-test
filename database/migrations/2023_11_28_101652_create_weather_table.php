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
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')
                ->references('id')
                ->on('cities')
                ->cascadeOnDelete();

            $table->double('temp');
            $table->double('temp_min');
            $table->double('temp_max');
            $table->bigInteger('humidity');

            $table->date('date');
            $table->timestamps();

            $table->index(['city_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
