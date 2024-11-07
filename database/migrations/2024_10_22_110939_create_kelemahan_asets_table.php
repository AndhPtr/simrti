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
        Schema::create('kelemahan_asets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_id')
                ->constrained('aset_kritis')
                ->onDelete('cascade');
            $table->string('kelemahan');
            $table->string('kebutuhan_keamanan');
            $table->string('praktik_keamanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelemahan_aset');
    }
};
