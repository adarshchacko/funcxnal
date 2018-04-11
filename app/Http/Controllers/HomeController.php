<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;


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
    public function index()
    {
        if(Auth::check()){
            $old_file = storage_path('app/').Auth::user()->image;
            $contents = file_get_contents($old_file);
            
            Storage::disk('uploads')->put(Auth::user()->image, $contents);
        }
        return view('home');
    }
}
