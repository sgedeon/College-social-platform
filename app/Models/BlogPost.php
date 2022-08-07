<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use User;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'categories_id','title_fr', 'body_fr','user_id'];

    public function blogHasUser(){
        return $this->hasOne('App\Models\User','id', 'user_id');
    }

    public function selectBlog($id){
        $query = BlogPost::Select('body', 'users.name')
        ->JOIN('users', 'blog_posts.user_id', '=', 'users.id')
        ->WHERE("blog_posts.id", $id)
        ->get();
        return $query;
    }

    static public function selectPostBody($id){

        $lg = "";
        if(session()->has('locale') && session()->get('locale') == 'fr'){
            $lg = '_fr';
        }

        $query = BlogPost::Select( 
        DB::raw('(case when body'.$lg.' is null then body else body'.$lg.' end) as body'))
        ->WHERE("blog_posts.id", $id)
        ->orderBy('body')
        ->get();
        return $query;
    } 

    static public function selectPostTitles(){

        $lg = "";
        if(session()->has('locale') && session()->get('locale') == 'fr'){
            $lg = '_fr';
        }

        $query = BlogPost::Select('id', 
        DB::raw('(case when title'.$lg.' is null then title else title'.$lg.' end) as title'))
        ->orderBy('title')
        ->get();
        return $query;
    }

    static public function selectPostTitle($id){

        $lg = "";
        if(session()->has('locale') && session()->get('locale') == 'fr'){
            $lg = '_fr';
        }

        $query = BlogPost::Select(
        DB::raw('(case when title'.$lg.' is null then title else title'.$lg.' end) as title'))
        ->WHERE("blog_posts.id", $id)
        ->orderBy('title')
        ->get();
        return $query;
    }

    static public function selectPostsUser($id){

        $lg = "";
        if(session()->has('locale') && session()->get('locale') == 'fr'){
            $lg = '_fr';
        }

        $query = BlogPost::Select('id',
        DB::raw('(case when title'.$lg.' is null then title else title'.$lg.' end) as title'))
        ->WHERE("blog_posts.user_id", $id)
        ->orderBy('title')
        ->get();
        return $query;
    }
}
