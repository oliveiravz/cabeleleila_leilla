<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index()
    {

        $user = Session::get('user');
        
        return view('home', compact('user'));
    }
}