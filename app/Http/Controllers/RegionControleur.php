<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionControleur extends Controller{
    //
    public static function regions(){ 
        $listeRegions = Region::where("afficher", 1)->get();

        return $listeRegions;
    }
}
