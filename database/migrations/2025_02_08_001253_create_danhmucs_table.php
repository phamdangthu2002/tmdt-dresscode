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
        Schema::create('danhmucs', function (Blueprint $table) {
            $table->id(); // Laravel sẽ tạo cột id (bigIncrements)
            $table->string('ten_danh_muc');
            $table->string('mo_ta')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->unsignedBigInteger('danh_muc_id')->nullable(); // Khóa ngoại tham chiếu chính bảng này
            $table->enum('trang_thai', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Khai báo khóa ngoại
            $table->foreign('danh_muc_id')->references('id')->on('danhmucs')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danhmucs');
    }
};
