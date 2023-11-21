<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaPemasaranController extends Controller
{
    public function index()
    {
        return view('kelola_pemasaran.index');
    }
}
