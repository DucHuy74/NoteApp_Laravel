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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();

            // Tạo cột user_id và thiết lập khóa ngoại liên kết với bảng users
            $table->foreignId('user_id')
                  ->constrained()   // tự động tham chiếu đến bảng users, cột id
                  ->onDelete('cascade');  // khi user bị xóa thì các note liên quan cũng bị xóa

            $table->string('title');
            $table->longText('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};