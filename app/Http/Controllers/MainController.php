<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Url;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Debugbar;

class MainController extends Controller
{
    public function login() {
        return view('/auth/login');
    }

    public function register() {    
        return view('/auth/register');
    }

    public function index(){
        return view('/default/index');
    }

    public function home(){
        return view('pages.home');
    }

    public function save(Request $request){
        $request->validate([
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();


        if ($save) {
            return back()->with('success', 'Thanks for signing up. You can now log in.');
        } else {
            return back()->with('fail', 'Something went wrong, try again later!');
        }
    }

    public function check(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ]);

        $userInfo = User::where('email', '=', $request->email)->first();

        if (!$userInfo) {
            return back()->with('fail', 'User with such email is not found!');
        } else {
            if (Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedUser', $userInfo->id);
                $request->session()->put('UserName', $userInfo->name);

                if ($userInfo->user_role == 0) {
                    return redirect('/pages/home');
                } elseif($userInfo->user_role == 1){
                    return redirect('/admin/dashboard');
                }
            } else {
                return back()->with('fail', 'Incorrect password!');
            }
        }


    }

    public function logout(){
        if (session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            session()->pull('UserName');

            return redirect('/');
        } else {
            return redirect('/auth/login');
        }
    }

    public function myurls(){
        $urls = Url::where('user_id',session('LoggedUser'))->simplePaginate(5);


        return view('/pages/myurls', ['urls' => $urls]);
    }

    public function settings(){
        return view('/pages/settings');
    }

    public function nameChange(Request $request){
        if ($request->name == "" || strlen(trim($request->name)) < 5){
            return back()->with('nameFail', 'Minimum name length is 5!');
        }
        if (User::where('id', session('LoggedUser'))->first()->name == $request->name){
            return back()->with('nameFail', 'That is already your name!');
        }

        User::where('id', session('LoggedUser'))->update(array('name' => $request->name));
        session()->put('UserName', $request->name);

        return back()->with('nameSuccess', 'Name changed successfully!');
    }

    public function emailChange(Request $request){
        if (User::where('id', session('LoggedUser'))->first()->email == $request->newEmail){
            return back()->with('emailFail', 'That is already your email!');
        } 
        if (User::where('id', session('LoggedUser'))->first()->email != $request->oldEmail){
            return back()->with('emailFail', 'Wrong old email, please try again!');
        }
        if (User::where('email',$request->newEmail)->first()){
            return back()->with('emailFail', 'Email is already in use!');
        }

        User::where('id', session('LoggedUser'))->update(array('email' => $request->newEmail));
        return back()->with('emailSuccess', 'Email changed successfully!');
    }

    public function passwordChange(Request $request){
        if (!Hash::check($request->oldPassword, User::where('id', session('LoggedUser'))->first()->password)){
            return back()->with('passwordFail', 'You entered wrong old password!');
        }
        if ($request->newPassword1 != $request->newPassword2) {
            return back()->with('passwordFail', 'Entered passwords doesnt\'t match!');
        }
        if (strlen($request->newPassword1) > 20 || strlen($request->newPassword1) < 6){
            return back()->with('passwordFail', 'New password should have at least 6 and maximum 20 characters!');
        }

        User::where('id', session('LoggedUser'))->update(array('password' => Hash::make($request->newPassword1)));

        return back()->with('passwordSuccess', 'Password changed successfully!');
    }

    public function profile(){
        $userInfo = User::where('id', session('LoggedUser'))->first();

        $data = array(
            'name' => $userInfo->name,
            'email' => $userInfo->email,
            'total_urls' => $userInfo->total_urls,
            'active_urls' => $userInfo->active_urls,
            'deleted_urls' => $userInfo->deleted_urls
        );

        return view('/pages/profile')->with($data);
    }

    public function forgotpassword(){
        return view('/auth/forgotpassword');
    }
}
