@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <h1 class="display-4">Modifier un élève</h1>
                <div class="card mt-5">
                    <div class="card-header">
                        <h1>Informations de l'élève</h1>
                    </div>
                    <div class="card-body">
                        <form method="post">
                        @csrf
                        @method('PUT')
                            <div class="column">
                                <div class="control-group mt-4">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control mt-2"  value="{!! $etudiant->nom !!}">
                                </div>
                                <div class="control-group mt-4">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" name="adresse" id="adresse" class="form-control mt-2"  value="{!! $etudiant->adresse !!}"></input>
                                </div>
                                <div class="control-group mt-4">
                                    <label for="villeId" class="mr-4">Ville</label>
                                    <select name="villeId" id="villeId">
                                    @foreach($villes as $ville)
                                        @if ($ville->id == $etudiant->villeId)
                                            <option value="{!! $ville->id !!}" selected>{!! $ville->nom !!}</option>
                                        @else
                                            <option value="{!! $ville->id !!}">{!! $ville->nom !!}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                <div class="control-group mt-4">
                                    <label for="phone">Téléphone</label>
                                    <input type="tel" name="phone" id="phone" class="form-control mt-2" value="{!! $etudiant->phone !!}"></input>
                                </div>
                                <div class="control-group mt-4">
                                    <label for="email">Courriel</label>
                                    <input  type="email" name="email" id="email" class="form-control mt-2"  value="{!! $etudiant->email !!}"></input>
                                </div>
                                <div class="control-group mt-4">
                                    <label for="date_de_naissance">Date de naissance</label>
                                    <input  type="date" name="date_de_naissance" id="date_de_naissance" class="form-control mt-2"  value="{!! $etudiant->date_de_naissance !!}"></input>
                                </div>
                                <div class="control-group mt-4">
                                    <input type="submit" class="btm-success btn btn-outline-primary" value="Envoyer">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection