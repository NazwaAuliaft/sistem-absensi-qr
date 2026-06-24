<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status'
    ];
}