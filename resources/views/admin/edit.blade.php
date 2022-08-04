@extends('layouts.app')
@section('content')
@php $profil = session()->get('profil'); @endphp
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <h1 class="display-4">@lang('lang.modify_the_profil')</h1>
                <div class="card mt-5">
                    <div class="card-header">
                        <h1>@lang('lang.student_informations')</h1>
                    </div>
                    <div class="card-body">
                        <form method="post">
                        @csrf
                        @method('PUT')
                            <div class="column">
                                <div class="control-group mt-4">
                                    <label for="name">@lang('lang.name')</label>
                                    <input type="text" name="name" id="name" class="form-control mt-2"  value="{!! $user[0]->name !!}" required>
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name')}}</span>
                                    @endif
                                </div>
                                <div class="control-group mt-4">
                                    <label for="email">@lang('lang.email')</label>
                                    <input  type="email" name="email" id="email" class="form-control mt-2"  value="{!! $user[0]->email !!}" required></input>
                                    @if($errors->has('email'))
                                         <span class="text-danger">{{ $errors->first('email')}}</span>
                                    @endif
                                </div>
                                <div class="control-group mt-4">
                                    <label for="password">@lang('lang.password')</label>
                                    <input  type="password" name="password" id="password" class="form-control mt-2" required></input>
                                    @if($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password')}}</span>
                                    @endif
                                </div>
                                <div class="control-group mt-4">
                                    <label for="adress">@lang('lang.adress')</label>
                                    <input type="text" name="adress" id="adress" class="form-control mt-2"  value="{!! $etudiant->adress !!}"></input>
                                    @if($errors->has('adress'))
                                        <span class="text-danger">{{ $errors->first('adress')}}</span>
                                    @endif
                                </div>
                                <div class="control-group mt-4">
                                    <label for="villeId" class="mr-4">@lang('lang.city')</label>
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
                                    <label for="phone">@lang('lang.phone_number')</label>
                                    <input type="tel" name="phone" id="phone" class="form-control mt-2" value="{!! $etudiant->phone !!}"></input>
                                    @if($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone')}}</span>
                                    @endif
                                </div>
                                <div class="control-group mt-4">
                                    <label for="birthdate">@lang('lang.birthdate')</label>
                                    <input  type="date" name="birthdate" id="birthdate" class="form-control mt-2"  value="{!! $etudiant->birthdate !!}"></input>
                                    @if($errors->has('birthdate'))
                                        <span class="text-danger">{{ $errors->first('birthdate')}}</span>
                                    @endif
                                </div>
                                @if($profil == 'admin')
                                    <div class="control-group mt-4">
                                        <label for="profil">Profil</label>
                                        <select name="profil" id="profil" class="form-control mt-2">
                                            <option value="student" selected>@lang('lang.student')</option>
                                            <option value="admin">@lang('lang.admin')</option>
                                        </select>
                                        @if($errors->has('profil'))
                                            <span class="text-danger">{{ $errors->first('profil')}}</span>
                                        @endif
                                    </div>
                                @endif
                                <div class="control-group mt-4">
                                    <input type="submit" class="btm-success btn btn-outline-primary" value="@lang('lang.send')">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection