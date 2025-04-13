<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BookingModel;

class DashboardController extends Controller
{

    public function index()
    {
        return view('dashboard');
    }

    public function getBookingsByPeriod(Request $request)
    {  

        $bookingModel = new BookingModel();

        $data = $request->all();

        $bookings = $bookingModel->getBookingsByPeriod();

        return response()->json($bookings);
    }
}