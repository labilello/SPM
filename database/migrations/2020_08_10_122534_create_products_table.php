<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('codigo_unix');
            $table->string('descripcion', 50);
            $table->string('marca', 50);
            $table->string('familia', 50);
            $table->string('codigo_barras', 50);
            $table->string('codigo_unico');
            $table->float('costo_reposicion');
            $table->float('iva');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
