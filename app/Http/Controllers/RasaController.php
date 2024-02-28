<?php

namespace App\Http\Controllers;

use App\Models\Rasa;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class RasaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Rasa::all();
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
        return view('rasa.index');
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rasa' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $rasa = Rasa::create([
                'rasa' => $request->rasa,
            ]);
            return response()->json(['success' => TRUE]);
        }
    }

    public function edit(Request $request)
    {
        $rasa = Rasa::findOrFail(decrypt($request->id));
        return response()->json(['data' => $rasa]);
    }

    public function update(Request $request)
    {
        $rasa = Rasa::findOrFail($request->id);
        $validator = Validator::make($request->all(), [
            'rasa' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $rasa->update([
                'rasa' => $request->rasa,
            ]);
        }
        return response()->json(['success' => TRUE]);
    }

    public function destroy(Request $request)
    {
        $rasa = Rasa::findOrFail(decrypt($request->id));
        $rasa->delete();
        return response()->json(['success' => 'Rasa deleted successfully.']);
    }
}
