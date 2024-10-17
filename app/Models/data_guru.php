<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_guru extends Model
{
    use HasFactory;
    protected $table = 'data_gurus';
    protected $fillable = [
        'nama',
        'nip',
        'mapel',
        'gender'
    ];
}
