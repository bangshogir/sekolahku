<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->index();
            $table->text('user_agent')->nullable();
            $table->date('visited_date')->index();
            $table->timestamps();

            // To prevent multiple entries per day per IP
            $table->unique(['ip_address', 'visited_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
