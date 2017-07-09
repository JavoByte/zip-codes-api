<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    
    protected $guarded = [];
    protected $hidden = [
        'id',
        'zip_code_id',
        'settlement_type_id',
        'created_at',
        'updated_at',
    ];

    public function zipCode()
    {
        return $this->belongsTo('App\ZipCode');
    }

    public function settlementType()
    {
        return $this->belongsTo('App\SettlementType');
    }
}
