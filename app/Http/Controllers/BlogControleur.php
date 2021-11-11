<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogControleur extends Controller{
    public function blog(){
        return view('blog');
    }
}
