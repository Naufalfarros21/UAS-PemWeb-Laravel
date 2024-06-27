<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seleksi extends Model
{
    use HasFactory;

    protected $table = 'seleksi';

    protected $fillable = [
        'name',
        'kode',
        'C1',
        'C2',
        'C3',
        'C4',
        'C5'
    ];
}