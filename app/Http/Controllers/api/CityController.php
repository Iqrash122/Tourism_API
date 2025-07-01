<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function city_index()
    {
        $cities = City::all();

        if ($cities->isEmpty()) {
            return response()->json([
                'message' => 'No cities found'
            ], 404);
        }

        return response()->json([
            'message' => 'Cities retrieved successfully',
            'data' => $cities
        ], 200);
    }


    public function city_show($id){
        $cities = City::find($id);
        if(!$cities){
            return response()->json([
                'message'=>"No Cities Found"
            ],404);
        }

        return response()->json([
            'message'=> 'Cities retrieved successfully',
            'data'=>$cities
        ],200);
    }



}
