<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeingMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movements', function (Blueprint $table) {

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
        Schema::table('movements', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('repair_id');
            $table->dropForeign('status_id');
        });
    }
}
