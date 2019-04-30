<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
	public $table = 'tbl_division';
    protected $fillable = ['id_division','division'];
    protected $primaryKey = 'id_division';

}
