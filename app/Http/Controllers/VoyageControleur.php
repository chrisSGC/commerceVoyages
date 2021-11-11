<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;

class VoyageControleur extends Controller{
    public function voyages(){ 
        $neufVoyages = Voyage::skip(0)->take(9)->get();

        return view('voyages')->with('neufVoyages', $neufVoyages);
    }
}
