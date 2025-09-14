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
        Schema::create('coa_generation_settings_samples', function (Blueprint $table) {
            $table->id();
            $table->integer('coa_generation_setting_id');
            $table->integer('sample_id')->nullable() ;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coa_generation_settings_samples');
    }
};
