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
        Schema::create('chuyennganhs', function (Blueprint $table) {
            $table->id();
            $table->string('machuyennganh');
            $table->string('tenchuyennganhtv');
            $table->string('tenchuyennganhta');
            $table->string('slug_chuyennganh');
            $table->integer('khoa');
            $table->string('trangthai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chuyennganhs');
    }
};
