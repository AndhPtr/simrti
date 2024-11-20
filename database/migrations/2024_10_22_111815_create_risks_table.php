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
        Schema::create('risks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_id')
                ->constrained('aset_kritis')
                ->onDelete('cascade');
            $table->string('risiko');
            $table->string('penyebab');
            $table->string('dampak');
            $table->unsignedTinyInteger('severity')->nullable();
            $table->unsignedTinyInteger('occurence')->nullable();
            $table->unsignedTinyInteger('detection')->nullable();
            $table->unsignedInteger('rpn')->nullable();
            $table->string('rpn_level')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE risks ADD CONSTRAINT chk_severity CHECK (severity >= 1 AND severity <= 10)');
        DB::statement('ALTER TABLE risks ADD CONSTRAINT chk_occurence CHECK (occurence >= 1 AND occurence <= 10)');
        DB::statement('ALTER TABLE risks ADD CONSTRAINT chk_detection CHECK (detection >= 1 AND detection <= 10)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risks');
    }
};
