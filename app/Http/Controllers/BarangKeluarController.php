<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Customer;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BarangKeluar::join('produks', 'barang_keluars.id_produk', 'produks.id')->join('customers', 'barang_keluars.id_cust', 'customers.id');

            if ($request->get('id_produk') != "") {
                $data = $data->where('produks.id', $request->get('id_produk'));
            }
            
            if ($request->get('custku') != "") {
                $data = $data->where('customers.id', $request->get('custku'));
            }

            if ($request->get('start_date') != "") {

                $from = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->startOfDay();
                $to = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->endOfDay();
                $data =  $data->whereDate('tanggal_keluar', '>=', $from)
                    ->whereDate('tanggal_keluar', '<=', $to);
            }
            return DataTables::of($data->select(['produks.nama_barang', 'customers.nama_customer', 'barang_keluars.*'])->latest())->addColumn('actions', function ($row) {
                $button = '&nbsp;&nbsp;';
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
        return view('barang_keluar.index');
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

    public function getCust(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $customer = Customer::orderby('nama_customer', 'asc')->select('id', 'nama_customer')->limit(5)->get();
        } else {
            $customer = Customer::orderby('nama_customer', 'asc')->select('id', 'nama_customer')
                ->where('nama_customer', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($customer as $customers) {
            $response[] = array(
                "id" => $customers->id,
                "text" => $customers->nama_customer,
            );
        }
        return response()->json($response);
    }

    public function getCustku(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $customer = Customer::orderby('nama_customer', 'asc')->select('id', 'nama_customer')->limit(5)->get();
        } else {
            $customer = Customer::orderby('nama_customer', 'asc')->select('id', 'nama_customer')
                ->where('nama_customer', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($customer as $customers) {
            $response[] = array(
                "id" => $customers->id,
                "text" => $customers->nama_customer,
            );
        }
        return response()->json($response);
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produkku' => 'required',
            'jumlah_barang_keluar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $produk = Produk::where('id', $request->produkku)->select(['produks.*'])->first();
            $barang_masuk = BarangKeluar::create([
                'id_produk' => $request->produkku,
                'id_cust' => $request->cust,
                'jumlah_barang_keluar' => $request->jumlah_barang_keluar,
                'tanggal_keluar' => $request->tanggal_keluar,
            ]);
            $produk->update([
                'stok' => $produk->stok - $request->jumlah_barang_keluar,
            ]);
            return response()->json(['success' => TRUE]);
        }
    }

    public function destroy(Request $request)
    {
        $barang_keluar = BarangKeluar::findOrFail(decrypt($request->id));
        $produk = Produk::where('id', $barang_keluar->id_produk)->select(['produks.*'])->first();
        $produk->update([
            'stok' => $produk->stok + $barang_keluar->jumlah_barang_keluar,
        ]);
        $barang_keluar->delete();
        return response()->json(['success' => 'Barang Masuk deleted successfully.']);
    }
}
