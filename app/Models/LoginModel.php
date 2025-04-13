<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB,
    Illuminate\Support\Facades\Session,
    Illuminate\Support\Facades\Hash;

use App\Models\UsersModel;

use Exception;


class LoginModel extends Model
{

    public function authentication(array $data)
    {
        try {

            $email = trim($data["email"]);
            $password = trim($data["password"]);

            $user = UsersModel::where('email', $email)->where("deleted", "!=", 1)->first();

            if (!$user || !Hash::check($password, $user->password)) {
                return null; 
            }

            return $user; 
            
        } catch (\Exception $e) {
            return null;
        }
    }
}