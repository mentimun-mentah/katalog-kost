<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{

    public function profile()
    {
        return view('account.profile');
    }

    public function password()
    {
        return view('account.password');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
          'avatar' => 'required|mimes:jpg,jpeg,png|max:1000'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        # delete image if user avatar not default.png
        $imagePath = public_path('storage/avatar/'.$user->avatar);
        if($user->avatar != 'default.png' && file_exists($imagePath)){
            unlink($imagePath); 
        }
        # save image to storage
        $imageName = Str::random(20).'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('storage/avatar/'),$imageName);
        # save image to db
        $user->avatar = $imageName;
        $user->save();

        return ['status' => 'Success update avatar'];
    }

    public function updateProfile(Request $request)
    {
      $request->validate([
        'name' => 'required|string|min:3|max:255',
        'fullname' => 'required|string|min:6|max:255',
        'phone' => 'required|min:10|max:20|regex:/(08)[0-9]{9}/',
        'address' => 'required|string|min:6',
      ]);

      $user = User::findOrFail(Auth::user()->id);
      $user->name = $request->name;
      $user->fullname = $request->fullname;
      $user->phone = $request->phone;
      $user->address = $request->address;
      $user->save();

      return ['status' => 'Success update profile'];
    }

    public function updatePassword(Request $request)
    {

      $request->validate([
          'old_password' => 'required|string|min:8|max:255',
          'password' => 'required|string|min:8|max:255|confirmed'
      ]);

      $user = User::findOrFail(Auth::user()->id);

      if(!Hash::check($request->old_password,$user->password)){
        return response()->json(['errors' => ['old_password' => ['The old password does not match with our record.']]],422);
      }

      $user->password = Hash::make($request->password);
      $user->save();

      return ['status' => 'Success update password'];

    }
}
