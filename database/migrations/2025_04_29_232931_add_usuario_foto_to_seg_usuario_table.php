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
        Schema::table('seg_usuario', function (Blueprint $table) {
            $table->string('usuarioFoto')->nullable()->after('usuarioEmail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seg_usuario', function (Blueprint $table) {
            //
        });
    }
};
