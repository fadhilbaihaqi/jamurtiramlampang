<?php

namespace App\Http\Controllers;

use App\Models\DataProduksiModel;
use App\Models\StokBibitModel;
use Illuminate\Http\Request;
use Throwable;

class StokBibitController extends Controller
{
    public function index()
    {
        $stokbibit = StokBibitModel::all();
        $stokbibitdp = DataProduksiModel::all();
        return view('stokbibit.index', compact('stokbibit', 'stokbibitdp'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'stok_bibit' => 'required',
            'tgl_produksi' => 'required',
            // 'quantity' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
        ]);

        try {
            StokBibitModel::create([
                'stok_bibit' => $request->stok_bibit,
                'tgl_produksi' => $request->tgl_produksi,
                // 'quantity' => $request->quantity,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
            ]);
            return redirect()->route('stokbibit.index')->with('success', 'Data berhasil disimpan');
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('stokbibit.index')->with('catch', 'Data harus diisi');
        }
    }

    public function update(Request $request, $id)
    {
        $validasi = [
            'stok_bibit' => 'required',
            'tgl_produksi' => 'required',
            'keterangan' => 'required',
        ];
        if ($request->harga) {
            $validasi["harga"] = 'required';
        }
        $request->validate($validasi);

        try {
            $data = [
                'stok_bibit' => $request->stok_bibit,
                'tgl_produksi' => $request->tgl_produksi,
                'keterangan' => $request->keterangan,
            ];
            if ($request->harga) {
                $data["harga"] = ($request->harga);
            }
            StokBibitModel::where('id', $id)->update($data);
            return redirect()->route('stokbibit.index')->with('success', 'Data berhasil diubah');
        } catch (Throwable $e) {
            report($e);
            return  redirect()->route('stokbibit.index')->with('catch', 'Data harus diisi');
        }
    }

    public function destroy($id)
    {
        try {
            StokBibitModel::destroy($id);
            return redirect()->route('stokbibit.index')->with('success', 'Data berhasil dihapus');
        } catch (Throwable $e) {
            report($e);
            return  redirect()->route('stokbibit.index')->with('catch', 'Data harus diisi');
        }
    }
}
