<?php

namespace App\Providers;

use App\Events\AccommodationWithForeign;
use App\Events\AccommodationWithResidentialPermit;
use App\Events\AccommodationWithWantedPeople;
use App\Events\ChangeTaxPercentage;
use App\Events\CreateNewRoom;
use App\Events\CreateNewTourismOffice;
use App\Events\CreateNewUser;
use App\Events\DetermineDateGoingDown;
use App\Events\FinshAddingRooms;
use App\Events\HotelLicenseIssuanceFee;
use App\Events\HotelOpeningRequest;
use App\Events\HotelRenewalLicenseEM;
use App\Events\InitialAcceptanceToRequestToOpenHotel;
use App\Events\ReplyToRequestToOpenHotel;
use App\Events\TaxesMonthlyReady;
use App\Events\UpdateRoom;
use App\Listeners\SendAccommodationWithForeignNotification;
use App\Listeners\SendAccommodationWithResidentialPermitNotification;
use App\Listeners\SendAccommodationWithWantedPeopleNotification;
use App\Listeners\SendChangeTaxPercentageNotification;
use App\Listeners\SendCreateNewRoomNotification;
use App\Listeners\SendCreateNewTourismOfficeNotification;
use App\Listeners\SendCreateNewUserNotification;
use App\Listeners\SendDetermineDateGoingDownNotification;
use App\Listeners\SendFinshAddingRoomsNotification;
use App\Listeners\SendHotelLicenseIssuanceFeeNotification;
use App\Listeners\SendHotelOpeningRequestNotification;
use App\Listeners\SendHotelRenewalLicenseEMNotification;
use App\Listeners\SendInitialAcceptanceToRequestToOpenHotelNotification;
use App\Listeners\SendReplyToRequestToOpenHotelNotification;
use App\Listeners\SendTaxesMonthlyReadyNotification;
use App\Listeners\SendUpdateRoomNotification;
use App\Notifications\InitialAcceptanceToRequestToOpenHotelNotification;
use App\Notifications\ReplyFalseToRequestToOpenHotelNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],

        HotelOpeningRequest::class => [
            SendHotelOpeningRequestNotification::class,
        ],
        FinshAddingRooms::class => [
            SendFinshAddingRoomsNotification::class,
        ],
        DetermineDateGoingDown::class => [
            SendDetermineDateGoingDownNotification::class,
        ],
        InitialAcceptanceToRequestToOpenHotel::class => [
            SendInitialAcceptanceToRequestToOpenHotelNotification::class,
        ],
        HotelLicenseIssuanceFee::class => [
            SendHotelLicenseIssuanceFeeNotification::class,
        ],
        ReplyToRequestToOpenHotel::class => [
            SendReplyToRequestToOpenHotelNotification::class,
        ],
        
        
        
        CreateNewUser::class => [
            SendCreateNewUserNotification::class,
        ],

        AccommodationWithResidentialPermit::class => [
            SendAccommodationWithResidentialPermitNotification::class,
        ],
        AccommodationWithForeign::class => [
            SendAccommodationWithForeignNotification::class,
        ],
        AccommodationWithWantedPeople::class => [
            SendAccommodationWithWantedPeopleNotification::class,
        ],
        TaxesMonthlyReady::class => [
            SendTaxesMonthlyReadyNotification::class,
        ],
        CreateNewRoom::class => [
            SendCreateNewRoomNotification::class,
        ],
        UpdateRoom::class => [
            SendUpdateRoomNotification::class,
        ],
        ChangeTaxPercentage::class => [
            SendChangeTaxPercentageNotification::class,
        ],
        HotelRenewalLicenseEM::class => [
            SendHotelRenewalLicenseEMNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
