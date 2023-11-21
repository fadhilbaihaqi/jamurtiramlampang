<?php

namespace App\Http\Controllers;

use App\Models\DataProduksiModel;
use App\Models\StokBibitModel;
use Illuminate\Http\Request;
use Throwable;

class DataProduksiController extends Controller
{
    public function index()
    {
        $dataproduksi = DataProduksiModel::all();
        $stokbibit = StokBibitModel::all();
        return view('dataproduksi.index', compact('dataproduksi', 'stokbibit'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'stok_bibit_id' => 'required',
                'hasil_produksi' => 'required',
            ]);
            $stok = StokBibitModel::find($request->stok_bibit_id);
            $hitung = $stok->quantity + $request->hasil_produksi;
            $stok->update(['quantity' => $hitung]);
            $validatedData['user_id'] = auth()->user()->id;
            DataProduksiModel::create($validatedData);
            return redirect()->route('dataproduksi.index')->with('success', 'Data berhasil disimpan');
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('dataproduksi.index')->with('catch', 'Data harus diisi');
        }
    }

    public function update(Request $request, $id)
    {
        $validasi = [
            'stok_bibit' => 'required',
            // 'jml_produksi' => 'required',
            'hasil_produksi' => 'required',
            'keterangan' => 'required',
        ];
        if ($request->tgl_produksi) {
            $validasi["tgl_produksi"] = 'required';
        }
        $request->validate($validasi);

        try {
            $data = [
                'stok_bibit' => $request->stok_bibit,
                // 'jml_produksi' => $request->jml_produksi,
                'hasil_produksi' => $request->hasil_produksi,
                'keterangan' => $request->keterangan,
            ];
            if ($request->tgl_produksi) {
                $data["tgl_produksi"] = ($request->tgl_produksi);
            }
            DataProduksiModel::where('id', $id)->update($data);
            return redirect()->route('dataproduksi.index')->with('success', 'Data berhasil diubah');
        } catch (Throwable $e) {
            report($e);
            return  redirect()->route('dataproduksi.index')->with('catch', 'Data harus diisi');
        }
    }

    public function destroy($id)
    {
        try {
            DataProduksiModel::destroy($id);
            return redirect()->route('dataproduksi.index')->with('success', 'Data berhasil dihapus');
        } catch (Throwable $e) {
            report($e);
            return  redirect()->route('dataproduksi.index')->with('catch', 'Data harus diisi');
        }
    }
}
