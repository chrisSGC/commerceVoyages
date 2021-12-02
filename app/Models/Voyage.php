<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model{
    protected $table = 'voyage';
    protected $fillable = ['actif'];
    use HasFactory;
}
