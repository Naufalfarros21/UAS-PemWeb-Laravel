<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatrixScore extends Model
{
    use HasFactory;

    protected $fillable = ['alternatif_id', 'c1', 'c2', 'c3', 'c4', 'c5'];

    protected $casts = [
        'c1' => 'integer',
        'c2' => 'integer',
        'c3' => 'integer',
        'c4' => 'integer',
        'c5' => 'integer',
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }
}