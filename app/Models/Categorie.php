<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Categorie extends Model
{
    use HasFactory;

    static public function selectCategorie(){

        $lg = "";
        if(session()->has('locale') && session()->get('locale') == 'fr'){
            $lg = '_fr';
        }
        $query = Categorie::Select('id',
        DB::raw('(case when categorie'.$lg.' is null then categorie else categorie'.$lg.' end) as categorie'))
        ->orderBy('categorie')
        ->get();
        return $query;
    } 
}
