<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TraceabilityRawMaterial extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'rm_id';
    public $incrementing = false;
    protected $fillable = [
        'rm_id',
        'model_name',
        'item_code',
        'invoice_no',
        'prod_date',
        'batch_no',
        'qty',
        'furnace_no',
        'total_pallet',
    ];
}
