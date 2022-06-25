@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 pt-2">
            <h2>{{ ucfirst($etudiant->nom) }}</h2>
            <p><b>Adresse :</b> {!! $etudiant->adresse !!}</p>
            @foreach ($ville as $nom)
                 <p><b>Ville :</b> {!! $nom->nom !!}</p>
            @endforeach
            <p><b>Téléphone :</b> {!! $etudiant->phone !!}</p>
            <p><b>Courriel :</b> {!! $etudiant->email !!}</p>
            <p><b>Date de naissance :</b> {!! $etudiant->date_de_naissance !!}</p>
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