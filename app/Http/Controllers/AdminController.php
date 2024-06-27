<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $kriteriaCount = Kriteria::count();
        $alternatifCount = Alternatif::count();
        return view('admin.beranda', compact('kriteriaCount', 'alternatifCount'));
    }
}