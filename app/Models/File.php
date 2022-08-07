<?php

// File.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class File extends Model
{
  use HasFactory;
    protected $fillable = [
        'name',
        'name_fr',
        'file_path',
        'categories_id',
        'user_id',
  ];

  public function FileHasUser(){
    return $this->hasOne('App\Models\User','id', 'user_id');
  }

  static public function selectFilesName($id){
      $lg = "";
      if(session()->has('locale') && session()->get('locale') == 'fr'){
          $lg = '_fr';
      }

      $query = File::Select('id', 
      DB::raw('(case when name'.$lg.' is null then name else name'.$lg.' end) as name'))
      ->WHERE("files.user_id", $id)
      ->orderBy('name')
      ->get();
      return $query;
  }

  static public function selectFileName($id) {
      $lg = "";
      if(session()->has('locale') && session()->get('locale') == 'fr'){
          $lg = '_fr';
      }

      $query = File::Select(
      DB::raw('(case when name'.$lg.' is null then name else name'.$lg.' end) as name'))
      ->WHERE("files.id", $id)
      ->orderBy('name')
      ->get();
      return $query;
  }
}