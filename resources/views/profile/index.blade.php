@extends('layouts.app')

@section('title')
{{$user->username}}'s Profile
@endsection

@section('content')
<div class="container" style='width: 975px; padding: 20px;'>
    <div class="row pb-5">
        <div class="col-3 d-flex justify-content-center mr-5">
            <div class="">
                <img style='border-radius: 50%;' class='w-100' src={{'/storage/'.$user->profile->image}} alt="Profile Picture">
            </div>
        </div>
        <div class="col-8">
            <div class='d-flex justify-content-between align-items-baseline'>
                <div class='d-flex justify-content-center align-items-center'>
                    <h1 class='mt-2'>{{ $user->username }}</h1>
                    @if(auth()->user()?->id != $user->id)
                    <follow-button id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                    @endif
                </div>
                @if(auth()->user()?->id == $user->id)
                <a href="/p/create">Create New Post</a>
                @endif
            </div>
            @if(auth()->user()?->id == $user->id)
            <a href={{'/profile/'.$user->id.'/edit'}}>Edit Profile</a>
            @endif
            <div class='d-flex'>
                <div class='mr-5'><strong>{{$postCount}}</strong> posts</div>
                <div class='mr-5'><strong>{{$followersCount}}</strong> followers</div>
                <div class='mr-0'><strong>{{$followingCount}}</strong> following</div>
            </div>
            <div class='pt-4'>
                <h4>{{ $user->profile?->title ?: 'Blank title' }}</h4>
                <p>{{ $user->profile?->description ?: 'Blank description' }}</p>
                <a href="#" style='color: rgb(7, 61, 112);'><h5>{{ $user->profile?->url ?: '' }}</h5></a>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center" style='border-top: 1px solid #ccc;'>
        <a class='mr-5' style='height: 50px; color: black; border-top: 1px solid black; text-decoration: none;' href="#"><img class='mr-1' style='height: 20px;' src="https://img.icons8.com/ios/452/grid.png"> POSTS</a>
        <a class='mr-0' style='height: 50px; color: gray; text-decoration: none;' href="#"><img class='mr-1' style='height: 20px;' src="https://cdn.iconscout.com/icon/free/png-512/account-profile-avatar-man-circle-round-user-30452.png"> TAGGED</a>
    </div>

    <!-- grid approach -->
    <div class="row">
        @foreach($user->posts as $index => $post)
        <a href={{'/p/'.$post->id}}>
            <img src={{'/storage/'.$post->image_url}} class='' style='{{ "width: 100%; margin-bottom: 25px;"/*("width: 30%; margin-bottom: 5%;".(($index % 3 == 2) ? " " : " margin-right: 5%; "))*/ }}'>
        </a>
        @endforeach
    </div>

    <!-- nested flexbox approach

    <div class="row d-flex flex-column">
        <div class="d-flex justify-content-center w-100 mb-4">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/e35/c105.0.617.617a/145878027_842261619672422_3701576441888003086_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=102&_nc_ohc=EPhHWnnRXLkAX_kMePw&tp=1&oh=86672ddea8e46408970a7e3281363802&oe=60494307">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.824.824a/s640x640/143377875_747593889489606_5323934135154740495_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=106&_nc_ohc=m0ZE-I0BAiYAX8_JuyW&tp=1&oh=4e638c8ea5e299746e0947144d820837&oe=6047EE84">
            <img style='flex-grow: 1; width: 25%;' class='mr-0' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.823.823a/s640x640/140507228_196917682183052_8114511830349298512_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=EAK0ughsvQYAX9qrgFb&tp=1&oh=8fd7fd39df5bc1d7d6775a4a37e613b0&oe=60484A91">
        </div>
        <div class="d-flex justify-content-center w-100 mb-4">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.823.823a/s640x640/139964418_455868755429422_5426672429118341455_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=110&_nc_ohc=7WgA_ZnQLB8AX_scWwq&tp=1&oh=d926f72ac7bb46b05ece4803b03421a4&oe=6048F2EE">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.823.823a/s640x640/137282729_891157201697073_3007940832466214946_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=109&_nc_ohc=oJMAYFouP3wAX-B-Glc&tp=1&oh=8cd6edd015e37108075807cad5d1883d&oe=60497B0E">
            <img style='flex-grow: 1; width: 25%;' class='mr-0' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/e35/c139.0.550.550a/135485859_201650958336080_4564845623124856800_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=F2GytqBxDZQAX8VRQ6r&tp=1&oh=5466a90864745162263f1a2c9dcbdb77&oe=604AD35C">
        </div>
        <div class="d-flex justify-content-center w-100 mb-4">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/e35/c105.0.617.617a/145878027_842261619672422_3701576441888003086_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=102&_nc_ohc=EPhHWnnRXLkAX_kMePw&tp=1&oh=86672ddea8e46408970a7e3281363802&oe=60494307">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.824.824a/s640x640/143377875_747593889489606_5323934135154740495_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=106&_nc_ohc=m0ZE-I0BAiYAX8_JuyW&tp=1&oh=4e638c8ea5e299746e0947144d820837&oe=6047EE84">
            <img style='flex-grow: 1; width: 25%;' class='mr-0' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.823.823a/s640x640/140507228_196917682183052_8114511830349298512_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=EAK0ughsvQYAX9qrgFb&tp=1&oh=8fd7fd39df5bc1d7d6775a4a37e613b0&oe=60484A91">
        </div>
        <div class="d-flex justify-content-center w-100 mb-4">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/e35/c105.0.617.617a/145878027_842261619672422_3701576441888003086_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=102&_nc_ohc=EPhHWnnRXLkAX_kMePw&tp=1&oh=86672ddea8e46408970a7e3281363802&oe=60494307">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.824.824a/s640x640/143377875_747593889489606_5323934135154740495_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=106&_nc_ohc=m0ZE-I0BAiYAX8_JuyW&tp=1&oh=4e638c8ea5e299746e0947144d820837&oe=6047EE84">
            <img style='flex-grow: 1; width: 25%;' class='mr-0' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.823.823a/s640x640/140507228_196917682183052_8114511830349298512_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=EAK0ughsvQYAX9qrgFb&tp=1&oh=8fd7fd39df5bc1d7d6775a4a37e613b0&oe=60484A91">
        </div>
        <div class="d-flex justify-content-center w-100 mb-4">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/e35/c105.0.617.617a/145878027_842261619672422_3701576441888003086_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=102&_nc_ohc=EPhHWnnRXLkAX_kMePw&tp=1&oh=86672ddea8e46408970a7e3281363802&oe=60494307">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.824.824a/s640x640/143377875_747593889489606_5323934135154740495_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=106&_nc_ohc=m0ZE-I0BAiYAX8_JuyW&tp=1&oh=4e638c8ea5e299746e0947144d820837&oe=6047EE84">
            <img style='flex-grow: 1; width: 25%;' class='mr-0' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.823.823a/s640x640/140507228_196917682183052_8114511830349298512_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=EAK0ughsvQYAX9qrgFb&tp=1&oh=8fd7fd39df5bc1d7d6775a4a37e613b0&oe=60484A91">
        </div>
        <div class="d-flex justify-content-center w-100 mb-4">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/e35/c105.0.617.617a/145878027_842261619672422_3701576441888003086_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=102&_nc_ohc=EPhHWnnRXLkAX_kMePw&tp=1&oh=86672ddea8e46408970a7e3281363802&oe=60494307">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.824.824a/s640x640/143377875_747593889489606_5323934135154740495_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=106&_nc_ohc=m0ZE-I0BAiYAX8_JuyW&tp=1&oh=4e638c8ea5e299746e0947144d820837&oe=6047EE84">
            <img style='flex-grow: 1; width: 25%;' class='mr-0' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.823.823a/s640x640/140507228_196917682183052_8114511830349298512_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=EAK0ughsvQYAX9qrgFb&tp=1&oh=8fd7fd39df5bc1d7d6775a4a37e613b0&oe=60484A91">
        </div>
        <div class="d-flex justify-content-center w-100 mb-4">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/e35/c105.0.617.617a/145878027_842261619672422_3701576441888003086_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=102&_nc_ohc=EPhHWnnRXLkAX_kMePw&tp=1&oh=86672ddea8e46408970a7e3281363802&oe=60494307">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.824.824a/s640x640/143377875_747593889489606_5323934135154740495_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=106&_nc_ohc=m0ZE-I0BAiYAX8_JuyW&tp=1&oh=4e638c8ea5e299746e0947144d820837&oe=6047EE84">
            <img style='flex-grow: 1; width: 25%;' class='mr-0' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.823.823a/s640x640/140507228_196917682183052_8114511830349298512_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=EAK0ughsvQYAX9qrgFb&tp=1&oh=8fd7fd39df5bc1d7d6775a4a37e613b0&oe=60484A91">
        </div>
        <div class="d-flex justify-content-center w-100 mb-4">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/e35/c105.0.617.617a/145878027_842261619672422_3701576441888003086_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=102&_nc_ohc=EPhHWnnRXLkAX_kMePw&tp=1&oh=86672ddea8e46408970a7e3281363802&oe=60494307">
            <img style='flex-grow: 1; width: 25%;' class='mr-4' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.824.824a/s640x640/143377875_747593889489606_5323934135154740495_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=106&_nc_ohc=m0ZE-I0BAiYAX8_JuyW&tp=1&oh=4e638c8ea5e299746e0947144d820837&oe=6047EE84">
            <img style='flex-grow: 1; width: 25%;' class='mr-0' src="https://instagram.ftbs4-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c2.0.823.823a/s640x640/140507228_196917682183052_8114511830349298512_n.jpg?_nc_ht=instagram.ftbs4-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=EAK0ughsvQYAX9qrgFb&tp=1&oh=8fd7fd39df5bc1d7d6775a4a37e613b0&oe=60484A91">
        </div>
    </div>

-->
</div>
@endsection
