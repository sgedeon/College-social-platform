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
                <ul class="list-group mt-4">
                    @forelse($posts as $post)
                        <li class="list-group-item mt-2"> 
                            <p class="mt-3">
                                <a href="{{ route('blog.show', $post->id)}}">
                                    @foreach($titles as $title)
                                        @if($title->id === $post->id)
                                            {{ ucfirst($title->title) }}
                                        @endif
                                    @endforeach
                                </a>
                            </p>
                            <p class=".text-secondary">
                                @lang('lang.author') :
                                @foreach($etudiants as $etudiant)
                                    @if($etudiant->userId === $post->user_id)
                                        <a href="{{ route('etudiant.show', $etudiant->id)}}">
                                    @endif
                                @endforeach
                                @foreach($users as $user)
                                    @if($user->id === $post->user_id)
                                        {{ ucfirst($user->name) }}
                                    @endif
                                @endforeach
                                </a>
                            </p>
                        </li>
                    @empty
                        <li class="text-warning">Aucun article disponible</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection