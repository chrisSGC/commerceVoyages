<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TableauDeBordControleur extends Controller{
    public function accueil(){
        if(session()->missing('administrateur')){ return redirect('/'); }
        
        return view('adminIndex');
    }
}
