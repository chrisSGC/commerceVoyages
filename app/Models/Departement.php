<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model{
    protected $table = 'departement';
    use HasFactory;

    public function voyagesAssocies(){
        return $this->belongsToMany("App\Models\Voyage", "departement");
    }
}
