<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('img_dataset', function (Blueprint $table) {
            $table->increments('img_id'); // Primary key, int(11), auto increment
            $table->string('img_person', 3); // varchar(3)
            $table->string('img_path'); // path file gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('img_datasets');
    }
};
