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
        Schema::create('visi_misis', function (Blueprint $table) {
            $table->id();
            $table->text('visi')->nullable();
            $table->text('misi_1')->nullable();
            $table->text('misi_2')->nullable();
            $table->text('misi_3')->nullable();
            $table->text('misi_4')->nullable();
            $table->text('misi_5')->nullable();
            $table->text('tujuan_1')->nullable();
            $table->text('tujuan_2')->nullable();
            $table->text('tujuan_3')->nullable();
            $table->text('tujuan_4')->nullable();
            $table->text('tujuan_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visi_misis');
    }
};
