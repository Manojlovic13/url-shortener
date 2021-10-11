<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use App\Models\User;
use Debugbar;

class UrlController extends Controller
{
    public function check(Request $request){
        if (!filter_var($request->longurl, FILTER_VALIDATE_URL)){
            return back()->with('fail', 'Please enter valid url address!');
        }

        $shortUrl = Url::where('short_url','=',$request->shorturl)->first();



        if (!$shortUrl){
            // ako ne postoji vec takav dozvoliti i upisati u bazu

            $url = new Url;
            $url->long_url = $request->longurl;
            $url->short_url = $request->shorturl;
            $url->user_id = session('LoggedUser');
            $save = $url->save();

            if (!$save){
                return back()->with('fail','Something went wrong, please try again later!');
            } else {

                User::where('id', session('LoggedUser'))->update(array('total_urls' => User::where('id', session('LoggedUser'))->first()->total_urls + 1));
                User::where('id', session('LoggedUser'))->update(array('active_urls' => User::where('id', session('LoggedUser'))->first()->active_urls + 1));
                return back()->with('success', 'Your short url is ready!');
            }

        } else {
            return back('fail', 'Short url is already in use!');
        }
    }

    public function intersection(Request $request, $shorturl){
        $longurl = Url::where('short_url','=', $_ENV['APP_URL'] . "url/" . $shorturl)->first();

        if (!$longurl) {
            return redirect('/pages/home');
        } else {
            return redirect($longurl->long_url);
        }
    }

    public function deleteUrl(Request $request, $urlid){
        if (!session()->has('LoggedUser')) {
            return view('/auth/login')->with('fail','Log in first to delete url!');
        }
        if (session('LoggedUser') != Url::where('id',$urlid)->first()->user_id) {
            MainController::logout();
            return view('/auth/login')->with('fail', 'This is not your url!');
        }

        Url::where('id', $urlid)->delete();
        User::where('id', session('LoggedUser'))->update(array('active_urls' => User::where('id', session('LoggedUser'))->first()->active_urls - 1));
        User::where('id', session('LoggedUser'))->update(array('deleted_urls' => User::where('id', session('LoggedUser'))->first()->deleted_urls + 1));
        return back();
    }

    public function urlChange($urlid){
        $query = Url::where('id' , $urlid)->first();

        $data = array('short_url' => $query->short_url,
        'long_url' => $query->long_url,
        'urlid' => $urlid);
        

        return view('/pages/urlchange')->with($data);
    }

    public function changeUrl(Request $request, $urlid){
        $query = Url::where('id', $urlid)->first();

        if ($query->long_url == $request->long_url && $query->short_url == $request->short_url){
            return back()->with('fail', 'You didn\'t change anything!');
        }
        if ($request->long_url == "" && $request->short_url == ""){
            return back()->with('fail', 'You can\'t  leave both fields blank!');
        }
        if ($request->long_url == "" && $query->short_url == $request->short_url || $request->short_url == "" && $query->long_url == $request->long_url){
            return back()->with('fail', 'Please change one url!');
        } 

        if (!filter_var($request->long_url, FILTER_VALIDATE_URL)){
            return back()->with('fail', 'Please enter valid url address!');
        }

        // promenio je samo short_url
        if ($request->short_url != $query->short_url && ($request->long_url == $query->long_url || $request->long_url == "")){
            if (!Url::where('short_url', $request->short_url)->first()){
                return back()->with('fail', 'Such short url is already in use!');
            }
            Url::where('id', $urlid)->update(array('short_url' => $request->short_url));
            return redirect()->route('pages.myurls')->with('success','Short url changed successfully!');
        }

        //promenio je samo long_url
        if ($request->long_url != $query->long_url && ($request->short_url == $query->short_url || $request->short_url == "")){
            Url::where('id', $urlid)->update(array('long_url' => $request->long_url));
            return redirect()->route('pages.myurls')->with('success', 'Long url changed successfully!');
        }

        // promenio je obe adrese

        if (!Url::where('short_url', $request->short_url)->first()){
            return back()->with('fail', 'Such short url is already in use!');
        }

        Url::where('id', $urlid)->update(array('long_url' => $request->long_url));
        Url::where('id', $urlid)->update(array('short_url' => $request->short_url));

        return redirect()->route('pages.myurls')->with('success', 'Long and short url changed successfully!');

    }
}
