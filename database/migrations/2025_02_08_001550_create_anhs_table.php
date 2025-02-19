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
        Schema::create('anhs', function (Blueprint $table) {
            $table->id();
            $table->string('ten_anh');
            $table->string('url_anh');
            $table->foreignId('san_pham_id')->constrained('sanphams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anhs');
    }
};
