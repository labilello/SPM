<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIdProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('codigo_unix', 'id');
            $table->string('codigo_barras', 150)->change();
        });

        Schema::table('repairs', function (Blueprint $table) {
            $table->dropForeign('repairs_product_id_foreign');

            $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function(Blueprint $table) {
            $table->renameColumn('id', 'codigo_unix');
            $table->string('codigo_barras', 50)->change();
        });

        Schema::table('repairs', function (Blueprint $table) {
            $table->dropForeign('repairs_product_id_foreign');

            $table->foreign('product_id')
                ->references('codigo_unix')
                ->on('products');
        });
    }
}
