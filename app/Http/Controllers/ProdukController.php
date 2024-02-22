<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Produk::all();
            return DataTables::of($data)->addColumn('actions', function ($row) {
                $button = '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" onclick= edit("' . encrypt($row->id) . '") data-original-title="Edit"><span class="badge bg-success"> Edit</span></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" onclick= destroy("' . encrypt($row->id) . '") ><span class="badge bg-warning"> Delete</span></a>';

                return $button;
            })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('produk.index');
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'satuan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $produk = Produk::create([
                'nama_barang' => $request->nama_barang,
                'stok' => 0,
                'satuan' => $request->satuan,
            ]);
            return response()->json(['success' => TRUE]);
        }
    }

    public function edit(Request $request)
    {
        $produk = Produk::findOrFail(decrypt($request->id));
        return response()->json(['data' => $produk]);
    }

    public function update(Request $request)
    {
        $produk = Produk::findOrFail($request->id);
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'satuan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $produk->update([
                'nama_barang' => $request->nama_barang,
                'satuan' => $request->satuan,
            ]);
        }
        return response()->json(['success' => TRUE]);
    }

    public function destroy(Request $request)
    {
        $produk = Produk::findOrFail(decrypt($request->id));
        $produk->delete();
        return response()->json(['success' => 'Produk deleted successfully.']);
    }
}
