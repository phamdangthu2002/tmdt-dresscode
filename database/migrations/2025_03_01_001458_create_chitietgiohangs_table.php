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
        Schema::create('chitietgiohangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gio_hang_id')->constrained('giohangs')->onDelete('cascade');
            $table->foreignId('san_pham_id')->constrained('sanphams')->onDelete('cascade');
            $table->integer('so_luong'); // Mặc định số lượng là 1
            $table->integer('size_id'); // Size sản phẩm
            $table->decimal('gia', 15, 2); // Giá sản phẩm tại thời điểm mua
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietgiohangs');
    }
};
