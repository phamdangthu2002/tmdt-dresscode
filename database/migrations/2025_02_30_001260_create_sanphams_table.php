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
        Schema::create('sanphams', function (Blueprint $table) {
            $table->id();
            $table->string('tensp');
            $table->string('slug')->unique();
            $table->foreignId('danh_muc_id')->constrained('danhmucs')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');
            $table->string('anhsp');
            $table->decimal('gia_goc', 15, 2);
            $table->decimal('gia_km_phan_tram', 5, 2)->nullable()->default(0); // Mặc định là 0% giảm giá
            $table->text('mo_ta')->nullable(); // Dùng text thay vì string nếu mô tả dài
            $table->text('mota_chitiet')->nullable();
            $table->enum('trang_thai', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanphams');
    }
};
