<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BarangMasuk::join('produks', 'barang_masuks.id_produk', 'produks.id');

            if ($request->get('id_produk') != "") {
                $data = $data->where('produks.id', $request->get('id_produk'));
            }

            if ($request->get('start_date') != "") {

                $from = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->startOfDay();
                $to = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->endOfDay();
                $data =  $data->whereDate('tanggal_masuk', '>=', $from)
                    ->whereDate('tanggal_masuk', '<=', $to);
            }
            return DataTables::of($data->select(['produks.nama_barang', 'barang_masuks.*'])->latest())->addColumn('actions', function ($row) {
                $button = '&nbsp;&nbsp;';
                // $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" onclick= edit("' . encrypt($row->id) . '") data-original-title="Edit"><span class="badge bg-success"> Edit</span></a>';
                // $button .= '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" onclick= destroy("' . encrypt($row->id) . '") ><span class="badge bg-warning"> Delete</span></a>';

                return $button;
            })
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->removeColumn('id')
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('barang_masuk.index');
    }

    public function getUserCard(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $user = Produk::orderby('nama_barang', 'asc')->select('id', 'nama_barang')->limit(5)->get();
        } else {
            $user = Produk::orderby('nama_barang', 'asc')->select('id', 'nama_barang')
                ->where('nama_barang', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($user as $users) {
            $response[] = array(
                "id" => $users->id,
                "text" => $users->nama_barang,
            );
        }
        return response()->json($response);
    }

    public function getProduk(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $user = Produk::orderby('nama_barang', 'asc')->select('id', 'nama_barang')->limit(5)->get();
        } else {
            $user = Produk::orderby('nama_barang', 'asc')->select('id', 'nama_barang')
                ->where('nama_barang', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($user as $users) {
            $response[] = array(
                "id" => $users->id,
                "text" => $users->nama_barang,
            );
        }
        return response()->json($response);
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produkku' => 'required',
            'jumlah_barang_masuk' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $produk = Produk::where('id', $request->produkku)->select(['produks.*'])->first();
            $barang_masuk = BarangMasuk::create([
                'id_produk' => $request->produkku,
                'jumlah_barang_masuk' => $request->jumlah_barang_masuk,
                'tanggal_masuk' => Carbon::now(),
            ]);
            $produk->update([
                'stok' => $produk->stok + $request->jumlah_barang_masuk,
            ]);
            return response()->json(['success' => TRUE]);
        }
    }

    public function destroy(Request $request)
    {
        $barang_masuk = BarangMasuk::findOrFail(decrypt($request->id));
        $produk = Produk::where('id', $barang_masuk->id_produk)->select(['produks.*'])->first();
        $produk->update([
            'stok' => $produk->stok - $barang_masuk->jumlah_barang_masuk,
        ]);
        $barang_masuk->delete();
        return response()->json(['success' => 'Barang Masuk deleted successfully.']);
    }
}
