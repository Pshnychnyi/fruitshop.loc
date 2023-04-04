<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToRelatedProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('related_product', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('related_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('related_product', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['related_id']);
        });
    }
}
