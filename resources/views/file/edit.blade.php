@extends('layouts.app')
@php $name = session()->get('name'); @endphp
@php $id = session()->get('id'); @endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
            <a href="{{ route('etudiant.show', $id) }}" class="btn btn-primary btn-sm">@lang('lang.return')</a>
            <hr>
            <div class="card">
                <div class="card-header">@lang('lang.file_upload')</div>
                <div class="card-body">
                <form method="POST" enctype="multipart/form-data" aria-label="{{ __('Upload') }}">
                        @csrf
                        @method('PUT')
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="chooseFile">
                            <label class="custom-file-label" for="chooseFile">@lang('lang.select_file')</label>
                        </div>
                        <div class="control-group mt-4">
                            <label for="name">@lang('lang.name')</label>
                            <input type="text" name="name" id="name" class="form-control mt-2" value="{{ $fileName[0]->name }}">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name')}}</span>
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
                            <input type="submit" class="btm-success btn btn-outline-primary mt-2" value="@lang('lang.text_send')">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
