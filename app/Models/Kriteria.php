<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';

    protected $fillable = [
        'name',
        'kode',
        'keterangan',
        'bobot',
        'tipe'
    ];

    protected $casts = [
        'bobot' => 'integer',
    ];
}