<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Models\Region;

class VoyageControleur extends Controller{
    static $offset = 9;

    public function voyages(){ 
        $neufVoyages = Voyage::skip(0)->take(9)->get();

        return view('voyages')->with('neufVoyages', $neufVoyages);
    }
    
    public function obtenirPlusVoyages(){ 
        $neufVoyagesDePlus = Voyage::skip(self::$offset)->take(9)->get();

        self::$offset = self::$offset + 9; // modifier pour avoir soit l'offset de 9 soit le nombre de trouvés

        return ["code" => 200, "donnees" => $neufVoyagesDePlus];
    }

    public function voyagesRegion($idRegion){ 
        $region = Region::find($idRegion);
        $voyagesRegion = $region->voyagesAssocies;
        
        return view('voyagesRegion')->with('region', $region)->with('voyagesRegion', $voyagesRegion);
    }
}
