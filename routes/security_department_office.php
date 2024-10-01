<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\WantedPeopleController;
use App\Http\Controllers\Api\AccommodationController;



Route::group([
    'middleware' => ['auth:security_department_office'],
    'prefix' => 's-d-o',
], function () {
    
    Route::get('/dashboard', function () {
        return view('security_department_office.dashboard');
    })->name('dashboard_sdo');

    //Hotels 
    Route::get('/all_hotels', [HotelController::class, 'index'])->name('security_department_office_all_hotels');
    Route::get('/hotel_info/{hotel_id}', [HotelController::class, 'show'])->name('security_department_office_hotel_info');

    //Roles
    Route::get('/all_roles', [RolesController::class, 'index'])->name('security_department_office_roles_all.index');
    Route::get('/create_roles', [RolesController::class, 'create'])->name('security_department_office_roles_create.create');
    Route::get('/edit_roles/{id?}', [RolesController::class, 'edit'])->name('security_department_office_roles_edit.edit');
    Route::post('/update_roles/{id}', [RolesController::class, 'update'])->name('security_department_office_roles_update.update');
    Route::post('/add_roles', [RolesController::class, 'store'])->name('security_department_office_roles_add.store');
    Route::delete('/roles/{id}', [RolesController::class, 'destroy'])->name('security_department_office_roles.destroy');

     //Employees
     Route::get('/all_employees', [EmployeeController::class, 'index'])->name('security_department_office_index_employees');
     Route::get('/create_employees', [EmployeeController::class, 'create'])->name('security_department_office_create_employees');
     Route::post('/store_employees', [EmployeeController::class, 'store'])->name('security_department_office_store_employees');
     Route::get('/edit_employees/{id}', [EmployeeController::class, 'edit'])->name('security_department_office_edit_employees');
     Route::get('/remove_employees/{id}', [EmployeeController::class, 'destroy'])->name('security_department_office_employees.destroy');
     Route::post('/update_employees/{id}', [EmployeeController::class, 'update'])->name('security_department_office_employees_update.update');

     //Trash 
    Route::get('/wanted_people/trash', [WantedPeopleController::class, 'trash'])->name('security_department_office_trash.index');
    Route::post('/wanted_people/trash/{id}', [WantedPeopleController::class, 'forceDelete'])->name('security_department_office_trash.forceDelete');
    Route::post('/wanted_people/trash', [WantedPeopleController::class, 'restore'])->name('security_department_office_trash.restore');
    
     
    //Wanted People
    Route::get('/all_wanted_people', [WantedPeopleController::class, 'index'])->name('security_department_office_wanted_people_all.index');
    Route::get('/show_wanted_people/{id}', [WantedPeopleController::class, 'show'])->name('security_department_office_wanted_people.show');
    Route::get('/wanted_people/create', [WantedPeopleController::class, 'create'])->name('security_department_office_wanted_people.create');
    Route::post('/wanted_people', [WantedPeopleController::class, 'store'])->name('security_department_office_wanted_people.store');
    Route::post('/wanted_people/{id}', [WantedPeopleController::class, 'destroy'])->name('security_department_office_wanted_people.destroy');

    //Guests
    Route::get('/all_guests', [GuestController::class, 'index'])->name('security_department_office_guests_all.index');
    Route::get('/show_guests/{id}', [GuestController::class, 'show'])->name('security_department_office_guests.show');
    Route::get('/today_guests', [GuestController::class, 'daily'])->name('security_department_office_guests_today.daily');

     //Accommodations
     Route::get('/all_accommodations', [AccommodationController::class, 'index'])->name('security_department_office_accommodations_all.index');
     Route::get('/today_accommodations', [AccommodationController::class, 'daily'])->name('security_department_office_accommodations_today.daily');
     Route::post('/show_accommodations', [AccommodationController::class, 'show'])->name('security_department_office_accommodations.show');
     // Route::get('/show_accommodations/{id}', [AccommodationController::class, 'show'])->name('tourist_police_accommodations.show');
    
     //reports
    //Accommodation
    Route::get('/reports/acom', [AccommodationController::class, 'report'])->name('security_department_office_report_accommodation');
    Route::post('/reports/acom', [AccommodationController::class, 'report'])->name('security_department_office_filter_accommodation');
    //Guests
    Route::get('/reports/gue', [GuestController::class, 'report'])->name('security_department_office_report_guest');
    Route::post('/reports/gue', [GuestController::class, 'report'])->name('security_department_office_filter_guest');
    //Wanted People
    Route::get('/reports/wantpeople', [WantedPeopleController::class, 'report'])->name('security_department_office_report_wantpeople');
    Route::post('/reports/wantpeople', [WantedPeopleController::class, 'report'])->name('security_department_office_filter_wantpeople');

    Route::get('/profile/change_account_information', [ProfileController::class, 'change_account_information'])->name('profile_sdo.change_account_information');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile_sdo.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile_sdo.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile_sdo.destroy');
});