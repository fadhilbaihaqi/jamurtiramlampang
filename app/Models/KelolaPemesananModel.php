<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaPemesananModel extends Model
{
    use HasFactory;
    protected $table = 'kelola_pemesanan';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dataproduksi()
    {
        return $this->belongsTo(DataProduksiModel::class, 'stok_bibit_id');
    }

    public function stok()
    {
        return $this->belongsTo(StokBibitModel::class);
    }
}
