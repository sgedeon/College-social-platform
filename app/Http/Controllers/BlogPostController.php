<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Categorie;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::orderByDesc('created_at')->get();
        $titles = BlogPost::selectPostTitles();
        $users = User::all();
        $etudiants = Etudiant::all();
        return view('blog.index', ['posts' => $posts, 'titles' => $titles, 
        'users' => $users, 'etudiants' => $etudiants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorie = Categorie::selectCategorie();
        return view('blog.create', ['categories'=>$categorie]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:30|min:2',
            'body' => 'required|min:10',
        ]);

        if ($request->categories_id === '1') {
            $newBlog = BlogPost::create([
                'title' => $request->title,
                'body' => $request->body,
                'categories_id' => $request->categories_id,
                'user_id'=> Auth::user()->id
            ]);
        } else {
            $newBlog = BlogPost::create([
                'title' => $request->title,
                'title_fr' => $request->title,
                'body' => $request->body,
                'body_fr' => $request->body,
                'categories_id' => $request->categories_id,
                'user_id'=> Auth::user()->id
            ]);
        }

       return redirect(route('blog.show', $newBlog->id))
       ->with('success',Lang::get('lang.blog_create_confirmation'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        $title = BlogPost::selectPostTitle($blogPost->id);
        $body = BlogPost::selectPostBody($blogPost->id);
        $etudiant = Etudiant::select()
        ->WHERE('userId','=', $blogPost->user_id)
        ->get();
        return view('blog.show',['blogPost' => $blogPost, 'etudiant' => $etudiant, 'title' => $title, 
        'body' => $body]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        $categorie = Categorie::selectCategorie();
        $title = BlogPost::selectPostTitle($blogPost->id);
        $body = BlogPost::selectPostBody($blogPost->id);
        return view('blog.edit', ['blogPost' => $blogPost, 'categories'=> $categorie, 
        'title' => $title, 'body' =>  $body]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'title' => 'required|max:30|min:2',
            'body' => 'required|min:10',
        ]);

        if($blogPost->user_id === Auth::user()->id) {
            if ($request->categories_id === '1') {
                $blogPost->update([
                    'title' => $request->title,
                    'body' => $request->body,
                    'categories_id' => $request->categories_id
                ]);
            } else {
                $blogPost->update([
                    'title_fr' => $request->title,
                    'body_fr' => $request->body,
                    'categories_id' => $request->categories_id
                ]);
            }
        } else {
            abort(Response::HTTP_UNAUTHORIZED);
        }
        return redirect(route('blog.show', $blogPost->id))
        ->with('success',Lang::get('lang.blog_update_confirmation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        if($blogPost->user_id === Auth::user()->id) {
            $blogPost->delete();
        } else {
            abort(Response::HTTP_UNAUTHORIZED);
        }
        $blogPost->delete();

        return redirect(route('etudiant.show', Auth::user()->id))
        ->with('success',Lang::get('lang.blog_delete_confirmation'));
    }
}
