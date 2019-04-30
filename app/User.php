<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tbl_employee';
    protected $primaryKey = 'id_employee';
    protected $fillable = [
        'name', 'email', 'password','id_job'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Admin()
    {
        return $this->id_job == "1";
    }
    public function Manager()
    {
        return $this->id_job == "2";
    }
    public function Karyawan()
    {
        return $this->id_job == "3";
    }
}
