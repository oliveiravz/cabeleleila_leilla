<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Models\ServiceModel,
    App\Models\BookingModel;

class BookingController extends Controller
{
    
    protected $bookingModel;
    protected $userId;


    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->services = new ServiceModel();
        $this->userId = Session::get('user')['user']->user_id;
    }

    public function index()
    {
        $services = $this->services->getAll();

        return view('booking', compact('services'));
    }

    public function getBookingByCostumer()
    {

        $bookings = $this->bookingModel->getBookingByCostumer($this->userId);

        return view('my-bookings', compact('bookings'));
    }

    public function getBookingById(Request $request, int $idCostumer)
    {

        $bookingData = $this->bookingModel->getBookingById($idCostumer);

        $services = $this->services->getAll();
        
        return view('booking', compact('services'), compact('bookingData'));
    }

    public function registerBooking(Request $request)
    {   
        
        $dataAll = $request->all();
        $errors  = [];

        foreach ($dataAll['booking'] as $key => $data) {
            $service      = trim($data["service"]);
            $date         = $data["date"];
            $time         = $data["time"];

            $data['user_id'] = $this->userId;
    
            if(empty($service)) {
                $errors[$key]["service"] = "Selecione ao menos um serviço";
            }
    
            if(empty($date)) {
                $errors[$key]["date"] = "Informe a data";
            }
    
            if(empty($time)) {
                $errors[$key]["time"] = "Informe a hora";
            }

            $bookingDate = $this->bookingModel->validateBookingDate($this->userId, $date);

            if(!$this->bookingModel->_save($data)) {
                    
                $errors[] = "Ocorreu um erro ao realizar agendamento.";
            }
        }

        if(count($errors) > 0) {

            $response = [
                "errors" => true,
                "messages" => $errors 
            ];

            return response()->json($response);
        }

        $response = [
            "errors" => false,
            "message" => "Agendamento realizado com sucesso"
        ];

        return response()->json($response);
    }

    public function deleteBooking(Request $request, int $idCostumer)
    {
        $bookingData = $this->bookingModel->_delete($idCostumer);

        if($bookingData) {
            $response = [
                "errors" => false,
                "message" => "Agendamento excluido com sucesso"
            ];

            return response()->json($response);
        }

        $response = [
            "errors" => true,
            "messages" => 'Erro ao excluir agendamento' 
        ];

        return response()->json($response);
    }
}