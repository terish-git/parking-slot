<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Slot;

class FunctionHelper
{
    /**
     * Create AppointmentNumber
     *
     * @return response()
     */
    public static function generateAppointmentNumber($slotID)
    {
        $slot = Slot::find($slotID);
        $last = Booking::orderBy('id', 'DESC')->first();

        // Not completed

        $suffix = ($last) ? substr($last->appointment_number, -3) : 'AAA';
        return $slot->name . $suffix;
    }

    /**
     * Create unique referral code on Method
     *
     * @return response()
     */
    public static function formatTime($time)
    {
        return date('d-m-Y h:i:s', strtotime($time));
    }
}

