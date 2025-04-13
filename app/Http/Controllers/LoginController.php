<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


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

            $data = $request->only('email', 'password');

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
                
                if($user) {

                    Auth::login($user);

                    $request->session()->regenerate();

                    $response = [
                        'error' => false,
                        'message' => 'Login realizado com sucesso',
                        'user' => Auth::user(),
                        'redirect' => true
                    ];
                    
                } else {
                    $response = [
                        'error' => true,
                        'message' => 'Usuário e/ou senha inválidos',
                        'user' => null,
                        'redirect' => false
                    ];
                }
            }

            return response()->json($response);
            
        
        } catch (\Exception $e) {

            return response()->json(['error' => true, 'message' => $e->getMessage()]);

        }
    }
}