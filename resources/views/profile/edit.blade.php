@extends('layouts.app')

@section('title')
Editing {{$user->username}}'s Profile
@endsection

@section('content')
<div class='container'>
    <form action="/profile/{{$user->id}}" enctype='multipart/form-data' method='post'>
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Edit {{$user->username}}'s Profile</h1>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Title</label>

                    <input
                        id="title"
                        type="text"
                        class="form-control @error('title') is-invalid @enderror"
                        name="title"
                        value="{{ old('title') ?? $user->profile?->title }}"
                        required
                        autocomplete="title" autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Description</label>

                    <input
                        id="description"
                        type="text"
                        class="form-control @error('description') is-invalid @enderror"
                        name="description"
                        value="{{ old('description') ?? $user->profile?->description }}"
                        required
                        autocomplete="description" autofocus>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label">URL</label>

                    <input
                        id="url"
                        type="text"
                        class="form-control @error('url') is-invalid @enderror"
                        name="url"
                        value="{{ old('url') ?? $user->profile?->url }}"
                        required
                        autocomplete="url" autofocus>

                    @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <label for='image' class='col-md-4 col-form-label'>Profile Image</label>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="file" class='form-control-file' id='image' name='image'>
                </div>

                <div class="row pt-4">
                    <a href="/profile/{{$user->id}}" class='btn btn-secondary'>Cancel</a>
                    <button class="btn btn-primary ml-3">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
