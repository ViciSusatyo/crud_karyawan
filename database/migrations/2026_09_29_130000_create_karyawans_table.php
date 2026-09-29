<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('email')->unique();
            $table->string('jabatan', 100);
            $table->timestamps();

            $table->index('jabatan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
