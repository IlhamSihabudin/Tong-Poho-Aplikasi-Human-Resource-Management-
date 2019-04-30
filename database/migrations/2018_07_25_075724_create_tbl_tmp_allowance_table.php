<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblTmpAllowanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tmp_allowance', function (Blueprint $table) {
            $table->increments('id_tmp',10);
            $table->integer('id_employee')->length(10);
            $table->integer('id_allowance')->length(10);
            $table->timestamps();
        });
        //  Schema::table('tbl_tmp_allowance', function (Blueprint $table) {
        //     $table->foreign('id_employee')->references('id_employee')->on('tbl_employee');
        //     $table->foreign('id_allowance')->references('id_allowance')->on('tbl_allowance');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_tmp_allowance');
    }
}
