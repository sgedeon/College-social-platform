<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $titles = BlogPost::selectBlogTitle();
        return view('blog.index', ['posts' => $posts], ['titles' => $titles]);
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

       return redirect(route('blog.show', $newBlog->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        $titles = BlogPost::selectBlogTitle();
        $bodies = BlogPost::selectBlogBody();
        return view('blog.show',['blogPost' => $blogPost, 'titles' => $titles, 
        'bodies' => $bodies]);
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
        return view('blog.edit', ['blogPost' => $blogPost], ['categories'=> $categorie]);
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
            error_log($request->categories_id);
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
        return redirect(route('blog.show', $blogPost->id));
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

        return redirect(route('blog'));
    }
}
