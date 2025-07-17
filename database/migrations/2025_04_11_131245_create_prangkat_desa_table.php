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
        Schema::create('prangkat_desa', function (Blueprint $table) {
            $table->id();
            $table->string('id_desa', 255);
            $table->string('nama', 40);
            $table->string('jabatan', 40);
            $table->text('periode');
            

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prangkat_desa');
    }
};
