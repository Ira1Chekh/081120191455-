<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update_avatar(StoreUser $request){

        $request->validated();
        $user = Auth::user();
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        $request->avatar->storeAs('avatars',$avatarName);
        $user->avatar = $avatarName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');

    }
}
