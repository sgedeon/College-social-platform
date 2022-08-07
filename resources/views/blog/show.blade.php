@extends('layouts.app')
@section('content')
@php $name = session()->get('name'); @endphp
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
               <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm">@lang('lang.return')</a>
               <hr>
               </h1>{{ ucfirst($title[0]->title) }}</h1>
               <p class="mt-2">{{ ucfirst($body[0]->body) }}</p>
               <a href="{{ route('etudiant.show', $etudiant[0]->id) }}">
                   <p>Auteur: {{ $blogPost->blogHasUser->name }}</p>
               </a>
               <hr>
               <div class="row ml-1">
                    @if($blogPost->blogHasUser->name == $name)
                        <a href="{{route('blog.edit', $blogPost->id)}}" class="btn btn-outline-primary mr-4">@lang('lang.modify')</a>
                        <form method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger mr-4">@lang('lang.delete')</button>
                        </form>
                    @endif
               </div>
            </div>
        </div>
    </div>
@endsection