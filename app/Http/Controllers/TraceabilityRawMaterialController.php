<?php

namespace App\Http\Controllers;

use App\Imports\RawMaterialImport;
use App\Models\TraceabilityRawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TraceabilityRawMaterialController extends Controller
{
    public function index()
    {
        return view('insert-data');
    }

    public function import(Request $request)
    {
        $import = new RawMaterialImport();
        Excel::import($import, $request->file('file'));
        $rmIds = $import->getRmIds();
        $rmIdString = implode(',', $rmIds);

        return redirect()->route('qrcode.generate', ['rmid' => $rmIdString]);
    }

    public function qrcodeGenerate(Request $request)
    {
        $rmIdParam = $request->query('rmid');
        if (empty($rmIdParam)) {
            return redirect()->route('list.data')->with('error', 'Invalid parameter');
        }
        $data = TraceabilityRawMaterial::whereIn('rm_id', explode(',', $rmIdParam))->get();
        if (Auth::user()->user_code == 'topy_idn01' || Auth::user()->user_code == 'topy_idn02') {
            return view('qrcode-a7', compact('data'));
        }
        return view('qrcode', compact('data'));
    }

    public function listRawMaterial()
    {
        $data = TraceabilityRawMaterial::all();
        return response()->json($data, 200);
    }

    public function detailRawMaterial($id)
    {
        $data = TraceabilityRawMaterial::find($id);
        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }

    public function listData(Request $request)
    {
        $data = TraceabilityRawMaterial::all();
        $invoices = $data->pluck('invoice_no')->unique();
        $items = $data->pluck('model_name')->unique();
        $created_at = $data->pluck('created_at')->unique();
        $data = TraceabilityRawMaterial::query();
        if ($request->has('invoice_no') && $request->invoice_no) {
            $data = $data->where('invoice_no', $request->invoice_no);
        }
        if ($request->has('item_name') && $request->item_name) {
            $data = $data->where('model_name', $request->item_name);
        }
        if ($request->has('created_at') && $request->created_at) {
            $data = $data->whereDate('created_at', $request->created_at);
        }

        $data = $data->get();
        return view('list', compact('data', 'invoices', 'items', 'created_at'));
    }
}
