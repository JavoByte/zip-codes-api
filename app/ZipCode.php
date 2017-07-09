<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    protected $guarded = [];
    protected $appends = [
        'federal_entity',
    ];

    protected $hidden = [
        'id',
        'municipality_id',
        'created_at',
        'updated_at',
    ];
    
    public function municipality()
    {
        return $this->belongsTo('App\Municipality');
    }

    public function settlements()
    {
        return $this->hasMany('App\Settlement');
    }

    public function getFederalEntityAttribute()
    {
        return $this->municipality->federalEntity;
    }

    public function getZipCodeAttribute() {
        return str_pad($this->attributes['zip_code'], 5, '0', STR_PAD_LEFT);
    }

}
