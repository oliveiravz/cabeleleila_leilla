<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Exception;


class LoginModel extends Model
{

    protected $table = "users";
    protected $fillable = [];

    public function authentication(array $data)
    {

        try {
            
            $response = [];
        
            $email    = trim($data["email"]);
            $password = trim($data["password"]);
    
            $user = DB::table($this->table)
                    ->where("{$this->table}.email", $email)
                    ->where("{$this->table}.password", hash("sha256", $password))
                    ->select("{$this->table}.user_id", "{$this->table}.name", "{$this->table}.email", "{$this->table}.master")
                    ->first();

            if(empty($user)) {
                
                $response = ["error" => true, "message" => "Usuário não encontrado!"];

            } else {

                $response = [
                    "errors" => false,
                    "user" => $user,
                    "redirect" => true
                ];
            }

            return $response;
        } catch (\Exception $e) {
            
            return $e->getMessage();
        }       
    }
}