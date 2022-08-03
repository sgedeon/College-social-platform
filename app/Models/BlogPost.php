<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id'];

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
}
