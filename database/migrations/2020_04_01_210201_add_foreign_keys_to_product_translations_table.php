<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductTranslationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('product_translations', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained();
            $table->string('language_slug');
            $table->foreign('language_slug')->references('slug')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('product_translations', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['language_slug']);
        });
    }
}
