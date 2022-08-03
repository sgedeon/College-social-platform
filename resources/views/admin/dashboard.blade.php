@extends('layouts.app')
@section('content')
@php $name = session()->get('name'); @endphp
    <section>
        <h1>Bienvenue {{ $name  }}</h1>
        <br>
        <h2>Accèdez à la liste de vos collègues <a href="{{ route('etudiants') }}">ici</a></h2>
    </section>
@endsection