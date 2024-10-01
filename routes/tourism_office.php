<?php

use App\Models\Room;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\FirearmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BlockHotelController;
use App\Http\Controllers\MonthlyTaxController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\HotelRequestsController;
use App\Http\Controllers\TaxPercentageController;
use App\Http\Controllers\HotelActivityRuleController;
use App\Http\Controllers\Messenger\MessagesController;
use App\Http\Controllers\Messenger\MessengerController;
use App\Http\Controllers\AccommodationController as ControllersAccommodationController;

Route::group([
    'middleware' => ['auth:tourism_office'],
    'prefix' => 't-o',
], function () {
    
    Route::get('/dashboard', function () {
        return view('tourism_office.dashboard');
    })->name('dashboard_to');

    Route::get('/hotel_request', function () {
        return view('tourism_office.hotel_request');
    });
    
    //Route to Rooms
    
    //Hotels 
    Route::get('/all_hotels', [HotelController::class, 'index'])->name('tourism_office_all_hotels');
    Route::get('/hotel_info/{hotel_id}', [HotelController::class, 'show'])->name('tourism_office_hotel_info');
    //Hotels blocked
    Route::get('/hotels_block', [BlockHotelController::class, 'index'])->name('hotel_block');
    Route::post('/hotels_onblock', [BlockHotelController::class, 'on_block'])->name('on_block');
    Route::get('/hotels_upblock/{id}', [BlockHotelController::class, 'up_block'])->name('up_block');
    
    //Tax
    Route::get('/all_reports', [TaxPercentageController::class, 'index'])->name('all_reports');
    Route::get('/all_percentage', [TaxPercentageController::class, 'index'])->name('all_percentage');
    Route::get('/add_percentage/{class}', [TaxPercentageController::class, 'create'])->name('add_percentage');
    Route::post('/store_percentage/{class}', [TaxPercentageController::class, 'store'])->name('store_percentage');

    //Roles
    Route::get('/all_roles', [RolesController::class, 'index'])->name('tourism_office_roles_all.index');
    Route::get('/create_roles', [RolesController::class, 'create'])->name('tourism_office_roles_create.create');
    Route::get('/edit_roles/{id?}', [RolesController::class, 'edit'])->name('tourism_office_roles_edit.edit');
    Route::post('/update_roles/{id}', [RolesController::class, 'update'])->name('tourism_office_roles_update.update');
    Route::post('/add_roles', [RolesController::class, 'store'])->name('tourism_office_roles_add.store');
    Route::delete('/roles/{id}', [RolesController::class, 'destroy'])->name('tourism_office_roles.destroy');

    //Employees
    Route::get('/all_employees', [EmployeeController::class, 'index'])->name('tourism_office_index_employees');
    Route::get('/create_employees', [EmployeeController::class, 'create'])->name('tourism_office_create_employees');
    Route::post('/store_employees', [EmployeeController::class, 'store'])->name('tourism_office_store_employees');
    Route::get('/edit_employees/{id}', [EmployeeController::class, 'edit'])->name('tourism_office_edit_employees');
    Route::get('/remove_employees/{id}', [EmployeeController::class, 'destroy'])->name('tourism_office_employees.destroy');
    Route::post('/update_employees/{id}', [EmployeeController::class, 'update'])->name('tourism_office_employees_update.update');

    //Route to Activity Rules
    Route::get('/all_activity_rules', [HotelActivityRuleController::class, 'index'])->name('show.activity_rules');
    Route::get('/add_create_activity_rules', [HotelActivityRuleController::class, 'create'])->name('show.creat_rules');
    Route::post('/all_activity_rules', [HotelActivityRuleController::class, 'store'])->name('add.activity_rules');
    Route::delete('/delete_activity_rule/{rule_id}', [HotelActivityRuleController::class, 'destroy'])->name('delete.activity_rules');
    Route::get('/edit_activity_rule/{rule_id}', [HotelActivityRuleController::class, 'edit'])->name('edit.activity_rules');
    Route::put('/update_activity_rule/{rule_id}', [HotelActivityRuleController::class, 'update'])->name('update.activity_rules');
    
    //reports 
    //Accommodation
    Route::get('/reports/acom', [AccommodationController::class, 'report'])->name('tourism_office_report_accommodation');
    Route::post('/reports/acom', [AccommodationController::class, 'report'])->name('tourism_office_filter_accommodation');
    //Guests
    Route::get('/reports/gue', [GuestController::class, 'report'])->name('tourism_office_report_guest');
    Route::post('/reports/gue', [GuestController::class, 'report'])->name('tourism_office_filter_guest');
    //Tax
    Route::get('/tax/reports', [MonthlyTaxController::class, 'index'])->name('all_t');


    //Chats
    Route::get('/chats/{id?}', [MessengerController::class, 'index'])
        ->name('tourism_office_chat.index');
    Route::post('message', [MessagesController::class, 'store'])->name('tourism_office_chat.message');
    
    //Alert
    Route::get('/alert/{id?}', [AlertController::class, 'index'])
        ->name('tourism_office_alert.index');
    Route::post('alert', [AlertController::class, 'store'])->name('tourism_office_alert.message');
    
    //Route to Hotel Request
    Route::get('/hotel_request/{hotel_id}{notification_id?}', [HotelRequestsController::class, 'show'])->name('show.requests');
    Route::get('/all_requests', [HotelRequestsController::class, 'index'])->name('show.all_requests');
    Route::post('/hotel_request/{hotel_id}', [HotelRequestsController::class, 'determineDateGoingDownToHotel'])->name('determine_date');
    Route::post('/hotel_opening_request/{hotel}', [HotelRequestsController::class, 'hotelOpeningRequest'])->name('replay_open_hotel');
    Route::post('/initial_acceptance/{hotel}', [HotelRequestsController::class, 'initialAcceptance'])->name('initial_acceptance');
    
    //Guests
    Route::get('/all_guests', [GuestController::class, 'index'])->name('tourism_office_guests_all.index');
    Route::get('/show_guests/{id}', [GuestController::class, 'show'])->name('tourism_office_guests.show');
    Route::get('/today_guests', [GuestController::class, 'daily'])->name('tourism_office_guests_today.daily');

    //route ro profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile_to.edit');
    Route::get('/profile/change_account_information', [ProfileController::class, 'change_account_information'])->name('profile_to.change_account_information');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile_to.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile_to.destroy');
});