<?php

namespace App\Imports;

use App\Models\TraceabilityRawMaterial;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
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
        if ($row[0] == 'Invoice No' || $row[0] == 'Product') {
            return null;
        }
        $dataCount = TraceabilityRawMaterial::withTrashed()->count();
        $year = date('Y');
        $insert = null;
        for ($i = 0; $i < $row[6]; $i++) {
            $rm_id = 'RM' . $year . str_pad($dataCount + 1, 8, '0', STR_PAD_LEFT);
            $dataCount++;
            $this->rmIds[] = $rm_id;
            $insert = TraceabilityRawMaterial::create([
                'rm_id' => $rm_id,
                'invoice_no' => $row[0],
                'model_name' => $row[1],
                'qty' => $row[2],
                'prod_date' => $row[3],
                'furnace_no' => $row[4],
                'batch_no' => $row[5],
                'total_pallet' => $row[6],
                'item_code' => $row[7] ?? null,
            ]);
        }

        return $insert;
    }

    public function getRmIds()
    {
        return $this->rmIds;
    }
}
