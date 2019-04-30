<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;

class AbsentManager extends Model
{
    protected $primaryKey = 'id_absent';
    protected $fillable = ['id_employee','clock_in','clock_out','absent_status',];
    public $timestamps = false;
    public $table = "tbl_absent";
}
