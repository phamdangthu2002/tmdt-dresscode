<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('size_sp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('size_id');  // Khóa ngoại tới bảng sizes
            $table->unsignedBigInteger('san_pham_id');  // Khóa ngoại tới bảng sanphams
            $table->timestamps();

            // Định nghĩa khóa ngoại
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
            $table->foreign('san_pham_id')->references('id')->on('sanphams')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('size_sp');
    }
};
