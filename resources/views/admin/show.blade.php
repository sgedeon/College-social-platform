@extends('layouts.app')
@section('content')
@php $name = session()->get('name'); @endphp
@php $profil = session()->get('profil'); @endphp
    <div class="row">
        <div class="col-12 pt-2">
            <h2>{!! $user[0]->name !!}</h2>
            <p><b>@lang('lang.adress') :</b> {!! $etudiant->adress !!}</p>
            <p><b>@lang('lang.city') :</b> {!! $ville[0]->nom !!}</p>
            <p><b>@lang('lang.phone_number') :</b> {!! $etudiant->phone !!}</p>
            <p><b>@lang('lang.email') :</b> {!! $user[0]->email !!}</p>
            <p><b>@lang('lang.birthdate') :</b> {!! $etudiant->birthdate !!}</p>
            <hr>
            @if($etudiant->id == $user[0]->id OR $profil == 'admin')
            <div class="row ml-1">
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