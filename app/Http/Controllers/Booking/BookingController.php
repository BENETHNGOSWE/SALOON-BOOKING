<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(){
        $this->data['bookings'] = Booking::all();
        return view('Dashboards.admin.dashboard', $this->data);
    }
    
    private function booking_number_generator(){
        do {
            $prefix = 'BK-';
            $numbers = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
            $letters = chr(rand(65, 90)) . chr(rand(97, 122));
            $suffix = str_pad(rand(0, 92), 2, '0', STR_PAD_LEFT);

            $booking_number = $prefix . $numbers . $letters . $suffix;
        } while (Booking::where('booking_number', $booking_number)->exists());

        return $booking_number;
    }

    public function validate_booking(Request $request) {
        return $request->validate([
            'booking_name' => 'required',
            'booking_phonenumber' => 'required',
            'booking_service' => 'required|in:kunyoa,scrub,nyote',
            'booking_date' => 'required',
            'booking_time' => 'required',
            'booking_number' => 'nullable',
        ]);
    }


    public function store(Request $request) {
        $validated = $this->validate_booking($request);
        try {
            DB::beginTransaction();
            $booking = new Booking();
            $validated['booking_number'] = $this->booking_number_generator();
            $booking -> fill($validated);
            $booking->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error($th->getMessage().' '. $th->getTraceAsString());
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
        return redirect()->back()->with('message', 'Booking Created Successfully');
    }


    public function accept_booking($id) {
        $booking = Booking::find($id);
        $booking->booking_status = 'accepted';
        $booking->save();
        return redirect()->back()->with('message', 'Booking Status Approved');
    }

    public function reject_booking($id) {
        $booking = Booking::find($id);
        $booking->booking_status = 'rejected';
        $booking->save();
        return redirect()->back()->with('message', 'Booking Status Not Approved');
    }
    


}
