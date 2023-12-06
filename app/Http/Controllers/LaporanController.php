<?php

namespace App\Http\Controllers;

use App\Models\DataProduksiModel;
use App\Models\KelolaPemesananModel;
use App\Models\StokBibitModel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $stok = StokBibitModel::all();
        $dataproduksi = DataProduksiModel::all();
        $kelolapemesanan = KelolaPemesananModel::paginate(5);
        return view('laporan.index', compact('stok', 'kelolapemesanan', 'dataproduksi'));
    }
}
