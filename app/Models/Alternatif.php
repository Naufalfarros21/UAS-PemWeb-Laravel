<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';

    protected $fillable = [
        'name',
        'kode',
        'keterangan'
    ];

    public function matrixScores()
    {
        return $this->hasMany(MatrixScore::class);
    }
}
