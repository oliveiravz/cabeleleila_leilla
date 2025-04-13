<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Exception;

class ServiceModel extends Model
{

    protected $table = "service";
    protected $fillable = [];

    public function getAll()
    {
        $services = DB::table($this->table)
        ->get()
        ->map(function ($item) {
            return (array) $item;
        })->toArray();
    

        if(!empty($services)) {

            return $services;
        }
    }
}