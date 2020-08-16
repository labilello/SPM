<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('repair_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();

            $table->timestamps();


            /* FOREIGN KEYS */

            // Usuario
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');

            // Reparacion
            $table
                ->foreign('repair_id')
                ->references('id')
                ->on('repairs');

            // Tipo
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
        Schema::dropIfExists('movements');
    }
}
