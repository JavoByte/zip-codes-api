<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ZipCode;

class ZipCodesController extends Controller
{
    
    public function show(ZipCode $code) {
        $code->load('settlements', 'settlements.settlementType', 'municipality.federalEntity');
        return response()->json($code);
    }
}
