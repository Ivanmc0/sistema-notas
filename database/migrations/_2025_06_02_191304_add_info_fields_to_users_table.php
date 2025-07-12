<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('documento')->nullable()->after('email');
            $table->string('tipo_documento')->nullable()->after('documento');
            $table->string('direccion')->nullable()->after('tipo_documento');
            $table->string('telefono')->nullable()->after('direccion');
            $table->string('celular')->nullable()->after('telefono');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['documento', 'tipo_documento', 'direccion', 'telefono', 'celular']);
        });
    }
};
