<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    protected $fillable = ['adress','phone','birthdate','profil','villeId','userId'];

    public function EtudiantHasUser(){
        return $this->hasOne('App\Models\User','id', 'userId');
    }
}
