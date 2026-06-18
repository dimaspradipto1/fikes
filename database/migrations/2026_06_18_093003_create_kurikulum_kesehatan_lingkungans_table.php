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
        Schema::create('kurikulum_kesehatan_lingkungans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk');
            $table->text('mata_kuliah');
            $table->string('semester');
            $table->integer('jumlah_sks');
            $table->text('link_rps')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurikulum_kesehatan_lingkungans');
    }
};
