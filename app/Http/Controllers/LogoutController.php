<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout()
    {
        Session::flush();
        
        return redirect("/login");
    }
}