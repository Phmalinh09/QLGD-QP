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
        Schema::create('sinhviens', function (Blueprint $table) {
            $table->id();
            $table->string("mssv");
            $table->string("hodem");
            $table->string("ten");
            $table->string("gioitinh");
            $table->string("ngaysinh");
            $table->string("dienthoai");
            $table->string("khoa");
            $table->string("dotthucte");
            $table->string("dottheokehoach");
            $table->string("trangthai");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinhviens');
    }
};
