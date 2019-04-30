<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	public $table = 'tbl_job';
    protected $fillable = ['id_job','job','salary'];
    protected $primaryKey = 'id_job';
}
