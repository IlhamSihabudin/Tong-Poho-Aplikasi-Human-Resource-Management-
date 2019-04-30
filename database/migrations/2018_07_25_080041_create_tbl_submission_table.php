<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_submission', function (Blueprint $table) {
            $table->increments('id_submission',10);
            $table->integer('id_employee')->length(10);
            $table->enum('leave_type',['Sakit','Izin']);
            $table->date('date_submission');
            $table->text('statement');
            $table->date('date_begin');
            $table->date('date_end');
            $table->integer('total_of_leave')->length(20);
            $table->enum('confirm_status',['Pending','Approve','Reject']);
            $table->dateTime('date_approve')->nullable();
            $table->string('approval')->nullable();
            $table->timestamps();
            $table->tinyInteger('has_read')->default('0');
        });
        // Schema::table('tbl_submission', function (Blueprint $table) {
        //     $table->foreign('id_employee')->references('id_employee')->on('tbl_employee');
        // });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_submission');
    }
}
