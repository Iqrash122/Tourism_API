<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];


    // app/Models/Booking.php

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'booking_customer');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'booking_tour'); // assuming 'booking_tour' is the foreign 
    }
}
