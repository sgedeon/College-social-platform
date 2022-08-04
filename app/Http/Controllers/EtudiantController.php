<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

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
        $etudiants = Etudiant::select('etudiants.*','users.id AS uId', 'users.name', 'users.email')
        ->rightJOIN('users', 'etudiants.userId', '=', 'users.id')
        ->get();
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
        $request->validate([
            'name' => 'required|max:30|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:10',
            'adress' => 'required|max:300|min:2',
            'profil' => 'required|max:7|min:5',
            'phone' => 'required|unique:etudiants',
            'birthdate' => 'required|date',
        ]);
        
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        $id=$user['id'];

        $newEtudiant = Etudiant::create([
            "adress"=> $request->adress,
            "phone"=> $request->phone,
            "birthdate"=> $request->birthdate,
            "villeId"=> $request->villeId,
            "userId"=> $id
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
        $user = User::select()
        ->WHERE('id','=', $etudiant['userId'])
        ->get();
        return view('admin.show', ['ville'=>$ville, 'user'=>$user, 'etudiant' =>  $etudiant]);
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
        $user = User::select()
        ->WHERE('id','=', $etudiant['userId'])
        ->get();
        return view('admin.edit', ['villes' => $villes, 'user'=>$user, 'etudiant' => $etudiant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $user = User::select()
        ->WHERE('id','=', $etudiant['userId'])
        ->get();

        $request->validate([
            'name' => 'required|max:30|min:2',
            'email' => 'required|unique:users,email,'.$user[0]->id,
            'password' => 'required|min:6|max:10',
            'adress' => 'required|max:300|min:2',
            'phone' => 'required|unique:etudiants,phone,'.$etudiant->id,
            'birthdate' => 'required|date',
        ]);

        $user[0]->name = $request['name'];
        $user[0]->email = $request['email'];
        if(Auth::user()->profil === "admin") {
            $user[0]->profil = $request->profil;
        }
        $user[0]->password = Hash::make($request['password']);

        if($etudiant->userId === Auth::user()->id || Auth::user()->profil === "admin") {
            $user[0]->save();
            $etudiant->update([
                "adress"=> $request->adress,
                "phone"=> $request->phone,
                "birthdate"=> $request->birthdate,
                "villeId"=>$request->villeId 
            ]);
        } else {
            abort(Response::HTTP_UNAUTHORIZED);
        }
        
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
        $user = User::select()
        ->WHERE('id','=', $etudiant['userId'])
        ->get();
        $etudiant->delete();
        $user[0]->delete();
        return redirect(route('etudiants'));
    }
}
