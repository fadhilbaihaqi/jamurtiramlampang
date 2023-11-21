<?php

namespace App\Http\Controllers;

use App\Models\KelolaPemesananModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $Totaluser = User::count();
        $Totalkonsumen = User::where('role_id', 2)->count();
        $Totalpemesanan = KelolaPemesananModel::count();
        return view('dashboard.index', compact('Totalpemesanan', 'Totaluser', 'Totalkonsumen'));
    }
}
