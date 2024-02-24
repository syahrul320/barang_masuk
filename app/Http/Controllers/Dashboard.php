<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\Transaksippdb;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::selectRaw('SUM(stok) AS result')->first()->result;
        $customer = Customer::selectRaw('SUM(id) AS result')->first()->result;
        $barang_masuk = BarangMasuk::selectRaw('SUM(jumlah_barang_masuk) AS result')->whereDate('created_at', '=', Carbon::today()->toDateString())->first()->result;
        $barang_keluar = BarangKeluar::selectRaw('SUM(jumlah_barang_keluar) AS result')->whereDate('created_at', '=', Carbon::today()->toDateString())->first()->result;

        return view('dashboard.index', compact('produk', 'customer', 'barang_masuk', 'barang_keluar'));
    }
}
