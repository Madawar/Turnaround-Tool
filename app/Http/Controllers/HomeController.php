<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->flash('message', 'You have been logged in');
       return redirect()->action('FlightController@index');
    }

    public function signout()
    {
        Auth::logout();
        return redirect()->action('FlightController@index');
    }


    public function profile()
    {
        $profile = User::find(Auth::user()->id);
        $profile->password = '';
        return view('profile.profile')->with(compact('profile'));
    }

    public function saveProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $request->session()->flash('message', 'Your Profile Changes have been done');
        return redirect()->action('FlightController@index');
    }

}
