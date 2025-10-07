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
            // ... trong phương thức up() của migration

Schema::create('offer_products', function (Blueprint $table) {
    $table->id(); // Khóa chính
    
    // Khóa ngoại liên kết với bảng products
    $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
    
    // Khóa ngoại liên kết với bảng offers
    $table->foreignId('offer_id')->constrained('offers')->onDelete('cascade'); 

    // Đảm bảo không có cặp (product_id, offer_id) trùng lặp
    $table->unique(['product_id', 'offer_id']); 
    
    $table->timestamps();
});
// ...
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_products');
    }
};
