<?php

namespace Modules\Karyawan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengajuan extends Model
{
	public $table = "tbl_submission";
	protected $primaryKey = 'id_submission';
    protected $fillable = ['id_employee','leave_type','date_submission','statement','date_begin','date_end','total_of_leave','confirm_status','has_read'];
}
