<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $table = 'tbl_reason';
    protected $primaryKey = 'id_reason';
    protected $fillable  = ['reason'];
}
