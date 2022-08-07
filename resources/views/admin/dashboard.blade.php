@extends('layouts.app')
@section('content')
@php $name = session()->get('name'); @endphp
    <section>
        <h1>@lang('lang.welcome') {{ $name  }}</h1>
        <br>
        <h2>@lang('lang.access_student_directory') <a href="{{ route('etudiants') }}">@lang('lang.here')</a></h2>
    </section>
@endsection