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
        Schema::create('lops', function (Blueprint $table) {
            $table->id();
            $table->string('malop');
            $table->string('tenlop');
            $table->integer('khoa_id');
            $table->integer('chuyennganh_id');
            $table->integer('siso');
            $table->integer('nienkhoa');
            $table->string('trangthai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lops');
    }
};
