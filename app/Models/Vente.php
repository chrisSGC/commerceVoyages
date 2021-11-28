<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model{
    protected $table = 'vente';
    use HasFactory;

    public function voyageAssocie(){
        return $this->hasOne("App\Models\Voyage");
    }
}
