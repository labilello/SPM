<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();

            $table->timestamp('date_in')->default(now());
            $table->timestamp('date_out')->nullable()->default(null);
            $table->string('nro_serie', 20);
            $table->text('note')->nullable()->default("");
            $table->boolean('is_repair')->nullable()->default(null);

            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('status_id');

            $table->timestamps();

            // FOREING

            $table
                ->foreign('product_id')
                ->references('codigo_unix')
                ->on('products');

            $table
                ->foreign('status_id')
                ->references('id')
                ->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairs');
    }
}
