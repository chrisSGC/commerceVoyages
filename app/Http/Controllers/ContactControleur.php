<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactControleur extends Controller{
    public function contact(){
        return view('contact');
    }
}
