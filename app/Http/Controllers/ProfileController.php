<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

use App\Models\User;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        // $user = User::findOrFail($user);

        $follows = auth()->user()?->following->contains($user->profile) ? true : false;

        $expiry_date = now()->addSeconds(30);

        $postCount = Cache::remember("postcount{{$user->id}}", $expiry_date, function () use ($user) {
            return $user->posts->count();
        });
        $followersCount = Cache::remember("followerscount{{$user->id}}", $expiry_date, function () use ($user) {
            return $user->profile->followers->count();
        });
        $followingCount = Cache::remember("followingcount{{$user->id}}", $expiry_date, function () use ($user) {
            return $user->following->count();
        });

        return view('profile.index', [
            'user' => $user,
            'follows' => $follows,
            'postCount' => $postCount,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        // if ($user != auth()->user()) return view('profile.unauthorized'); // may redirect somewhere else

        return view('profile.edit', ['user' => $user]);
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        // if ($user != auth()->user()) return view('profile.unauthorized'); // may redirect somewhere else

        $profile_data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => 'image'
        ]);

        $path = $user->profile->image;

        if (request('image')) {
            $path = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$path}"))->fit(1200, 1200);
            $image->save();
        }

        $user->profile->update(array_merge(
            $profile_data,
            ['image' => $path]
        ));

        $profile_url = '/profile/' . $user->id;

        return redirect($profile_url);
    }
}
