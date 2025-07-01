<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BookController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\TourismController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoiresController; // Added missing import
use App\Http\Controllers\admin\CitiesController;
use App\Http\Controllers\admin\CKEditorController;
use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware(['admin'])->group(function () {
    // Route::get('/dashboard', [AdminController::class, 'admin_index'])->name('dashboard');
    Route::get("/", [AdminController::class, 'admin_index'])->name("admin.admin");
});

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');


//admin Routes
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');          // show login form
Route::post('/login', [AuthController::class, 'login_submit'])->name('auth.authenticate');  // handle login post
Route::get("/register", [AuthController::class, 'register'])->name("auth.reg");
Route::get("/forget", [AuthController::class, 'forget'])->name("auth.forget");


//Tourism Routes
Route::get("/tourism", [TourismController::class, 'index'])->name("tourism.index");
Route::get("/create_tourism", [TourismController::class, 'create_tour'])->name("tourism.create");
Route::post("/store_tourism", [TourismController::class, 'store_tour'])->name("tourism.store");
Route::get("/edit_tourism/{id}", [TourismController::class, 'edit_tour'])->name("tourism.edit");
Route::post('/tourism/{id}', [TourismController::class, 'update_tour'])->name('tourism.update');
Route::delete('/tourism/{id}', [TourismController::class, 'destroy'])->name('tourism.destroy');
Route::get('/tourism/{id}', [TourismController::class, 'show_tour'])->name('tourism.show');

//Category Routes
Route::get("/category", [CategoiresController::class, 'category_index'])->name("category.index");
Route::get("/create_category", [CategoiresController::class, 'create_category'])->name("category.create");
Route::post("/store_category", [CategoiresController::class, 'store_category'])->name("category.store");
Route::get('/edit_category/{id}', [CategoiresController::class, 'edit_category'])->name('category.edit');
Route::put('/categories/{id}', [CategoiresController::class, 'update_category'])->name('category.update');
Route::delete('/categories/{id}', [CategoiresController::class, 'destroy'])->name('category.destroy');




//Cities Routes

Route::get("/cities", [CitiesController::class, 'cities_index'])->name("cities.index");
Route::get("/create_cities", [CitiesController::class, 'create_cities'])->name("cities.create");
Route::post("/store_cities", [CitiesController::class, 'store_cities'])->name("cities.store");
Route::get("/cities/{id}/edit", [CitiesController::class, 'edit_cities'])->name("cities.edit");
Route::put('/cities/{id}', [CitiesController::class, 'update_cities'])->name('cities.update');
Route::delete('/cities/{id}', [CitiesController::class, 'destroy'])->name('cities.destroy');


//Book Tour Routes
Route::get("/book_tour", [BookController::class, 'book_tour_index'])->name("book_tour.index");
Route::get("/create_book_tour", [BookController::class, 'create_book_tour'])->name("book_tour.create");
Route::post('/book_tour/store', [BookController::class, 'store_book_tour'])->name('book_tour.store');
Route::get("/edit_book_tour/{id}", [BookController::class, 'edit_book_tour'])->name("book_tour.edit");
Route::post('/book_tour/{id}', [BookController::class, 'update_book_tour'])->name('book_tour.update');
Route::delete('/book_tour/{id}', [BookController::class, 'destroy'])->name('book_tour.destroy');
Route::get('/book_tour/{id}', [BookController::class, 'show_book_tour'])->name('book_tour.show');


//Customer Routes
Route::get("/customer", [CustomerController::class, 'customer_index'])->name("customer.index");
Route::get("/create_customer", [CustomerController::class, 'create_customer'])->name("customer.create");
Route::post('/customers/store', [CustomerController::class, 'store_customer'])->name('customers.store');
Route::get("/edit_customer/{id}", [CustomerController::class, 'edit_customer'])->name("customer.edit");
Route::post('/customers/{id}', [CustomerController::class, 'update_customer'])->name('customers.update');
Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::post('/store_guest', [CustomerController::class, 'store_guest'])->name('guests.store');


//Users Routes
Route::get("/users", [UserController::class, 'users_index'])->name("users.index");
Route::get("/create_user", [UserController::class, 'create_user'])->name("users.create");
Route::post('/users/store', [UserController::class, 'store_user'])->name('users.store');
Route::get("/edit_user/{id}", [UserController::class, 'edit_user'])->name("users.edit");
Route::post('/users/{id}', [UserController::class, 'update_user'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


//Settings Routes
Route::get("/account", [SettingsController::class, 'Account'])->name("settings.account");
Route::get("/currency", [SettingsController::class, 'currency'])->name("settings.currency");


//proffile
Route::get("/profile", [AdminController::class, 'profile_index'])->name("profiles.index");
Route::post("/profile_pic_update", [AdminController::class, 'profilePic_update'])->name('profiles.profilePic_update');
Route::get("/edit_Profile", [AdminController::class, 'edit_Profile'])->name("profiles.edit");
// Forgot password form
Route::get('/forgot-password', [AdminController::class, 'forgot_password'])->name('profiles.forgot_password');

// Send password reset link
Route::post('/forgot-password', [AdminController::class, 'send_reset_link_email'])->name('password.email');

// Reset password form
Route::get('/reset-password/{token}', [AdminController::class, 'show_reset_form'])->name('password.reset');

// Handle password reset
Route::post('/reset-password', [AdminController::class, 'reset_password'])->name('password.update');


// ck editor 
Route::post('/ckeditor/upload', [CKEditorController::class, 'upload_image_cke'])->name('ckeditor.upload');



