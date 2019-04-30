<?php

namespace Modules\Manager\Entities;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $table = 'tbl_employee';
    protected $primaryKey = 'id_employee';
    protected $fillable = [
        'name',
        'gender',
        'birth_place',
        'birth_date',
        'email',
        'photo',
        'id_job',
        'id_division',
        'contract_begin',
        'contract_end',
        'username',
        'password'
    ];
}
