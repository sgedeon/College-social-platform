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
@php $locale = session()->get('locale'); @endphp
        <main class="login-form">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center pt-5">
                        <h1 class="display-one mt-5">{{ config('app.name')}}</h1>
                        <h2>@lang('lang.college_social_network')</h2>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 pt-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3 class="">@lang('lang.text_login')</h3>
                            </div>
                            <div class="card-header text-center">
                                <a class="d-inline nav-link btn btn-outline-primary" href="{{ route('lang', 'fr')}}">Fr</a>
                                <a class="d-inline nav-link btn btn-outline-primary" href="{{ route('lang', 'en')}}">En</a>
                            </div>
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="card-body">
                                @if($errors)             
                                    @foreach($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                        <strong>{{ $error }}</strong><br>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                    @endforeach
                                @endif
                                <form action="{{ route('custom.login')}}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input type="email" placeholder="username" name="email" class="form-control">
                                        @if($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" placeholder="Password" name="password" class="form-control">
                                        @if($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password')}}</span>
                                        @endif
                                    </div>
                                    <div class="d-grid mx-auto col-md-12 text-center">
                                        <button type="submit" class="btn btn-outline-primary">@lang('lang.text_login')</button>
                                        <a href="{{ route('registration') }}" class="btn btn-outline-primary ">@lang('lang.text_registration')</a>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</body>
