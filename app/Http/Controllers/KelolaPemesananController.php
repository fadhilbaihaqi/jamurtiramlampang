<?php

namespace App\Http\Controllers;

use App\Models\DataProduksiModel;
use App\Models\KelolaPemesananModel;
use App\Models\StokBibitModel;
use Illuminate\Http\Request;
use Throwable;

class KelolaPemesananController extends Controller
{
    public function index()
    {
        if ((strtolower(auth()->user()->role->role) == strtolower('konsumen'))) {
            $kelolapemesanan = KelolaPemesananModel::where('user_id', auth()->user()->id)->orderBy('user_id', 'asc')->paginate(5);
        } else {
            $kelolapemesanan = KelolaPemesananModel::paginate(5);
        }
        $stokbibit = StokBibitModel::all();
        return view('kelola_pemesanan.index', compact('kelolapemesanan', 'stokbibit'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'jumlah_pemesanan' => 'required',
                'stok_bibit_id' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
            ]);
            $stok = StokBibitModel::find($request->stok_bibit_id);
            $hitung = $stok->quantity - $request->jumlah_pemesanan;
            $stok->update(['quantity' => $hitung]);
            $validatedData['user_id'] = auth()->user()->id;
            KelolaPemesananModel::create($validatedData);
            return redirect()->route('kelolapemesanan.index')->with('success', 'Data berhasil disimpan');
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('kelolapemesanan.index')->with('catch', 'Data harus diisi');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'jumlah_pemesanan' => 'required',
                'stok_bibit_id' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
            ]);
            KelolaPemesananModel::find($id)->update($validatedData);
            return redirect()->route('kelolapemesanan.index')->with('success', 'Data berhasil diubah');
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('kelolapemesanan.index')->with('catch', 'Data harus diisi');
        }
    }

    public function validateTask(Request $request, $id)
    {
        $request->validate([
            'upload' => 'image|file'
        ]);

        $validatedData['upload'] = $request->file('upload')->store('task');
        $validatedData['status'] = 1;

        KelolaPemesananModel::find($id)->update($validatedData);
        return redirect(route('kelolapemesanan.index'))->with('success', 'berhasil diselesaikan!');
    }

    public function destroy($id)
    {
        try {
            $pesanan = KelolaPemesananModel::find($id);
            $stok = StokBibitModel::find($pesanan->stok_bibit_id);
            $hitung = $pesanan->jumlah_pemesanan + $stok->quantity;
            $stok->update(['quantity' => $hitung]);
            KelolaPemesananModel::destroy($id);
            return redirect()->route('kelolapemesanan.index')->with('success', 'Data berhasil dihapus');
        } catch (Throwable $e) {
            report($e);
            return  redirect()->route('kelolapemesanan.index')->with('catch', 'Data harus diisi');
        }
    }
}
