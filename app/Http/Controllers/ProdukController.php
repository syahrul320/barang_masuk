<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Rasa;
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
            $data = Produk::join('kategoris', 'produks.id_kategori', 'kategoris.id')->join('rasas', 'produks.id_rasa', 'rasas.id');
            if ($request->get('id_kategori') != "") {
                $data = $data->where('kategoris.id', $request->get('id_kategori'));
            }
            if ($request->get('id_rasa') != "") {
                $data = $data->where('rasas.id', $request->get('id_rasa'));
            }
            return DataTables::of($data->select(['produks.*', 'kategoris.nama_kategori','rasas.rasa'])->latest())->addColumn('actions', function ($row) {
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

    public function getKategori(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $kategori = Kategori::orderby('nama_kategori', 'asc')->select('id', 'nama_kategori')->limit(5)->get();
        } else {
            $kategori = Kategori::orderby('nama_kategori', 'asc')->select('id', 'nama_kategori')
                ->where('nama_kategori', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($kategori as $kategoris) {
            $response[] = array(
                "id" => $kategoris->id,
                "text" => $kategoris->nama_kategori,
            );
        }
        return response()->json($response);
    }

    public function getRasa(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $rasa = Rasa::orderby('rasa', 'asc')->select('id', 'rasa')->limit(5)->get();
        } else {
            $rasa = Rasa::orderby('rasa', 'asc')->select('id', 'rasa')
                ->where('rasa', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($rasa as $rasas) {
            $response[] = array(
                "id" => $rasas->id,
                "text" => $rasas->rasa,
            );
        }
        return response()->json($response);
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'satuan' => 'required',
            'id_kategori' => 'required',
            'id_rasa' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $produk = Produk::create([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'stok' => 0,
                'satuan' => $request->satuan,
                'id_kategori' => $request->id_kategori,
                'id_rasa' => $request->id_rasa,
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
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'id_kategori' => 'required',
            'id_rasa' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $produk->update([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'satuan' => $request->satuan,
                'id_kategori' => $request->id_kategori,
                'id_rasa' => $request->id_rasa,
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
