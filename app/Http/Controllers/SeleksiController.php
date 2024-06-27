<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeleksiController extends Controller
{
    function seleksi()
    {
        return view("admin.seleksi");
    }
}
