<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12 pt-2">
                    <div class="card mt-5">
                        <div class="card-header">
                            <h2>Vos informations</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('custom.registration')}}" method="post">
                                @csrf
                                <div class="column">
                                    <div class="control-group mt-4">
                                        <label for="name">Nom</label>
                                        <input type="text" name="name" id="name" class="form-control mt-2" required>
                                        @if($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name')}}</span>
                                        @endif
                                    </div>
                                    <div class="control-group mt-4">
                                        <label for="email">Courriel</label>
                                        <input  type="email" name="email" id="email" class="form-control mt-2" required></input>
                                        @if($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email')}}</span>
                                        @endif
                                    </div>
                                    <div class="control-group mt-4">
                                        <label for="password">Password</label>
                                        <input  type="password" name="password" id="password" class="form-control mt-2" required></input>
                                        @if($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password')}}</span>
                                        @endif
                                    </div>
                                    <div class="control-group mt-4">
                                        <label for="adress">Adresse</label>
                                        <input type="text" name="adress" id="adress" class="form-control mt-2" required></input>
                                        @if($errors->has('adress'))
                                            <span class="text-danger">{{ $errors->first('adress')}}</span>
                                        @endif
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
                                        @if($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone')}}</span>
                                        @endif
                                    </div>
                                    <div class="control-group mt-4">
                                        <label for="birthdate">Date de naissance</label>
                                        <input  type="date" name="birthdate" id="birthdate" class="form-control mt-2" required></input>
                                        @if($errors->has('birthdate'))
                                            <span class="text-danger">{{ $errors->first('birthdate')}}</span>
                                        @endif
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
    </main>
</body>
