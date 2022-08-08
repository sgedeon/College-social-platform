@extends('layouts.app')
@section('content')
@php $id = session()->get('id'); @endphp
@php $name = session()->get('name'); @endphp
    <div class="container">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <strong>{{ $message }}</strong>
        </div>
        @endif
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-12 pt-2">
               <div class="row mb-4 ml-1">
                   <a href="{{ route('blog') }}" class="btn btn-primary btn-sm">Forum</a>
               </div>
               <hr>
               </h1>{{ ucfirst($title[0]->title) }}</h1>
               <p class="mt-2">{{ ucfirst($body[0]->body) }}</p>
               <p>Auteur: <a href="{{ route('etudiant.show', $etudiant[0]->id) }}">
                   {{ $blogPost->blogHasUser->name }}</a></p>
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