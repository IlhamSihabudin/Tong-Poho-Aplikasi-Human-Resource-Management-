<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_employee', function (Blueprint $table) {
            $table->increments('id_employee',10);
            $table->string('name',100);
            $table->enum('gender',['L','P'])->nullable();
            $table->string('birth_place',50)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('email',100)->unique();
            $table->string('photo',100)->nullable();
            $table->integer('id_job')->length(10)->nullable();
            $table->integer('id_division')->length(10)->nullable();
            $table->date('contract_begin')->nullable();
            $table->date('contract_end')->nullable();
            $table->integer('number_of_leave')->length(2)->nullable();
            $table->string('password',100);
            $table->rememberToken();
            $table->timestamps();
        });
        // Schema::table('tbl_employee', function (Blueprint $table) {
        //     $table->foreign('id_job')->references('id_job')->on('tbl_job');
        //     $table->foreign('id_division')->references('id_division')->on('tbl_division');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_employee');
    }
}
