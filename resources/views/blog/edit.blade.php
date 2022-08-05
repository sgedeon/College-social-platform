@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <h1 class="display-4">Modifier un message</h1>
                <a href="{{ route('blog')}}" class="btn btn-primary btn-sm mt-3">@lang('lang.return')</a>
                <div class="card mt-5">
                    <div class="card-header">
                        Message
                    </div>
                    <div class="card-body">
                        <form method="post">
                            @csrf
                            @method('PUT')
                            <div class="column">
                                <div class="control-group mt-4">
                                    <label for="title">@lang('lang.text_title')</label>
                                    <input type="text" name="title" id="title" class="form-control mt-2" value=" {{ $title[0]->title }}">
                                    @if($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title')}}</span>
                                    @endif
                                </div>
                                <div class="control-group mt-4">
                                    <label for="body">@lang('lang.text_message')</label>
                                    <textarea name="body" id="body" class="form-control mt-2">{{ ucfirst($body[0]->body)}}</textarea> 
                                    @if($errors->has('body'))
                                        <span class="text-danger">{{ $errors->first('body')}}</span>
                                    @endif
                                </div>
                                <div class="control-group mt-4">
                                    <label for="categories_id">@lang('lang.text_category')</label>
                                    <select name="categories_id" id="categories_id" class="form-control mt-2">
                                        @foreach($categories as $categorie)
                                            <option value="{{$categorie->id}}">{{$categorie->categorie}}</option>
                                        @endforeach
                                    </select> 
                                </div>
                                <div class="control-group mt-4">
                                    <input type="submit" class="btn btn-primary mt-2" value="@lang('lang.send')">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection