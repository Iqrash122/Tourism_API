<?php

use App\Http\Controllers\api\BookingController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CityController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\PasswordResetController;
use App\Http\Controllers\api\SupportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ToursController;
use Illuminate\Support\Facades\DB;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::fallback(function () {
    return response()->json(['message' => 'page not found', 'status' => false], 404);
});

//category api routes

Route::get('/category', [CategoryController::class, 'category_index']);
Route::get('/category/{id}', [CategoryController::class, 'show_category']);


//city api routes
Route::get('/cities', [CityController::class, 'city_index']);
Route::get('/cities/{id}', [CityController::class, 'city_show']);




//tours api route
Route::get('/tours', [ToursController::class, 'tours_index']);
Route::get('/tours/{id}', [ToursController::class, 'show_tours']);
Route::get('/tours_by_category/{id}', [ToursController::class, 'toursByCategory']);
Route::get('/tours_by_city/{id}', [ToursController::class, 'toursByCity']);
Route::get('/top_rated_tours', [ToursController::class, 'topRatedTours']);
Route::get('/top_rated_tours_by_category/{id}', [ToursController::class, 'topRatedToursByCat']);
Route::get('/promotion_tours', [ToursController::class, 'promotion_tours']);
Route::get('/feature_offers', [ToursController::class, 'feature_offers']);
Route::get('/search-tours/{searchTerm}', [ToursController::class, 'searchTours']);





//support queries api route
Route::get('/support-queries', [SupportController::class, 'support_index']);
Route::post('/support-queries_store', [SupportController::class, 'store']);
Route::get('/support-queries/{id}', [SupportController::class, 'show']);
Route::put('/support_queries_update/{id}', [SupportController::class, 'update_support']);




//customer create or login api
// Add this at the top of routes/api.php
Route::prefix('customer')->group(function () {
    Route::post('/register', [CustomerController::class, 'customer_register']);
    Route::post('/login', [CustomerController::class, 'customer_login']);
    Route::post('/forgot-password', [CustomerController::class, 'forgotPassword']);
    Route::post('/high', [CustomerController::class, 'some_high_action']);
});
Route::get('/change_password', [CustomerController::class, 'changePassword']);
Route::post('/customers_update/{id}', [CustomerController::class, 'update_customer']);
Route::get('/Customer_profile/{id}', [CustomerController::class, 'customer_profile']);


//booking api route
Route::get('/booking', [BookingController::class, 'booking_index']);
Route::post('/Post_Booking_form', [BookingController::class, 'post_booking']);
Route::put('/update_booking/{id}', [BookingController::class, 'update_book_tour']);
// /forgot password /
Route::post('/forgot-password', [PasswordResetController::class, 'forgotPassword']);

// update password api
// routes/api.php
Route::post('/update-password', [PasswordResetController::class, 'updatePassword']);

Route::get('/notifications/{customer_id}', function ($customer_id) {
    $notifications = DB::table('notifications')
        ->where('notifiable_id', $customer_id)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json(['notifications' => $notifications]);
});
