<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;

class TmpTunjangan extends Model
{
    public $table = 'tbl_tmp_allowance';
    protected $primaryKey = 'id_tmp';
    protected $fillable = [
        'id_employee',
        'id_allowance'
    ];
}
