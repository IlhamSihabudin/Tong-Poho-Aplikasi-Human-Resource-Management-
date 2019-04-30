<?php

namespace Modules\Karyawan\Entities;

use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
     protected $fillable = ['id_employee','clock_in','clock_out','absent_status',];
     public $timestamps = false;
     public $table = "tbl_absent";
}
