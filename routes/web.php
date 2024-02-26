<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth'])->group(function () {
    // Your other authenticated routes go here

    Route::get('userdashboard', [DashboardController::class, 'index']);
    Route::get('/logout', [DashboardController::class, 'logout']);
    Route::get('logout', [DashboardController::class, 'logout']);
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/index', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::post('/blogs/update/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::post('blogs/like', [BlogController::class, 'like'])->name('blogs.like');
    Route::post('/blogs/comment', [BlogController::class, 'comment'])->name('blogs.comment');
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('/plans/show/{plan}', [PlanController::class, 'show'])->name('plans.show');
    Route::post('/plans/subs', [PlanController::class, 'subs'])->name('plans.subs');
    
    

   
    


});


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('welcome');
});



Route::get('/userlogin', [LoginController::class, 'showLoginForm'])->name('userlogin');
Route::post('/userlogin', [LoginController::class, 'userlogin']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');






Route::get('/login/{provider}', [SocialController::class, 'redirectToProvider']);
Route::get('/login/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
Route::get('/testDB', [SocialController::class, 'testDB']);


