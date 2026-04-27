<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // Nama prestasi / juara
            $table->string('competition_type');  // Jenis lomba
            $table->enum('level', [
                'sekolah',
                'kecamatan',
                'kabupaten',
                'provinsi',
                'nasional',
                'internasional',
            ])->default('kabupaten');
            $table->year('year');
            $table->string('certificate_photo')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
