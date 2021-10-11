<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // ako korisnik nije ulogovan, moze da pristupi samo /auth/login, /auth/register, /auth/forgotpassword, /auth/resetpassword i /
        if (!session()->has('LoggedUser') && ($request->path() != 'auth/login' && $request->path() != 'auth/register' && $request->path() != '/' && $request->path() != 'auth/forgotpassword' && $request->path() != 'auth/resetpassword/{token}')){
            return redirect('auth/login')->with('fail', 'You must be logged in!');
        }

        // ako je korisnik logovan ne moze da pristupi /auth/login, /auth/register, /auth/forgotpassword, /auth/resetpassword/{token} i /
        if (session()->has('LoggedUser') && ($request->path() == 'auth/login' || $request->path() == 'auth/register' || $request->path() == '/' || $request->path() == 'auth/forgotpassword' && $request->path() == 'auth/resetpassword/{token}')) {
            return back();
        }

        // ako je logovani korisnik obican korisnik a ne admin, on ne moze da pristupi admin panelu
        if (session()->has('LoggedUser') && User::where('id', session('LoggedUser'))->first()->user_role == 0 && ($request->path() == 'admin/dashboard' || $request->path() == 'admin/finduser' || $request->path() == 'admin/finduser/delete/{userId}' || $request->path() == 'admin/finduser/changerole/{userId}' || $request->path() == 'admin/editurls/{userId}' || $request->path() == 'admin/deleteurl/{urlId}' || $request->path() == 'admin/appinfo')){
            return redirect('pages/home')->with('fail', 'You are not admin!');
        }

        // ako je logovani korisnik admin ne moze da pristupi pages/*
        if (session()->has('LoggedUser') && User::where('id', session('LoggedUser'))->first()->user_role == 1 && ($request->path() == 'pages/home' || $request->path() == 'pages/myUrls' || $request->path() == 'pages/settings' || $request->path() == 'pages/delete/{urlid}' || $request->path() == 'pages/urlchange/{urlid}' || $request->path() == 'pages/profile')) {
            return redirect('admin/dashboard')->with('fail', 'You cannot access the App as an Admin!');
        }

        // ako se korisnik izloguje i pokusa na back dugme da se vrati
        return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')->header('Pragma', 'no-cache')->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT');
    }
}
