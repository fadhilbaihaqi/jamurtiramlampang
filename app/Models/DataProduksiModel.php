<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProduksiModel extends Model
{
    use HasFactory;
    protected $table = 'data_produksi';
    protected $guarded = ['id'];

    public function stokbibit()
    {
        return $this->belongsTo(StokBibitModel::class, 'stok_bibit_id');
    }
}
