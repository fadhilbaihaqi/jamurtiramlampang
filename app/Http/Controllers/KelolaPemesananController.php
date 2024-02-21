<?php

namespace App\Http\Controllers;

use App\Models\DataProduksiModel;
use App\Models\KelolaPemesananModel;
use App\Models\StokBibitModel;
use Dotenv\Exception\ValidationException;
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
            // Validate the request data
            $validatedData = $request->validate([
                'jumlah_pemesanan' => 'required',
                'stok_bibit_id' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
            ]);

            // Dapatkan pesanan sebelum diperbarui
            $pemesananSebelumnya = KelolaPemesananModel::findOrFail($id);
            $jumlahPemesananSebelumnya = (int) $pemesananSebelumnya->jumlah_pemesanan;

            // Perbarui pesanan
            $pemesananSebelumnya->update($validatedData);

            // Dapatkan pesanan setelah diperbarui
            $pemesananSetelahnya = KelolaPemesananModel::findOrFail($id);
            $jumlahPemesananSetelahnya = (int) $pemesananSetelahnya->jumlah_pemesanan;

            // Hitung selisih jumlah pesanan
            $selisihJumlahPemesanan = $jumlahPemesananSetelahnya - $jumlahPemesananSebelumnya;

            // Update quantity pada stok bibit jika ada perubahan jumlah pesanan
            if ($selisihJumlahPemesanan != 0) {
                $stokBibit = StokBibitModel::findOrFail($validatedData['stok_bibit_id']);

                // Ambil quantity saat ini dan kurangi dengan selisih jumlah pesanan
                $stokBibit->quantity = (int) $stokBibit->quantity - $selisihJumlahPemesanan;
                $stokBibit->save();
            }

            return redirect()->route('kelolapemesanan.index')->with('success', 'Data berhasil diubah');
        } catch (ValidationException $e) {
            // Validation failed
            return redirect()->route('kelolapemesanan.index')->with('catch', 'Validasi gagal: ' . $e->getMessage());
        } catch (Throwable $e) {
            // Other exceptions
            report($e);
            return redirect()->route('kelolapemesanan.index')->with('catch', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
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
