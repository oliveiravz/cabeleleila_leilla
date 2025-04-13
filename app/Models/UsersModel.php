<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB,
    Illuminate\Support\Facades\Hash;


class UsersModel extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['name', 'email', 'password'];
    public $timestamps = false;

    public function getAll()
    {
        $users = DB::table($this->table)
                        ->where("{$this->table}.deleted", "!=", 1)
                        ->select(
                            "users.user_id",  
                            "users.name", 
                            "users.email",
                            "users.master",
                        )
                        ->get()
                        ->map(function ($item) {
                            return (array) $item;
                        })->toArray();
        
        $data = array_map(function($item) {

            $item = (array) $item;

            return $item;

        }, $users);

        return $data ?? [];
    }
    
    public function getUserById(int $idUser)
    {
        $userData = DB::table($this->table)
                        ->where("{$this->table}.user_id", $idUser)
                        ->select(
                            "users.user_id",  
                            "users.name", 
                            "users.email",
                            "users.master",
                        )->first();

        return $userData ?? [];
    }

    public function _save($data)
    {
        try {
            $usersModel = new self(); 

            if(isset($data["user_id"])) {

                $usersModel = self::find($data["user_id"]);
            }

            $usersModel->name  = $data["name"];
            $usersModel->email = $data["email"]; 
            $usersModel->password = Hash::make($data['password']);
    
            $usersModel->save();
    
            return $usersModel; 
        } catch (Exception $e) {
            
            throw new Exception("Erro ao salvar a reserva: " . $e->getMessage());
        }
    
    }

    public function _delete(int $idUser)
    {
        $usersModel = new self(); 

        $user = $usersModel::find($idUser);

        if($user) {

            $userDelete = DB::table($this->table)
                        ->where('user_id', $idUser)->update([
                            'deleted' => 1
                        ]);

            if($userDelete) {
                return true;
            }

        }

        return false;
    }
}
