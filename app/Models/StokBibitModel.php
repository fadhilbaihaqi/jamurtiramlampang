<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBibitModel extends Model
{
    use HasFactory;
    protected $table = 'stok_bibit';
    protected $guarded = ['id'];

    public function updateStok($jumlah)
    {
        // Pastikan $jumlah memiliki tipe data yang sesuai
        $jumlah = (int) $jumlah;

        $this->stok_bibit += $jumlah;
        $this->save();
    }
}
