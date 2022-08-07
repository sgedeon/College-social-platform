@extends('layouts.app')
@section('content')
@php $name = session()->get('name'); @endphp
@php $id = session()->get('id'); @endphp
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
               <a href="{{ route('etudiant.show', $id) }}" class="btn btn-primary btn-sm">@lang('lang.return')</a>
               <hr>
               </h1 class="display-one">{{ ucfirst($fileName[0]->name) }}</h1>
               <hr>
               <a href="{{ route('file.download', $file->id) }}" class="btn btn-outline-primary">Download</a>
               @if($file->FileHasUser->name == $name)
                    <a href="{{ route('file.edit', $file->id) }}" class="btn btn-outline-primary">@lang('lang.modify')</a>
                    <hr>
               @endif
               @if($file->FileHasUser->name == $name)
                <form method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger mt-2">@lang('lang.delete_profil')</button>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection