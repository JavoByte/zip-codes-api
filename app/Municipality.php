<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $guarded = [];
    protected $hidden = [
        'id',
        'federal_entity_id',
        'federalEntity',
        'created_at',
        'updated_at',
    ];

    public function federalEntity()
    {
        return $this->belongsTo('App\FederalEntity');
    }

}
