<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotPresent extends Model
{
    protected $table = 'tbl_not_present';
    protected $primaryKey = 'id_not_present';
    protected $fillable = ['id_reason','id_employee','statement','date_start','date_end','destination_address','attachment'];
}
