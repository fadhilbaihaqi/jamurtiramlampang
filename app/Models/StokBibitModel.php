<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBibitModel extends Model
{
    use HasFactory;
    protected $table = 'stok_bibit';
    protected $guarded = ['id'];

    // public function dataproduksi()
    // {
    //     return $this->belongsTo(DataProduksiModel::class, 'stok_bibit_id');
    // }
}
