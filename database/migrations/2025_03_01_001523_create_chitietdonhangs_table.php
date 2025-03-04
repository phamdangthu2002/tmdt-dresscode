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
        Schema::create('chitietdonhangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('don_hang_id')->constrained('donhangs')->onDelete('cascade');
            $table->foreignId('san_pham_id')->constrained('sanphams')->onDelete('cascade');
            $table->integer('soluong');
            $table->decimal('tong_tien', 15, 2);
            $table->integer('trang_thai_id')->default(1)->constrained('trangthais')->onDelete('cascade');
            $table->string('dia_chi');
            $table->string('sdt');
            $table->string('email');
            $table->string('ho_ten');
            $table->string('ghi_chu');
            $table->string('phuong_thuc_thanh_toan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietdonhangs');
    }
};
