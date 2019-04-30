<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForgotAbsent extends Model
{
    protected $table = 'tbl_forgot_absent';
    protected $primaryKey = 'id_forgot';
    protected $fillable = ['id_employee','date','attachment','statement'];
}
