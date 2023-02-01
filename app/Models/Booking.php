<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'vehicle_id', 'slot_id', 'start_time', 'end_time', 'appointment_number'];

    protected $dates = ['start_time', 'end_time'];
}
