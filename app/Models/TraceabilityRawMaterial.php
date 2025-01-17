<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TraceabilityRawMaterial extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'rm_id',
        'model_name',
        'item_code',
        'po_no',
        'cus_info_1',
        'cus_info_2',
        'qty',
    ];
}
