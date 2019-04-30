<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAbsentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_absent', function (Blueprint $table) {
            $table->increments('id_absent',10);
            $table->integer('id_employee')->length(10);
            $table->dateTime('clock_in');
            $table->dateTime('clock_out')->nullable();
            $table->enum('absent_status',['Hadir','Sakit','Izin','Alpa']);
        });
        // Schema::table('tbl_absent', function (Blueprint $table) {
        //    $table->foreign('id_employee')->references('id_employee')->on('tbl_employee');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_absent');
    }
}
