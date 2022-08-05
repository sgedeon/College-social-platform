@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">@lang('lang.the_college_forum')</h1>
                        <p>@lang('lang.text_good_reading')</p>
                    </div>
                    <div class="col-4">
                        <p>@lang('lang.text_add_new_message')</p>
                        <a href="{{ route('blog.create')}}" class="btn btn-primary btn-sm">@lang('lang.text_new_message')</a>
                    </div>
                </div>
                <ul>
                    @forelse($posts as $post)
                        <li> <a href="{{ route('blog.show', $post->id)}}">
                        @foreach($titles as $title)
                            @if($title->id === $post->id)
                                {{ ucfirst($title->title)}}</a></li>
                            @endif
                        @endforeach
                    @empty
                        <li class="text-warning">Aucun article disponible</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection