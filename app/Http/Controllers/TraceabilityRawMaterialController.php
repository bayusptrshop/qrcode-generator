<?php

namespace App\Http\Controllers;

use App\Imports\RawMaterialImport;
use App\Models\TraceabilityRawMaterial;
use Illuminate\Http\Request;
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

        $data = TraceabilityRawMaterial::whereIn('rm_id', explode(',', $rmIdParam))->get();

        return view('qrcode', compact('data'));
    }

    public function listRawMaterial()
    {
        $data = TraceabilityRawMaterial::all();
        return response()->json($data, 200);
    }
}
