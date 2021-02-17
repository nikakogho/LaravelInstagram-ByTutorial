<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('post.index', ['user' => auth()->user(), 'posts' => $posts]);
    }

    public function create()
    {
        $user = auth()->user();

        if ($user == null) return redirect('/login');

        return view('post.create', ['user' => $user]);
    }

    public function show(Post $post)
    {
        $user = auth()->user();

        if ($user == null) return redirect('/login');

        // $post = Post::findOrFail($id);

        return view('post.show', ['post' => $post]);
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image_url' => ['required', 'image']
        ]);

        $path = request('image_url')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$path}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create(
            [
                'caption' => $data['caption'],
                'image_url' => $path
            ]
        );

        $user_url = '/profile/' . auth()->user()->id;

        return redirect($user_url);
    }
}
