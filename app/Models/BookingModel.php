<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Exception;

class BookingModel extends Model
{

    protected $table = "booking";
    
    public $timestamps = false;
    protected $fillable = [
        "date",
        "user_id",
        "service_id"
    ];

    public function getBookingById(int $idBooking)
    {
        $bookingData = DB::table($this->table)
                        ->join("users", "users.user_id", "=",  "{$this->table}.user_id")
                        ->join("service", "service.service_id", "=", "{$this->table}.service_id")
                        ->where("{$this->table}.booking_id", $idBooking)
                        ->select(
                            "users.user_id",  
                            "service.service_id", 
                            "service.price",
                            "booking.date",
                            "booking.booking_id"
                        )->get();
        
        $data = $bookingData->map(function($item) {
            $dateTime = explode(' ', $item->date);
            
            return [
                'user_id'      => $item->user_id,
                'service_id'   => $item->service_id,
                'price'        => $item->price,
                'booking_id'   => $item->booking_id,
                'date'         => $dateTime[0] ?? null, // yyyy-mm-dd
                'time'         => $dateTime[1] ?? null  // hh:mm:ss
            ];

        })->toArray();

        
        return $data ?? [];
    }

    public function getBookingByCostumer(int $idCostumer)
    {
        
        $bookings = DB::table($this->table)
                    ->join("users", "users.user_id", "=",  "{$this->table}.user_id")
                    ->join("service", "service.service_id", "=", "{$this->table}.service_id")
                    ->where("{$this->table}.user_id", $idCostumer)
                    ->where("{$this->table}.deleted", "=", 0)
                    ->select(
                        "users.name", 
                        "users.email", 
                        "service.name", 
                        "service.price",
                        "booking.date",
                        "booking.booking_id"
                    )->orderBy("booking.date", "desc")
                    ->get()
                    ->map(function ($item) {
                        return (array) $item;
                    })->toArray();

        $data = array_map(function($item) {
            
            $item["date"] = date('d/m/Y H:i', strtotime($item['date']));
            $item['price'] = 'R$ ' . number_format($item['price'], 2, ',', '.');

            return $item;

        }, $bookings);
        
        return $data ?? [];
    }

    public function validateBookingDate(int $idCostumer, $date)
    {

        $bookingDate = DB::table($this->table)
                    ->where("{$this->table}.user_id", $idCostumer)
                    ->whereDate("{$this->table}.date", $date)
                    ->select(
                        "{$this->table}.service_id"
                    )->get();
    }

    public function _save($data)
    {
        try {
            $bookingModel = new self(); 
    
            $bookingModel->service_id = $data["service"];
            $bookingModel->user_id    = $data["user_id"]; 
            $bookingModel->date       = "{$data["date"]} {$data["time"]}";
    
            $bookingModel->save();
    
            return $bookingModel; 
        } catch (Exception $e) {
            
            throw new Exception("Erro ao salvar a reserva: " . $e->getMessage());
        }
    
    }

    public function _delete(int $idBooking)
    {
        
        $bookingDelete = DB::table($this->table)
                        ->where('booking_id', $idBooking)->update([
                            'deleted' => 1
                        ]);

        if($bookingDelete) {
            return true;
        }

        return false;
    }
}