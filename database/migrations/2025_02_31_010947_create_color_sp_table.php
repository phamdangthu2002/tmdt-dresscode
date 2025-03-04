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
        Schema::create('color_sp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('color_id');  // Khóa ngoại tới bảng colors
            $table->unsignedBigInteger('san_pham_id');  // Khóa ngoại tới bảng sanphams
            $table->timestamps();

            // Định nghĩa khóa ngoại
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->foreign('san_pham_id')->references('id')->on('sanphams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_sp');
    }
};
