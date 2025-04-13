<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Exception;

class BookingModel extends Model
{
    public $timestamps = false;
    protected $table = "booking";
    protected $primaryKey = 'booking_id';
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

    public function getBookingsByPeriod()
    {
        $bookings = DB::select("   
            WITH RECURSIVE weekday AS (
                SELECT CURDATE() - INTERVAL 6 DAY AS day
                UNION ALL
                SELECT day + INTERVAL 1 DAY
                FROM weekday
                WHERE day + INTERVAL 1 DAY <= CURDATE()
            )

            SELECT 
                ds.day,
                COUNT(b.booking_id) AS bookings_total,
                IFNULL(SUM(s.price), 0) AS sum_price
            FROM weekday ds
            LEFT JOIN booking b ON DATE(b.date) = ds.day
            LEFT JOIN service s ON s.service_id = b.service_id
            GROUP BY ds.day
            ORDER BY ds.day
        ");

        $data = array_map(function($item) {

            $item = (array) $item;

            $item["day"] = date('d/m/Y', strtotime($item['day']));
            $item['sum_price'] = 'R$ ' . number_format($item['sum_price'], 2, ',', '.');

            return $item;

        }, $bookings);
        
        return $data ?? [];
        
    }

    public function validateBookingDate(int $bookingId)
    {
        
        $timezone = new \DateTimeZone('America/Sao_Paulo');

        $newDate = new \DateTime(date('Y-m-d'), $timezone);

        $bookingDate = DB::table($this->table)
                    ->where("{$this->table}.booking_id", $bookingId)
                    ->select(
                        "{$this->table}.date"
                    )->first();

        if(count((array) $bookingDate) > 0) {

            $originalDate = new \DateTime($bookingDate->date, $timezone);
            $interval = $originalDate->sub(new \DateInterval('P2D'));

            if($newDate >= $interval) {

                return false;
            }
        }

        return true;
    }

    public function _save($data)
    {
        try {
            $bookingModel = new self(); 

            if(isset($data["booking_id"])) {

                $bookingModel = self::find($data["booking_id"]);
            }
    
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