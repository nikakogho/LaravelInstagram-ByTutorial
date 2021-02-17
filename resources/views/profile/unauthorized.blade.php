@extends('layouts.app')

@section('title')
Unauthorized Access
@endsection

@section('content')
<div class='d-flex'>
    <p>Basically you are not allowed to access this page with that user</p>
    <a class='ml-5' href='/login'>Log In</a>
    <a class='ml-5' href='/home'>Home</a>
</div>
@endsection
