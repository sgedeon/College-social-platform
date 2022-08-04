@extends('layouts.app')
@section('content')
@php $name = session()->get('name'); @endphp
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
               <a href="{{ route('blog')}}" class="btn btn-primary btn-sm">@lang('lang.return')</a>
               <hr>
               <h1  class="display-one">{{ ucfirst($blogPost->title) }}</h1>
               <p>{!! $blogPost->body !!}</p>
               <p>Auteur: {{ $blogPost->blogHasUser->name }}</p>
               <hr>
               @if($blogPost->blogHasUser->name == $name)
                <a href="{{route('blog.edit', $blogPost->id)}}" class="btn btn-outline-primary">@lang('lang.modify')</a>
                <hr>
                <form method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">@lang('lang.delete')</button>
                </form>
               @endif
            </div>
        </div>
    </div>
@endsection