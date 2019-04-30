<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
	public $table = 'tbl_employee';
    protected $fillable = ['name','gender','birth_place','birth_date','email','photo','id_job','id_division','contract_begin','contract_end','number_of_leave','username','password'];
    protected $primaryKey = 'id_employee';
}