<<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeProductSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('home_product_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');          // Tên section
            $table->string('type')->nullable(); // featured, new, top_rated...
            $table->integer('limit')->default(10); // số sản phẩm hiển thị
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('home_product_section_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_product_section_id')->constrained('home_product_sections')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('order')->default(0); // thứ tự sản phẩm
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_product_section_product');
        Schema::dropIfExists('home_product_sections');
    }
}
