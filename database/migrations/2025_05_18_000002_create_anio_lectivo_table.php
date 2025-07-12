<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('anio_lectivo', function (Blueprint $table) {
            $table->id();
            $table->string('anio')->unique();
            $table->boolean('activo')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('anio_lectivo');
    }
};