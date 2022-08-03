<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villes = Ville::all()->sortBy('nom');
        return view('auth.registration', ['villes' => $villes]);
    }

    /**
     * Allow to connect a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function customLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(!Auth::validate($credentials)): 
            return redirect('login')->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user, $request->get('remember'));

        return redirect()->intended('dashboard')->withSuccess('Connecté');

    }

    public function dashboard(){
        $name = "Invité";
        if(Auth::check()){
            $name = Auth::user()->name;
            $profil = Auth::user()->profil;
            session()->put('name', $name);
            session()->put('profil', $profil);
        }
        return view('admin.dashboard');
    }

    /**
     * Close a session.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(){
        Session::flush();
        Auth::logout();

        return Redirect(route('login'));
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
            'phone' => 'required|unique:etudiants',
            'birthdate' => 'required|date',
        ]);
        
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->profil = 'student';
        $user->save();

        $id=$user['id'];

        $newEtudiant = Etudiant::create([
            "adress"=> $request->adress,
            "phone"=> $request->phone,
            "birthdate"=> $request->birthdate,
            "villeId"=> $request->villeId,
            "userId"=> $id
        ]);
    
        return redirect(route('login'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
