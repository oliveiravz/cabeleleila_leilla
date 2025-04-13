<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\LoginModel;
use Exception;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {   
        try {

            $data       = $request->all();
            $loginModel = new LoginModel();
            $response   = [];

            if(empty($data['email'])) {
                
                $response = ["error" => true, "message" => "Informe seu e-mail"];
            }

            if(empty($data['password'])) {
                
                $response = ["error" => true, "message" => "Informe a senha"];
            }

            if(!isset($response["error"])) {

                $user = $loginModel->authentication($data);
                
                if(count($user) > 0) {

                    Session::put('user', $user);
                    $response = $user;
                }
            }

            return response()->json($response);
            
        
        } catch (\Exception $e) {

            return response()->json(['error' => true, 'message' => $e->getMessage()]);

        }
    }
}