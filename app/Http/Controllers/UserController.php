<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('level', '=', 'peserta')->get();
            return DataTables::of($data)->addColumn('actions', function ($row) {
                $button = '&nbsp;&nbsp;';
                $button .= '<div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">
                Options
                </button>';
                $button .= ' <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row->id . '">';
                $button .= '<li><a href="/data-peserta/cetak/' . encrypt($row->id) . '" target="_blank"><ion-icon name="print-outline"></ion-icon> Cetak Data Peserta</a></a></li>';
                $button .= '<li><a href="/surat-pernyataan/cetak/' . encrypt($row->id) . '" target="_blank"><ion-icon name="print-outline"></ion-icon> Cetak Surat Pernyataan</a></a></li>';
                $button .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" onclick= edit("' . encrypt($row->id) . '") data-original-title="Edit"><ion-icon name="create-outline"></ion-icon> Edit</a></li>';
                $button .= '<li><a href="javascript:void(0)" onclick= destroy("' . encrypt($row->id) . '") ><ion-icon name="trash-outline"></ion-icon> Delete</a></li>';
                $button .= '</ul>';
                $button .= '</div>';
                return $button;
            })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('user.index');
    }

    public function insert_data(Request $request)
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 10);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nik' => 'required|unique:users|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'nik' => $request->nik,
                'username' => $request->name,
                'level' => 'peserta',
                'password' => Hash::make($password),
            ]);
            return response()->json(['success' => TRUE]);
        }
    }

    public function edit(Request $request)
    {
        $user = User::findOrFail(decrypt($request->id));
        return response()->json(['data' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nik' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user->update([
                'name' => $request->name,
                'nik' => $request->nik,
            ]);
        }
        return response()->json(['success' => TRUE]);
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail(decrypt($request->id));
        $user->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }

    public function cetak(Request $request, $id)
    {
        $user = User::findOrFail(decrypt($request->id));
        $userku = Auth::user()->id;
        $panitia = User::where('id', $userku)->get()->first();
        // $peserta = Transaksippdb::join('users', 'transaksippdbs.id_user', 'users.id')->get(['users.*', 'transaksippdbs.*'])->first();
        return view('user.cetak', ['user' => $user, 'panitia' => $panitia]);
    }

    public function pernyataan(Request $request, $id)
    {
        $user = User::findOrFail(decrypt($request->id));
        $userku = Auth::user()->id;
        $panitia = User::where('id', $userku)->get()->first();
        // $peserta = Transaksippdb::join('users', 'transaksippdbs.id_user', 'users.id')->get(['users.*', 'transaksippdbs.*'])->first();
        return view('user.cetak2', ['user' => $user, 'panitia' => $panitia]);
    }
}
