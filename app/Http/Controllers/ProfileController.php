<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class ProfileController extends Controller
{
    public function index(){
        $userId = Auth::user()->id;
       $user = User::where('id', $userId)->first();
        return view('admin.profile.index',compact('user'));
    }
    public function change(ProfileRequest $request){
       $data = $this->getData($request);
        User::where('id', Auth::user()->id)->update($data);
        return back()->with(['updateSuccess'=>'Account Update Successfully...']);
    }
    public function directChangePassword(){
        return view('admin.profile.changePassword');
    }
    public function changePassword(Request $request){
        $validator = $this->validationCheck($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
       $userData = User::where('id', Auth::user()->id)->first();
       $dbPw = $userData->password;
       if(Hash::check($request->oldPassword,$dbPw)){
            User::where('id', Auth::user()->id)->update([ 'password' => Hash::make($request->newPassword) ]);
            return redirect()->route('admin#profile');
       }else{
            return redirect()->route('admin#directChangePassword')->with(['updatePassword' => 'Your Old Password Do Not Match...' ]);
       }
    }
    private function getData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
    }
    private function validationCheck($request){
        return Validator::make($request->all(), [
            'oldPassword' => ['required',Password::min(8)],
            'newPassword' => ['required',Password::min(8)],
            'confirmPassword' => ['required',Password::min(8),'same:newPassword'],
        ]);
    }
}
