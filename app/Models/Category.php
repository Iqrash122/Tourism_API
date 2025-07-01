<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Tour; // ✅

class Category extends Model
{
    use HasFactory;

    protected $guarded = [ ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
