<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerDecreaseNumberOfLeave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER decrease_number_of_leave AFTER INSERT ON tbl_submission FOR EACH ROW BEGIN UPDATE tbl_employee SET number_of_leave = number_of_leave - NEW.total_of_leave WHERE id_employee = NEW.id_employee;
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
        DB::unprepared('DROP TRIGGER decrease_number_of_leave');
    }
}
