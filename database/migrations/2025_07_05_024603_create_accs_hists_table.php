<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accs_hist', function (Blueprint $table) {
            $table->increments('accs_id'); // Primary key, auto increment
            $table->date('accs_date')->index(); // Indeks
            $table->time('masuk')->nullable();
            $table->time('keluar')->nullable();
            $table->string('accs_prsn', 3);
            $table->string('status', 100);
            $table->text('kegiatan')->nullable();
            $table->dateTime('accs_added')->default(DB::raw('CURRENT_TIMESTAMP'))->useCurrentOnUpdate();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accs_hists');
    }
};
