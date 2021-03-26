<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftdeletToModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('movements', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('repairs', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('shipments', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('makepcs', function (Blueprint $table) {
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('movements', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('makepcs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
