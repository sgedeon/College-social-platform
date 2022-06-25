<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villes = Ville::all();
        $etudiants = Etudiant::all()->sortBy('nom');   // SELECT * FROM etudiants
        return view('admin.index', ['villes' => $villes,'etudiants' => $etudiants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villes = Ville::all()->sortBy('nom');
        return view('admin.create', ['villes' => $villes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newEtudiant = Etudiant::create([
            "nom"=> $request->nom,
            "adresse"=> $request->adresse,
            "phone"=> $request->phone,
            "email"=> $request->email,
            "date_de_naissance"=> $request->date_de_naissance,
            "villeId"=>$request->villeId 
        ]);
        return redirect(route('etudiants'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        $ville = Ville::select()
         ->WHERE('id','=', $etudiant['villeId'])
         ->get();
        return view('admin.show', ['ville'=>$ville, 'etudiant' =>  $etudiant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        $villes = Ville::all()->sortBy('nom');
        return view('admin.edit', ['villes' => $villes, 'etudiant' => $etudiant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $etudiant->update([
            "nom"=> $request->nom,
            "adresse"=> $request->adresse,
            "phone"=> $request->phone,
            "email"=> $request->email,
            "date_de_naissance"=> $request->date_de_naissance,
            "villeId"=>$request->villeId 
        ]);

        return redirect(route('etudiant.show', $etudiant->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return redirect(route('etudiants'));
    }
}
