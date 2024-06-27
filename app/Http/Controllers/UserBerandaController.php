<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserBerandaController extends Controller
{
    function index()
    {
        return view("user.indexu");
    }
}
