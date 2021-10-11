<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Url;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Debugbar;

class AdminController extends Controller
{
    //

    public function dashboard(){
        return view('admin.dashboard');
    }

    // get
    public function finduser(Request $request){
        if (isset($_GET['findby'])){
            if ($_GET['findby'] == 'email'){
               if (!filter_var($_GET['searchValue'], FILTER_VALIDATE_EMAIL)){
                   return back()->with('fail','Enter valid email address!');
               }
    
                $userInfo = User::where('email', $_GET['searchValue'])->paginate(5);
    
                if (!$userInfo){
                    return back()->with('fail','User with such email doesn\'t exist!');
                }
    
                return view('admin.finduser', [
                    'users' => $userInfo
                ]);
            } else if ($_GET['findby'] == 'name'){
                if (strlen(trim($_GET['searchValue'])) < 5){
                    return back()->with('fail','Minimum name length is 5!');
                }
    
                $userInfo = User::where('name', $_GET['searchValue'])->simplePaginate(5);
                $userInfo->appends($request->all());
    
                if(!$userInfo){
                    return back()->with('fail','User with such name doesn\'t exist!');
                }
    
            
                return view('admin.finduser', [
                    'users' => $userInfo
                ]);
            } elseif($_GET['findby'] == "id") {
                $userInfo = User::where('id', $_GET['searchValue'])->paginate(5);
    
                if(!$userInfo){
                    return back()->with('fail','User with such ID doesn\'t exist!');
                }
    
                return view('admin.finduser', [
                    'users' => $userInfo
                ]);
            } else {
                $usersInfo = User::simplePaginate(5);
                $usersInfo->appends($request->all());
        
    
                return view('admin.finduser', [
                    'users' => $usersInfo
                ]);
            }
        } else {
           return view('admin.finduser');
        }
    }

    // post
    public function search(Request $request){
        
    }

    public function deleteUser($userId){
        if (User::where('id', $userId)->first()->email == 'dusantspmanojlovic@gmail.com'){
            return back()->with('fail','You can\'t delete super admin Dusan!');
        }
        if ($userId == session('LoggedUser')){
            return back()->with('fail', 'You can\'t delete yourself!');
        }
        // kad se brise korisnik brisu se i sve njegove url adrese
        Url::where('user_id', $userId)->delete();
        User::where('id', $userId)->delete();
        return back()->with('success','User with ID ' . $userId . ' deleted successfully!');
    }

    public function changeRole($userId){
        if ($userId == session('LoggedUser')){
            return back()->with('fail', 'You can\'t change your own role!');
        }
        if (User::where('id',$userId)->first()->user_role == 0){
            User::where('id',$userId)->update(array('user_role' => 1));
        } else {
            User::where('id',$userId)->update(array('user_role' => 0));
        }
        return back()->with('success','Successfully changed role to user with ID ' . $userId  . '!');
    }

    public function editUrls($userId){
        $urlInfo = Url::where('user_id', $userId)->simplePaginate(10);
        $userInfo = User::where('id', $userId)->first();


        return view('/admin/editUrls', ['urls' => $urlInfo, 'user' => $userInfo]);
    }
    public function deleteUrl($urlId){
        $urlInfo = Url::where('id', $urlId)->first();
        $userId = $urlInfo->user_id;

        Url::where('id',$urlId)->delete();

        User::where('id', $userId)->update(array('active_urls' => User::where('id', $userId)->first()->active_urls - 1));
        User::where('id', $userId)->update(array('deleted_urls' => User::where('id', $userId)->first()->deleted_urls + 1));
        return back()->with('success','Email shortcut deleted successfully!');
    }

    public function appInfo(){
        $totalUsers = User::all()->count();
        $totalActiveUrls = User::all()->sum('active_urls');
        $totalUrls = User::all()->sum('total_urls');
        $deletedUrls = User::all()->sum('deleted_urls');
        $maxUrlsCreated = User::max('total_urls');
        $maxUrlsActive = User::max('active_urls');

        $userWithMostUrls = User::where('total_urls', $maxUrlsCreated)->first();
        $totalUser = new User();

        $totalUser->id = $userWithMostUrls->id;
        $totalUser->name = $userWithMostUrls->name;
        $totalUser->email = $userWithMostUrls->email;
        $totalUser->total_urls = $userWithMostUrls->total_urls;
        $totalUser->active_urls = $userWithMostUrls->active_urls;
        $totalUser->deleted_urls = $userWithMostUrls->deleted_urls;

        
        $userWithMostActiveUrls = User::where('active_urls', $maxUrlsActive)->first();
        $activeUser = new User();

        $activeUser->id = $userWithMostActiveUrls->id;
        $activeUser->name = $userWithMostActiveUrls->name;
        $activeUser->email = $userWithMostActiveUrls->email;
        $activeUser->total_urls = $userWithMostActiveUrls->total_urls;
        $activeUser->active_urls = $userWithMostActiveUrls->active_urls;
        $activeUser->deleted_urls = $userWithMostActiveUrls->deleted_urls;


        $data = ([
            'total_users' => $totalUsers,
            'total_urls' => $totalUrls,
            'total_active_urls' => $totalActiveUrls,
            'total_deleted_urls' => $deletedUrls,
            'user_with_most_urls' => $totalUser,
            'user_with_most_active_urls' => $activeUser
        ]);

        return view('/admin/appinfo')->with($data);
    }
}
