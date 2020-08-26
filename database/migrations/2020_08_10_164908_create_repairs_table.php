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

            $table->id()->unsigned();

            $table->timestamp('date_in')->default(now());
            $table->timestamp('date_out')->nullable()->default(null);
            $table->string('nro_serie', 70);
            $table->text('note')->nullable()->default(null);
            $table->boolean('is_repair')->nullable()->default(null);

            $table->foreignId('product_id');
            $table->foreignId('status_id');

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
        Schema::dropIfExists('repairs');
    }
}
