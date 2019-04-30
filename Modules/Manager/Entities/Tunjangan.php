<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
    public $table = 'tbl_allowance';
    protected $primaryKey = 'id_allowance';
    protected $fillable = [
        'allowance_title',
        'allowance_amount'
    ];
}
