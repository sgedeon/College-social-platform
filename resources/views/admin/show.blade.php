@extends('layouts.app')
@section('content')
@php $name = session()->get('name'); @endphp
@php $profil = session()->get('profil'); @endphp
@php $id = session()->get('id'); @endphp
    <div class="row ml-2">
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
        <div class="col-12 pt-2">
            <h2>{!! $user[0]->name !!}</h2>
            <p><b>@lang('lang.adress') :</b> {!! $etudiant->adress !!}</p>
            <p><b>@lang('lang.city') :</b> {!! $ville[0]->nom !!}</p>
            <p><b>@lang('lang.phone_number') :</b> {!! $etudiant->phone !!}</p>
            <p><b>@lang('lang.email') :</b> {!! $user[0]->email !!}</p>
            <p><b>@lang('lang.birthdate') :</b> {!! $etudiant->birthdate !!}</p>
            <hr>
            <h3>@lang('lang.files')</h3>
            <ul>
            @forelse($files as $file)
                <li> <a href="{{ route('file.show', $file->id) }}">
                        {{ ucfirst($file->name)}}</a></li>
            @empty
                <li class="text-warning">@lang('lang.no_files')</li>
            @endforelse
            </ul>
            <hr>
            <h3>Posts</h3>
            <ul>
            @forelse($posts as $post)
                <li> <a href="{{ route('blog.show', $post->id) }}">
                        {{ ucfirst($post->title)}}</a></li>
            @empty
                <li class="text-warning">@lang('lang.no_posts')</li>
            @endforelse
            </ul>
            <hr>
            @if($etudiant->EtudiantHasUser->name == $name OR $profil == 'admin')
            <div class="row ml-1">
                <a href="{{ route('file.upload') }}" class="btn btn-outline-primary mt-2 mr-4">@lang('lang.add_file')</a>
                <a href="{{ route('blog.create') }}" class="btn btn-outline-primary mt-2 mr-4">@lang('lang.text_add_new_message')</a>
                <a href="{{ route('etudiant.edit', $etudiant->id) }}" class="btn btn-outline-primary mt-2 mr-4">@lang('lang.modify_the_profil')</a>
            @endif
            @if($profil == 'admin')
                <form method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger mt-2">@lang('lang.delete_profil')</button>
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection