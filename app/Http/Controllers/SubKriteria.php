<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubKriteria extends Controller
{
    function sub_kriteria()
    {
        return view("admin.subKriteria");
    }
}