<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        if (auth()->user() === null) return false;
        if (auth()->user()->id == $user->id) return false; //'Cannot follow yourself!';

        auth()->user()->following()->toggle($user->profile);

        return auth()->user()->following->contains($user->profile);
    }
}
