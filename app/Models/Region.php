<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model{
    protected $table = 'region';
    use HasFactory;

    public function voyagesAssocies(){
        return $this->hasManyThrough("App\Models\Voyage", "App\Models\Departement");
    }
}
