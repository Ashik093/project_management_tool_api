<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::get());
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->is_active = $request->status;
        //$user->role_id = $request->role_id;
        //$user->department_id = $request->department_id;
        $folderPath = "uploads/images/";
        if($request->image){
            $name = time().uniqid().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            Image::make($request->image)->save(public_path($folderPath).$name);
            $user->profile_photo = $folderPath.$name;
        }else{
            $user->profile_photo = 'uploads/images/avatar.png';
        }
        $user->save();
        return UserResource::make($user);
    }
    public function destroy($id)
    {
        $user =User::find($id);
        if($user->profile_photo !='uploads/images/avatar.png'){
            unlink($user->profile_photo);
        }
        $user->delete();
        return UserResource::make($user);
    }
}
