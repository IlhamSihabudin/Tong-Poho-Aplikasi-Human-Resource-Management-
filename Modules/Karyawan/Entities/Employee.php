<?php

namespace Modules\Karyawan\Entities;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	public $table = 'tbl_employee';
    protected $fillable = ['name','gender','birth_place','birth_date','email','photo','password'];
    protected $primaryKey = 'id_employee';
}
