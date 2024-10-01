<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\FirearmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\WantedPeopleController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\ResidentialPermitController;
use App\Http\Controllers\Messenger\MessagesController;
use App\Http\Controllers\Messenger\MessengerController;

Route::group([
    'middleware' => ['auth:tourist_police'],
    'prefix' => 't-p',
], function () {

    Route::get('/dashboard', function () {
        return view('tourist_police.dashboard');
    })->name('dashboard_tp');

    //Residential Permits
    Route::get('/show_residential_permit/{id}', [ResidentialPermitController::class, 'show'])->name('residential_permit.show');
    Route::get('/all_residential_permit', [ResidentialPermitController::class, 'index'])->name('residential_permit.index');
    Route::get('/residential_permit/create', [ResidentialPermitController::class, 'create'])->name('residential_permit.create');
    Route::post('/residential_permit', [ResidentialPermitController::class, 'store'])->name('residential_permit.store');
    // http://127.0.0.1:8000/t-p/residential_permit/store

    //Hotel
    Route::get('/hotel_info/{hotel_id}', [HotelController::class, 'show'])->name('tourist_police_hotel_info');
    Route::get('/all_hotels', [HotelController::class, 'index'])->name('tourist_police_all_hotels');
   
    //Accommodations
    Route::get('/all_accommodations', [AccommodationController::class, 'index'])->name('tourist_police_accommodations_all.index');
    Route::get('/today_accommodations', [AccommodationController::class, 'daily'])->name('tourist_police_accommodations_today.daily');
    Route::post('/show_accommodations', [AccommodationController::class, 'show'])->name('tourist_police_accommodations.show');
    // Route::get('/show_accommodations/{id}', [AccommodationController::class, 'show'])->name('tourist_police_accommodations.show');

    //Guests
    Route::get('/all_guests', [GuestController::class, 'index'])->name('tourist_police_guests_all.index');
    Route::get('/show_guests/{id}', [GuestController::class, 'show'])->name('tourist_police_guests.show');
    Route::get('/today_guests', [GuestController::class, 'daily'])->name('tourist_police_guests_today.daily');

    //Firearm
    Route::get('/all_firearm', [FirearmController::class, 'index'])->name('firearm_all.index');
    Route::get('/show_firearm/{id}', [FirearmController::class, 'show'])->name('tourist_police_firearm.show');
    Route::get('/today_firearm', [FirearmController::class, 'daily'])->name('firearm_today.daily');

    //Chats
     Route::get('/chats/{id?}', [MessengerController::class, 'index'])->name('tourist_police_chat.index');
     Route::post('messages', [MessagesController::class, 'store'])->name('tourist_police_chat.message');
     
     //Alert
    Route::get('/alert/{id?}', [AlertController::class, 'index'])
    ->name('tourist_police_alert.index');
    Route::post('alert', [AlertController::class, 'store'])->name('tourist_police_alert.message');

    //Trash 
    Route::get('/wanted_people/trash', [WantedPeopleController::class, 'trash'])->name('tourist_police_trash.index');
    Route::post('/wanted_people/trash/{id}', [WantedPeopleController::class, 'forceDelete'])->name('tourist_police_trash.forceDelete');
    Route::post('/wanted_people/trash', [WantedPeopleController::class, 'restore'])->name('tourist_police_trash.restore');
    
    //Potinital people
    Route::delete('/potential_people/delete', [WantedPeopleController::class, 'deletePotentialPeople'])->name('tourist_police_potential_people.delete');
    Route::post('/potential_people/sure', [WantedPeopleController::class, 'sureDetection'])->name('tourist_police_potential_people.sure');

    //reports
    //Accommodation
    Route::get('/reports/acom', [AccommodationController::class, 'report'])->name('tourist_police_report_accommodation');
    Route::post('/reports/acom', [AccommodationController::class, 'report'])->name('tourist_police_filter_accommodation');
    //Guests
    Route::get('/reports/gue', [GuestController::class, 'report'])->name('tourist_police_report_guest');
    Route::post('/reports/gue', [GuestController::class, 'report'])->name('tourist_police_filter_guest');
    //Firearms
    Route::get('/reports/fire', [FirearmController::class, 'report'])->name('report_fir');
    Route::post('/reports/fire', [FirearmController::class, 'report'])->name('filter_fir');
    //Wanted People
    Route::get('/reports/wantpeople', [WantedPeopleController::class, 'report'])->name('tourist_police_report_wantpeople');
    Route::post('/reports/wantpeople', [WantedPeopleController::class, 'report'])->name('tourist_police_filter_wantpeople');

    //Roles
    Route::get('/all_roles', [RolesController::class, 'index'])->name('tourist_police_roles_all.index');
    Route::get('/create_roles', [RolesController::class, 'create'])->name('tourist_police_roles_create.create');
    Route::get('/edit_roles/{id?}', [RolesController::class, 'edit'])->name('tourist_police_roles_edit.edit');
    Route::post('/update_roles/{id}', [RolesController::class, 'update'])->name('tourist_police_roles_update.update');
    Route::post('/add_roles', [RolesController::class, 'store'])->name('tourist_police_roles_add.store');
    Route::delete('/roles/{id}', [RolesController::class, 'destroy'])->name('tourist_police_roles.destroy');
    
    //Employees
    Route::get('/all_employees', [EmployeeController::class, 'index'])->name('tourist_police_index_employees');
    Route::get('/create_employees', [EmployeeController::class, 'create'])->name('tourist_police_create_employees');
    Route::post('/store_employees', [EmployeeController::class, 'store'])->name('tourist_police_store_employees');
    Route::get('/edit_employees/{id}', [EmployeeController::class, 'edit'])->name('tourist_police_edit_employees');
    Route::get('/remove_employees/{id}', [EmployeeController::class, 'destroy'])->name('tourist_police_employees.destroy');
    Route::post('/update_employees/{id}', [EmployeeController::class, 'update'])->name('tourist_police_employees_update.update');

    //Wanted People
    Route::get('/all_wanted_people', [WantedPeopleController::class, 'index'])->name('tourist_police_wanted_people_all.index');
    Route::get('/show_wanted_people/{id}', [WantedPeopleController::class, 'show'])->name('tourist_police_wanted_people.show');
    Route::get('/wanted_people/create', [WantedPeopleController::class, 'create'])->name('tourist_police_wanted_people.create');
    Route::post('/wanted_people', [WantedPeopleController::class, 'store'])->name('tourist_police_wanted_people.store');
    Route::post('/wanted_people/{id}', [WantedPeopleController::class, 'destroy'])->name('tourist_police_wanted_people.destroy');

    Route::get('/profile/change_account_information', [ProfileController::class, 'change_account_information'])->name('profile_tp.change_account_information');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile_tp.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile_tp.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile_tp.destroy');
});
