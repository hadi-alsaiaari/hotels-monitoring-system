@php
$id = Auth::user()->id;
$hotel_owner= App\Models\HotelOwner::find($id);
$user = App\Models\HotelUser::find($id);
@endphp

  <nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        HMS<span></span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{route('dashboard_h')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">Tabs</li>
        <li class="nav-item">
          <a href="{{route('hotel_activity_rules')}}" class="nav-link">
            <i class="link-icon" data-feather="book-open"></i>
            <span class="link-title">Hotel Activity Rules</span>
          </a>
      </li>
      @if($user->user_of_hotel_type != 'App\Models\HotelReceptionist')
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Hotels" role="button" aria-expanded="false" aria-controls="Hotels">
          <i class="link-icon" data-feather="home"></i>
          <span class="link-title">Hotel</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Hotels">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('hotel_details')}}" class="nav-link">Hotel Details</a>
            </li>
            <li class="nav-item">
              <a href="{{route('create_another_hotel')}}" class="nav-link">New Hotel</a>
            </li>
          </ul>
        </div>
      </li>
      
      <li class="nav-item">
        <a href="{{route('index_EM')}}" class="nav-link">
          <i class="link-icon" data-feather="sliders"></i>
          <span class="link-title">Executive Manager</span>
        </a>
        <a href="{{route('create_EM')}}" hidden class="nav-link">
          <i class="link-icon" data-feather="sliders"></i>
          <span class="link-title">Executive Manager</span>
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#Receptionist" role="button" aria-expanded="false" aria-controls="Receptionist">
        <i class="link-icon" data-feather="users"></i>
        <span class="link-title">Receptionist</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
      </a>
      <div class="collapse" id="Receptionist">
        <ul class="nav sub-menu">
          <li class="nav-item">
            <a href="{{route('index_R')}}" class="nav-link">All Receptionist</a>
          </li>
          <li class="nav-item">
            <a href="{{route('create_R')}}" class="nav-link">Add Receptionist</a>
          </li>
        </ul>
      </div>
    </li>
    
      {{-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Executive" role="button" aria-expanded="false" aria-controls="Executive">
          <i class="link-icon" data-feather="sliders"></i>
          <span class="link-title">Executive Manager</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Executive">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('index_EM',$id)}}" class="nav-link">All Executive Manager</a>
            </li>
            <li class="nav-item" hidden>
              <a href="{{route('create_EM')}}" hidden class="nav-link">Add Executive Manager</a>
            </li>
          </ul>
        </div>
      </li> --}}
        
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#Guests" role="button" aria-expanded="false" aria-controls="Guests">
            <i class="link-icon" data-feather="users"></i>
            <span class="link-title">Guests</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="Guests">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="" class="nav-link">Guests Todays</a>
              </li>
              <li class="nav-item">
                <a href="pages/email/read.html" class="nav-link">All Guests</a>
              </li>
            </ul>
          </div>
        </li>
        {{-- <li class="nav-item">
          <a href="" class="nav-link">
            <i class="link-icon" data-feather="file-text"></i>
            <span class="link-title">Residetial Permits</span>
          </a>
      </li> --}}
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#Firearms" role="button" aria-expanded="false" aria-controls="Firearms">
            <i class="link-icon" data-feather="crosshair"></i>
            <span class="link-title">Firearms</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="Firearms">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="" class="nav-link">All Firearms</a>
              </li>
            </ul>
          </div>
        </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Accommodations" role="button" aria-expanded="false" aria-controls="Accommodations">
          <i class="link-icon" data-feather="archive"></i>
          <span class="link-title">{{__('Accommodations')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Accommodations">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('hotels_accommodations_today.daily')}}" class="nav-link">{{__('Todays Accommodations')}}</a>
            </li>
            <li class="nav-item">
              <a href="{{route('hotels_accommodations_all.index')}}" class="nav-link">{{__('All Accommodations')}}</a>
            </li>
          </ul>
        </div>
      </li>
      @if($user->user_of_hotel_type != 'App\Models\HotelOwner')
      <li class="nav-item nav-category">Communicate</li>
      <li class="nav-item">
        {{-- <a href="{{route('chat.index',$chat->id)}}" hidden class="d-flex align-items-center"></a> --}}
          <a href="{{route('hotels_chat.index')}}" class="nav-link">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Chat</span>
          </a>
        </li>
      </li>
      <li class="nav-item">
          <a href="{{route('hotels_alert.index')}}" class="nav-link">
            <i class="link-icon" data-feather="alert-octagon"></i>
            <span class="link-title">Alert</span>
          </a>
        </li>
      @endif
      </ul>
    </div>
  </nav>