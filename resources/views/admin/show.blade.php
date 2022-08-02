@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 pt-2">
            <h2>{!! $user[0]->name !!}</h2>
            <p><b>Adresse :</b> {!! $etudiant->adress !!}</p>
            @foreach ($ville as $nom)
                 <p><b>Ville :</b> {!! $nom->nom !!}</p>
            @endforeach
            <p><b>Téléphone :</b> {!! $etudiant->phone !!}</p>
            <p><b>Courriel :</b> {!! $user[0]->email !!}</p>
            <p><b>Date de naissance :</b> {!! $etudiant->birthdate !!}</p>
            <hr>
            <div class="row ml-1">
                <a href="{{ route('etudiant.edit', $etudiant->id) }}" class="btn btn-outline-primary mt-2 mr-4">Modifier le profil</a>
                <form method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger mt-2">Supprimer le profil</button>
                </form>
            </div>
        </div>
    </div>
@endsection