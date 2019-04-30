<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotPresent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_not_present',function(Blueprint $table){
            $table->increments('id_not_present');
            $table->integer('id_reason');
            $table->integer('id_employee');
            $table->text('statement');
            $table->date('date_start');
            $table->date('date_end');
            $table->text('destination_address');
            $table->string('attachment');
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
        //
    }
}
