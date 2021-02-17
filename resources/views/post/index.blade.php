@extends('layouts.app')

@section('title')
{{$user->username}}'s Feed
@endsection

@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="row">
        <div class="col-8">
            <a href="/p/{{$post->id}}">
                <img src="/storage/{{$post->image_url}}" class='w-100'>
            </a>
        </div>
        <div class="col-4">
            <div>
                <div class='d-flex align-items-center'>
                    <div class='pr-3'>
                        <a href="/profile/{{$post->user->id}}">
                            <img src="/storage/{{$post->user->profile->image}}" class='rounded-circle w-100' style='max-width: 50px'>
                        </a>
                    </div>
                    <div>
                        <div class='font-weight-bold'>
                            <a href="/profile/{{$post->user->id}}">
                                <span class='text-dark'>
                                    {{$post->user->username}}
                                </span>
                            </a>
                            <a href='#' class='pl-3'>Unfollow</a>
                        </div>
                    </div>
                </div>

                <p>
                    <span class='font-weight-bold'>
                        <a href="/profile/{{$post->user->id}}">
                            <span class='text-dark'>
                                {{$post->user->username}}
                            </span>
                        </a>
                    </span> {{$post->caption}}
                </p>
            </div>
        </div>
    </div>
    @endforeach

    <div class="row pt-5">
        <div class="col-12 d-flex justify-content-center">
            {{$posts->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>
@endsection
