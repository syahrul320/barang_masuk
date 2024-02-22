<?php

namespace App\Http\Controllers;

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
        $user = User::selectRaw('COUNT(*) AS result')->where('level', 'peserta')->first()->result;
        // $transaksi = Transaksippdb::selectRaw('COUNT(*) AS result')->get()->first()->result;

        return view('dashboard.index', compact('user'));
    }
}
