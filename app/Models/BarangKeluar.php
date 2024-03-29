<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah_barang_keluar',
        'tanggal_keluar',
        'id_produk',
        'id_cust',
        'id_kategori',
        'id_rasa',
    ];
}
