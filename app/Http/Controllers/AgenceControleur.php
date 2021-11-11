<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgenceControleur extends Controller{
    public function agence(){
        return view('agence');
    }
}
