<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    // This tells Laravel it is okay to insert data into these specific columns
   protected $fillable = [
    'customer_name', 
    'email', 
    'phone', 
    'service_type', 
    'appointment_time', 
    'status', 
    'message'
];
}