<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::all();
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
        return view('customer.index');
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_customer' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $customer = Customer::create([
                'nama_customer' => $request->nama_customer,
                'alamat' => $request->alamat,
            ]);
            return response()->json(['success' => TRUE]);
        }
    }

    public function edit(Request $request)
    {
        $customer = Customer::findOrFail(decrypt($request->id));
        return response()->json(['data' => $customer]);
    }

    public function update(Request $request)
    {
        $customer = Customer::findOrFail($request->id);
        $validator = Validator::make($request->all(), [
            'nama_customer' => 'required',
            'alamat' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $customer->update([
                'nama_customer' => $request->nama_customer,
                'alamat' => $request->alamat,
            ]);
        }
        return response()->json(['success' => TRUE]);
    }

    public function destroy(Request $request)
    {
        $customer = Customer::findOrFail(decrypt($request->id));
        $customer->delete();
        return response()->json(['success' => 'Customer deleted successfully.']);
    }
}
