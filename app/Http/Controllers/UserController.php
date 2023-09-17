<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function welcome()
    {
        $userInfo = DB::table('users')->where('id', session('LoggedInUser'))->first();
        return view('layout.welcome', ['userInfo' => $userInfo]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        if (session()->has('LoggedInUser')) {
            return redirect(route('profile'));
        } else {
            return view("auth.register");
        }
    }

    public function saveData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|min:6|max:100',
            'cpassword' => 'required|min:6|same:password'
        ], [
            'cpassword.same' => 'Password did not matched!',
            'cpassword.required' => 'Confirm Password is required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->cpassword = Hash::make($request->cpassword);
        $user->save();
        return redirect(route('SaveData'))->with('InsertMessage', 'Successfully Registered!');
    }

    public function loginData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('LoggedInUser', $user->id);
                    return redirect(route('Welcome'))->with('LoginSuccessMessage', 'SuccessFully LogIn!');
                } else {
                    return redirect(route('login'))->with('LoginErrorMessage', 'E-mail or Password is Incorrect!');
                }
            } else {
                return redirect(route('login'))->with('LoginNotFoundMessage', 'User not Found!');
            }
        }
    }

    public function logoutData()
    {
        if (session()->has('LoggedInUser')) {
            session()->pull('LoggedInUser');
        }
        return redirect(route('login'));
    }

    public function profile()
    {
        $data = ['userInfo' => DB::table('users')->where('id', session('LoggedInUser'))->first()];
        return view("layout.profile", $data);
    }

    public function UserImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_id = $request->user_id;
        $user = User::find($user_id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/User_Image'), $fileName);
            if ($user->image) {
                Storage::delete(public_path('assets/User_Image') . $user->image);
            }
        }

        User::where('id', $user_id)->update([
            'image' => $fileName
        ]);

        $data = User::find($user_id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->number = $request->number;
        $data->dob = $request->dob;
        $data->save();


        return redirect(route('profile'));
    }
}
