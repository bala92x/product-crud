<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Services\Interfaces\ProductServiceInterface;

class CreateProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->dateTime('published_at');
            $table->dateTime('published_until')->nullable();
            $table->bigInteger('price');
            $table->string('image_path')->default('/images/default-product-image.png');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('products');
        $productService = app()->make(ProductServiceInterface::class);
        $productService->deleteAllFiles();
    }
}
