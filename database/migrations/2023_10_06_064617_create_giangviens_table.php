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
        Schema::create('giangviens', function (Blueprint $table) {
            $table->id();
            $table->string('magv');
            $table->string('tengv');
            $table->string('email');
            $table->string('sdt');
            $table->string("trangthai");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giangviens');
    }
};
