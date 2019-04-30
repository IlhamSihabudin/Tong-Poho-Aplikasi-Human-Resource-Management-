<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerIncreaseNumberOfLeave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER increase_number_of_leave AFTER DELETE ON tbl_submission FOR EACH ROW BEGIN UPDATE tbl_employee SET number_of_leave = number_of_leave + OLD.total_of_leave WHERE id_employee = OLD.id_employee;
            END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::unprepared('DROP TRIGGER increase_number_of_leave');
    }
}
