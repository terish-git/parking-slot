<?php

namespace App\Http\Controllers\API;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Slot;

class BookingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Creates new customer if phone number not exists in DB
        $customer = Customer::firstOrCreate(
            ['phone_number' => $request->phone_number],
            ['name' => $request->customer_name]
        );

        // Creates new vehicles details if vehicle number not exists in DB
        $vehicle = Vehicle::firstOrCreate(
            ['vehicle_number' => $request->vehicle_number],
            ['customer_id' => $customer->id]
        );

        //Find the available slot
        $slot = Slot::where('is_available', 1)->first();

        if(!$slot){
            return $this->sendError('No slots are available.', 422);
        }

        // Check any other vehicle booked for same time on same slots
        $start_time   = date('2023-02-01 10:30:00');
        $end_time     = date('2023-02-01 05:30:00');



        $otherBooking = Booking::where('slot_id', $slot->id)
                                ->whereDate('start_time', '>=', $start_time)
                                ->whereDate('end_time', '<=', $end_time)
                                ->get();

        if($otherBooking){
            return $this->sendError('Other vehicles are already booked in the same time.', 422);
        }

        dd('1');

        // Check the same vehicle booked for on any other slots on the same time
        $vehicleBookingExists = Booking::where('start_time', FunctionHelper::formatTime($request->start_time))->where('end_time', FunctionHelper::formatTime($request->end_time))->where('vehicle_id', $vehicle->vehicle_id)->get();
        if($vehicleBookingExists){
            return $this->sendError('Vehicle already booked in another slots '.$slot->id, 422);
        }

        $booking = Booking::create([
            'customer_id'     => $customer->id,
            'vehicle_id'     => $vehicle->id,
            'slot_id'     => $slot->id,
            'start_time'     => FunctionHelper::formatTime($request->start_time),
            'end_time'    => FunctionHelper::formatTime($request->end_time),
            'appointment_number'    => FunctionHelper::generateAppointmentNumber($slot->id),
        ]);

        return $this->sendResponse($booking, 'customer Retrieved Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
