<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class PasswordResetsController extends Controller
{

    private function sendResetEmail($email, $token){
        $user = DB::table('users')->where('email', $email)->select('name','email')->first();

        $link = $_ENV['APP_URL'] . 'auth/resetpassword/' . $token;

        $details = [
            'title' => 'myurl Password Reset',
            'link' => $link
        ];
        try {
            Mail::to($email)->send(new PasswordResetMail($details));
            return true;
        } catch(Exception $e) {
            return false;
        }
    }

    public function resetlink(Request $request){
        $user = DB::table('users')->where('email','=',$request->email)->first();

        if (!$user){
            return back()->with('fail', 'User with such email address does not exist!');
        }

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str_random(60),
            'created_at' => Carbon::now()
        ]);

        $tokenData = DB::table('password_resets')->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return back()->with('success', 'A reset link has been sent to your email address!');
        } else {
            return back()->with('fail', 'A Network Error occurred. Please try again!');
        }
    }

    public function resetView($token){
        $data = array(
            'token' => $token
        );
        return view('/auth/resetpassword')->with($data);
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'token' => 'required'
        ]);

        if ($request->password1 != $request->password2){
            return back()->with('fail', 'Passwords you entered doesn\'t match!');
        }

        if (strlen($request->password1) > 20 || strlen($request->password1) < 6){
            return back()->with('fail', 'Password need to be at least 6 and maximum 20 characters!');
        }

        if ($validator->fails()){
            return back()->with('fail', 'Please complete the form!');
        }

        $password = $request->password;

        $tokenData = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$tokenData) {
            return redirect('/auth/login')->with('fail','Invalid token!');
        }

        $user = User::where('email', $tokenData->email)->first();

        if (!$user) {
            return redirect('/auth/login')->with('fail','Invalid user!');
        }

        User::where('email', $request->email)->update(array('password' => Hash::make($request->password1)));
        DB::table('password_resets')->where('email', $user->email)->delete();

        return redirect('/auth/login')->with('success','Your password has been updated! You can log in now!');

    }
}
