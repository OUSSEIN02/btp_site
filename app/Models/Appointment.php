<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'service',
        'appointment_date',
        'appointment_time',
        'patient_type',
        'message',
        'status'
    ];
}
