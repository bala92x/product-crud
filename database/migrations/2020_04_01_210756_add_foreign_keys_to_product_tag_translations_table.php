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
            if (env('DB_CONNECTION') === 'sqlite') {
                $table->foreignId('product_tag_id')->nullable()->constrained();
                $table->string('language_slug')->nullable();
                $table->foreign('language_slug')->nullable()->references('slug')->on('languages');
            } else {
                $table->foreignId('product_tag_id')->constrained();
                $table->string('language_slug');
                $table->foreign('language_slug')->references('slug')->on('languages');
            }
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
            $table->dropForeign(['language_slug']);
        });
    }
}
