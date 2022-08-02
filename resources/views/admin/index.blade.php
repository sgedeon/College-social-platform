@extends('layouts.app')
@section('content')
        <div class="row">
            <div class="col-12 pt-2">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Important !</h1>
                    <p class="mb-4">La liste des élèves est mise à jour à minuit chaque soir. Notez qu'il est de votre responsabilité de nous contacter si les informations vous concernant sont erronnées. <a target="_blank"
                            href="https://www.cmaisonneuve.qc.ca/projet-islam/contact/#:~:text=Pour%20des%20demandes%20d'entrevue,254%2D7131%2C%20poste%204599.">Nous contactez</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listes des élèves</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><b>Nom</b></th>
                                            <th><b>Adresse</b></th>
                                            <th><b>Ville</b></th>
                                            <th><b>Téléphone</b></th>
                                            <th><b>Courriel</b></th>
                                            <th><b>Date de naissance</b></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><b>Nom</b></th>
                                            <th><b>Adresse</b></th>
                                            <th><b>Ville</b></th>
                                            <th><b>Téléphone</b></th>
                                            <th><b>Courriel</b></th>
                                            <th><b>Date de naissance</b></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse($etudiants as $etudiant)
                                        <tr>
                                            <td><a href="{{ route('etudiant.show', $etudiant->id) }}">{{ ucfirst($etudiant->name) }}</a></td>
                                            <td>{!! $etudiant->adress !!}</td>
                                            @forelse($villes as $ville)
                                                @if ($ville->id == $etudiant->villeId)
                                                    <td>{!! $ville->nom !!}</td>
                                                @endif
                                            @empty
                                                <td class="text-warning">Aucun ville inscrite</td>
                                            @endforelse
                                            <td>{!! $etudiant->phone !!}</td>
                                            <td>{!! $etudiant->email !!}</td>
                                            <td>{!! $etudiant->birthdate !!}</td>
                                        </tr>
                                        @empty
                                        <li class="text-warning">Aucun étudiant inscrit</li>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
@endsection

