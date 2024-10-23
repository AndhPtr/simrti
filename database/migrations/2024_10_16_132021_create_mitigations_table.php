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
        Schema::create('mitigations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('risk_id') // Create a foreign key column for the risk table
                ->constrained('risks') // References the id column in the risks table
                ->onDelete('cascade'); // Add cascade on delete if you want to remove mitigations when a risk is deleted
            $table->string('tindakan_mitigasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitigations');
    }
};
