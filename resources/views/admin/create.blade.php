@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2>Vos informations</h2>
                    </div>
                    <div class="card-body">
                        <form method="post">
                        @csrf
                            <div class="column">
                                <div class="control-group mt-4">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control mt-2" required>
                                </div>
                                <div class="control-group mt-4">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" name="adresse" id="adresse" class="form-control mt-2" required></input>
                                </div>
                                <div class="control-group mt-4">
                                    <label for="villeId" class="mr-4">Ville</label>
                                    <select name="villeId" id="villeId">
                                    @foreach($villes as $ville)
                                         <option value="{!! $ville->id !!}">{!! $ville->nom !!}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="control-group mt-4">
                                    <label for="phone">Téléphone</label>
                                    <input type="tel" name="phone" id="phone" class="form-control mt-2" required></input>
                                </div>
                                <div class="control-group mt-4">
                                    <label for="email">Courriel</label>
                                    <input  type="email" name="email" id="email" class="form-control mt-2" required></input>
                                </div>
                                <div class="control-group mt-4">
                                    <label for="date_de_naissance">Date de naissance</label>
                                    <input  type="date" name="date_de_naissance" id="date_de_naissance" class="form-control mt-2" required></input>
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