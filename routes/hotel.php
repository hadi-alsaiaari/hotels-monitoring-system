<?php

use App\Models\HotelActivityRule;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MoreOneHotelController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\HotelRequestsController;
use App\Http\Controllers\HotelActivityRuleController;
use App\Http\Controllers\HotelReceptionistController;
use App\Http\Controllers\Messenger\MessagesController;
use App\Http\Controllers\Messenger\MessengerController;
use App\Http\Controllers\HotelExecutiveManagerController;

Route::group([
    'middleware' => ['auth.type', 'auth:web', 'auth.block'],
    'prefix' => 'hotel',
], function () {
    
    Route::get('/dashboard', function () {
        return view('hotels.dashboard');
    })->name('dashboard_h');

    //Hotels changeHotel
    Route::post('/create_another_hotel', [MoreOneHotelController::class, 'createAnotherHotel'])->name('store_another_hotel');
    Route::get('/create_another_hotel', [MoreOneHotelController::class, 'index'])->name('create_another_hotel');
    Route::get('/hotel_details', [HotelController::class, 'hotel_details'])->name('hotel_details');

    //Hotel Activity rules 
    Route::get('/activity_rules', [HotelActivityRuleController::class, 'index_hotel'])->name('hotel_activity_rules');

    //Executive Manager
    Route::get('/all_executive_managers', [HotelExecutiveManagerController::class, 'index'])->name('index_EM');
    Route::get('/create_executive_managers', [HotelExecutiveManagerController::class, 'create'])->name('create_EM');
    Route::post('/executive_managers', [HotelExecutiveManagerController::class, 'store'])->name('store_EM');
    
    //Receptionists
    Route::get('/all_hotel_receptionists', [HotelReceptionistController::class, 'index'])->name('index_R');
    Route::get('/create_hotel_receptionists', [HotelReceptionistController::class, 'create'])->name('create_R');
    Route::post('/hotel_receptionists', [HotelReceptionistController::class, 'store'])->name('store_R');
    Route::delete('/hotel_receptionist/{id}', [HotelReceptionistController::class, 'destroy'])->name('delete_R');

    //Caht

    // Route::get('/chat/{id}', [MessengerController::class,'index'])->name('chat.index');
    Route::get('/chats/{id?}', [MessengerController::class, 'index'])->name('hotels_chat.index');
    Route::post('message', [MessagesController::class, 'store'])->name('hotels_chat.message');

    //Alert
    Route::get('/alert/{id?}', [AlertController::class, 'index'])
        ->name('hotels_alert.index');
    Route::post('alert', [AlertController::class, 'store'])->name('hotels_alert.message');
    
    //Accommodations
    Route::get('/all_accommodations', [AccommodationController::class, 'indexOnHotel'])->name('hotels_accommodations_all.index');
    Route::get('/today_accommodations', [AccommodationController::class, 'dailyOnHotel'])->name('hotels_accommodations_today.daily');
    Route::post('/show_accommodations', [AccommodationController::class, 'showOnHotel'])->name('hotels_accommodations.show');

    //Profile 
    Route::get('/profile_phone_number/{id}', [ProfileController::class, 'destroyPhoneNumber'])->name('destroy_phone_number');
    Route::post('/profile_phone_number', [ProfileController::class, 'addPhoneNumber'])->name('add_phone_number');
    Route::get('/profile/change_account_information', [ProfileController::class, 'change_account_information'])->name('profile_h.change_account_information');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile_h.edit');
    Route::post('/profile', [ProfileController::class, 'edit_profile'])->name('profile_h.edit_nav');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile_h.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile_h.destroy');
});

Route::group([
    'middleware' => ['auth:web'],
    'prefix' => 'hotel',
], function () {
   
Route::get('/block/{hotel}', function () {
    return view('hotels.pages.block');
})->name('block');
   
Route::get('/instanc/{hotel}', function () {
    return view('hotels.pages.instanc');
})->name('instanc');
    Route::post('/change_hotel/{hotel_id}', [MoreOneHotelController::class, 'changeHotel'])->name('change_hotel');
    Route::post('/uploadFile/{hotel_id}', [HotelRequestsController::class, 'licenseIssuanceFee'])->name('uploadFile');
    Route::post('/add_rooms/{hotel_id}', [RoomController::class, 'store'])->name('add_rooms');
    Route::get('/finshe_add_rooms/{hotel_id}', [HotelRequestsController::class, 'finshAddedRooms'])->name('finsh_add_rooms');
    Route::delete('/delete_rooms/{hotel_id}', [RoomController::class, 'destroy'])->name('delete_rooms');

});


