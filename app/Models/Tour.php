<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $guarded = [];

    public function activity_cities()
    {
        return $this->belongsTo(City::class, 'activity_cities');
    }

    public function activity_categories()
    {
        return $this->belongsTo(Category::class, 'activity_categories');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'booking_tour');
    }
}
