<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showSetupForm()
    {
        return view('profile');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|url|max:255',
        ]);

        $user = auth()->user();
        $user->bio = $request->bio;
        $user->avatar = $request->avatar;
        $user->save();

        return redirect('/home')->with('success', 'プロフィールを更新しました！');
    }
}
