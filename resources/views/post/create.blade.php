@extends('layouts.app')

@section('title')
Creating New Post For {{$user->username}}
@endsection

@section('content')
<div class='container'>
    <form action="/p" enctype='multipart/form-data' method='post'>
        @csrf

        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Make A New Post For {{$user->username}}</h1>
                </div>

                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Post Caption</label>

                    <input
                        id="caption"
                        type="text"
                        class="form-control @error('caption') is-invalid @enderror"
                        name="caption"
                        value="{{ old('caption') }}"
                        required
                        autocomplete="caption" autofocus>

                    @error('caption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <label for='image_url' class='col-md-4 col-form-label'>Post Image</label>
                    @error('image_url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="file" class='form-control-file' id='image_url' name='image_url'>
                </div>

                <div class="row pt-4">
                    <a href="/profile/{{$user->id}}" class='btn btn-secondary'>Cancel</a>
                    <button class="btn btn-primary ml-3">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
