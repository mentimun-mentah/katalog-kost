<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/verify/{token}/{id}', [App\Http\Controllers\Auth\RegisterController::class,'verify']);
Route::post('/register/kost', [App\Http\Controllers\Auth\RegisterController::class,'registerKost']);

Route::get('/detail-kos/{slug}/{user_id}', [App\Http\Controllers\HomeController::class,'detailKost'])->name('detailkost');
Route::get('/list-kos', [App\Http\Controllers\HomeController::class,'listKos'])->name('listkos');
Route::get('/list-kos-map', [App\Http\Controllers\HomeController::class,'listKosMap']);
Route::get('/all-kosts', [App\Http\Controllers\HomeController::class,'allKosts']);

Route::prefix('rating')->group(function (){
  Route::middleware(['auth'])->group(function () {
    Route::post('/create-rating', [App\Http\Controllers\RatingController::class, 'createRating']);
  });
    Route::get('/get-total-rating/{kost_id}', [App\Http\Controllers\RatingController::class,'getTotalRating']);
    Route::get('/get-rating/{kost_id}', [App\Http\Controllers\RatingController::class,'getRating']);
});

/* ADMIN ROUTE VIEW */
Route::prefix('admin')->group(function (){
  Route::middleware(['admin'])->group(function () {
    Route::get('/owner-confirmation', [App\Http\Controllers\AdminController::class, 'ownerConfirmation'])->name('admin.owner_confirmation');
    Route::get('/manage-owner', [App\Http\Controllers\AdminController::class, 'manageOwner'])->name('admin.manage_owner');
    Route::get('/all-users', [App\Http\Controllers\AdminController::class,'allUsers']);
    Route::put('/accept-user/{id}', [App\Http\Controllers\AdminController::class,'acceptUser'])->where('id','[0-9]+');
    Route::delete('/reject-user/{id}', [App\Http\Controllers\AdminController::class,'rejectUser'])->where('id','[0-9]+');
    Route::delete('/delete-user/{id}', [App\Http\Controllers\AdminController::class,'deleteUser'])->where('id','[0-9]+');
  });
});

/* ACCOUNT ROUTE */
Route::prefix('account')->group(function (){
  Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\AccountController::class,'profile'])->name('account.profile');
    Route::put('/update-profile', [App\Http\Controllers\AccountController::class,'updateProfile']);
    Route::post('/update-avatar', [App\Http\Controllers\AccountController::class,'updateAvatar']); 
    Route::put('/update-password', [App\Http\Controllers\AccountController::class,'updatePassword']);
    Route::get('/password', [App\Http\Controllers\AccountController::class,'password'])->name('account.password');
  });
});

Route::prefix('kosts')->group(function (){
  Route::middleware(['auth'])->group(function () {
    Route::get('/add-kost', [App\Http\Controllers\KostController::class,'add_kost'])->name('kost.add_kost');
    Route::post('/create-kost', [App\Http\Controllers\KostController::class,'createKost']);
    Route::get('/my-kost', [App\Http\Controllers\KostController::class,'my_kost'])->name('kost.my_kost');
    Route::get('/get-my-kost', [App\Http\Controllers\KostController::class,'getMyKost']);
    Route::delete('/delete-kost/{id}', [App\Http\Controllers\KostController::class,'deleteKost']);
    Route::get('/change-kost/{id}', [App\Http\Controllers\KostController::class,'changeMyKost'])->where('id','[0-9]+');
    Route::post('/update-kost', [App\Http\Controllers\KostController::class,'updateKost']);
  });
  Route::get('/get-total-kost', [App\Http\Controllers\KostController::class,'getTotalKost']);
});

Route::middleware(['auth'])->group(function () {
  Route::get('/user', function () {
      return Auth::user();
  });
});
