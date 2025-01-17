<?php

namespace App\Imports;

use App\Models\TraceabilityRawMaterial;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class RawMaterialImport implements ToModel
{
    protected $rmIds = [];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $dataCount = TraceabilityRawMaterial::withTrashed()->count();
        $year = date('y');
        $month = date('m');
        $rm_id = 'RM' . $year . $month . str_pad($dataCount + 1, 5, '0', STR_PAD_LEFT);

        $this->rmIds[] = $rm_id;

        return new TraceabilityRawMaterial([
            'rm_id' => $rm_id,
            'model_name' => $row[0],
            'item_code' => $row[1],
            'po_no' => $row[2],
            'cus_info_1' => $row[3],
            'cus_info_2' => $row[4],
            'qty' => $row[5],
        ]);
    }
    
    public function getRmIds()
    {
        return $this->rmIds;
    }
}
