<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\UsersModel;

class UsersController extends Controller
{

    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $user = Auth::user();

        return view('users', compact('user'));
    }

    public function registerUser(Request $request)
    {
        $errors = [];
        $data = $request->all();

        if(empty($data["name"])) {
            $errors['name'] = "Insira o nome";
        }

        if(empty($data["email"])) {
            $errors['email'] = "Insira o E-mail";
        }

        if(empty($data["password"])) {
            $errors['password'] = "Insira a senha";
        }

        if(count($errors) == 0) {

            $usersModel = new UsersModel();

            if(!$usersModel->_save($data)) {
                
                $errors[] = "Ocorreu um erro ao criar conta.";
                
            }
        }

        if(count($errors) > 0) {

            $response = [
                "errors" => true,
                "messages" => $errors 
            ];

            // dd(json_encode($response));

            return response()->json($response);
        }

        $response = [
            "errors" => false,
            "message" => "Conta criada com sucesso."
        ];

        return response()->json($response);
    }

    public function deleteUser(int $idUser) 
    {
        $userData = $this->usersModel->_delete($idUser);

        if($userData) {
            $response = [
                "errors" => false,
                "message" => "Usuário excluido com sucesso"
            ];

            return response()->json($response);
        }

        $response = [
            "errors" => true,
            "messages" => 'Erro ao excluir usuário' 
        ];


        return response()->json($response);

    }

    public function getAll()
    {

        $users =  $this->usersModel->getAll();

        return view('users-list', compact('users'));
    }
}