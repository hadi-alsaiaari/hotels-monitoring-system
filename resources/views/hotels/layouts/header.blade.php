@php
$id = Auth::user()->id;
$hotel_owner= App\Models\HotelOwner::find($id);
$user = App\Models\HotelUser::find($id);

        $id = Auth::user()->id;
        $hotel_owner= App\Models\HotelOwner::find($id);
        $user = App\Models\HotelUser::find($id);

        $user = App\Models\HotelUser::findOrFail($id);
            if($user->user_of_hotel_type == 'App\Models\HotelOwner'){
                $hotel_user = $user->user_of_hotel()->with('phone_numbers', 'identity')->first();
            } elseif($user->user_of_hotel_type == 'App\Models\HotelExecutiveManager'){
                $hotel_user = $user->user_of_hotel()->with('identity')->first();
            }
            $hotel_user = $user->user_of_hotel()->with('identity')->first();

@endphp

<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">

    <ul class="navbar-nav">
      @if($user->user_of_hotel_type != 'App\Models\HotelOwner')
      <li class="nav-item">
        <a href="{{route('hotels_chat.index')}}" class="nav-link">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title"></span>
        </a>
      </li>
      @endif


      <!-- Notifications Dropdown Menu -->
      @if($user->user_of_hotel_type != 'App\Models\HotelReceptionist')
      <x-dashboard.notification-menu count="7"/>
      <x-dashboard.list-hotels count="7"/>
      @endif
      {{-- @include('components.dashboard.notification-menu') --}}

      {{-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i data-feather="bell"></i>
          <div class="indicator">
            <div class="circle"></div>
          </div>
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
          <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
            <p>6 New Notifications</p>
            <a href="javascript:;" class="text-muted">Clear all</a>
          </div>
          <div class="p-1">
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="gift"></i>
              </div>
              <div class="flex-grow-1 me-2">
                <p>New Order Recieved</p>
                <p class="tx-12 text-muted">30 min ago</p>
              </div>	
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="alert-circle"></i>
              </div>
              <div class="flex-grow-1 me-2">
                <p>Server Limit Reached!</p>
                <p class="tx-12 text-muted">1 hrs ago</p>
              </div>	
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="userr">
              </div>
              <div class="flex-grow-1 me-2">
                <p>New customer registered</p>
                <p class="tx-12 text-muted">2 sec ago</p>
              </div>	
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="layers"></i>
              </div>
              <div class="flex-grow-1 me-2">
                <p>Apps are ready for update</p>
                <p class="tx-12 text-muted">5 hrs ago</p>
              </div>	
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="download"></i>
              </div>
              <div class="flex-grow-1 me-2">
                <p>Download completed</p>
                <p class="tx-12 text-muted">6 hrs ago</p>
              </div>	
            </a>
          </div>
          <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
            <a href="javascript:;">View all</a>
          </div>
        </div>
      </li> --}}


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="wd-30 ht-30 rounded-circle" src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ $hotel_user->identity->full_name }}" alt="profile">
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
          <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
            <div class="mb-3">
              <img class="wd-80 ht-80 rounded-circle" src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ $hotel_user->identity->full_name }}" alt="">
            </div>
            <div class="text-center">
              <p class="tx-16 fw-bolder">{{ $hotel_user->identity->full_name}}</p>
              <p class="tx-12 text-muted">{{ Auth::user()->email }}</p>
            </div>
          </div>
          <ul class="list-unstyled p-1">
            <li class="dropdown-item py-2">
              <a href="{{route('profile_h.edit')}}" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="user"></i>
                <span>Profile</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="{{route('profile_h.change_account_information')}}" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="edit"></i>
                <span>Change Account Information</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              
              <form method="POST" action="{{ route('logout') }}">
                @csrf
  
                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    
                    <i class="me-2 icon-md" data-feather="log-out"></i>                
                    <span>{{ __('Log Out') }}</span>
                </x-dropdown-link>
              </form>
              
                
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>

