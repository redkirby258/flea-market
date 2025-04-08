<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        return view('edit', compact('user', 'profile'));
    }

    
    public function update(Request $request)
    {
        $user = Auth::user();

        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // プロフィール情報の取得・更新
        $profile = $user->profile ?? new Profile();
        $profile->user_id = $user->id;
        $profile->building = $request->building;
        $profile->phone = $request->phone;
        $profile->address = $request->address;

        // プロフィール画像のアップロード処理
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profiles', 'public');
            $profile->profile_image = $path;
        }

        $profile->save();

        // ユーザー名の更新
        $user->name = $request->name;
        $user->save();

        return redirect()->route('edit')->with('success', 'プロフィールを更新しました');
    }
}
