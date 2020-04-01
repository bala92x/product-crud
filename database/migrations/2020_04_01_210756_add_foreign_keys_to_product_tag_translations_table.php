<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductTagTranslationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('product_tag_translations', function (Blueprint $table) {
            $table->foreignId('product_tag_id')->constrained();
            $table->foreignId('language_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('product_tag_translations', function (Blueprint $table) {
            $table->dropForeign(['product_tag_id']);
            $table->dropForeign(['language_id']);
        });
    }
}
