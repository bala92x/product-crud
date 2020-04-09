<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductsProductTagsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('products_product_tags', function (Blueprint $table) {
            if (env('DB_CONNECTION') === 'sqlite') {
                $table->foreignId('product_id')->nullable()->constrained();
                $table->foreignId('product_tag_id')->nullable()->constrained();
                $table->unique(['product_id', 'product_tag_id']);
            } else {
                $table->foreignId('product_id')->constrained();
                $table->foreignId('product_tag_id')->constrained();
                $table->unique(['product_id', 'product_tag_id']);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('products_product_tags', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['product_tag_id']);
        });
    }
}
