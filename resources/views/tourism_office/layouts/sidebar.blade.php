
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
          <a href="{{route('dashboard_to')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        
        <li class="nav-item nav-category">Tabs</li>
        @can('hotel-requests.reply')
        <li class="nav-item">
          <a href="{{route('show.all_requests')}}" class="nav-link">
            <i class="link-icon" data-feather="truck"></i>
            <span class="link-title">Hotel requests</span>
          </a>
        </li>
        @endcan
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Activity_Rules" role="button" aria-expanded="false" aria-controls="Activity_Rules">
          <i class="link-icon" data-feather="book-open"></i>
          <span class="link-title">Hotel Activity Rules</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Activity_Rules">
          <ul class="nav sub-menu">
            @can('hotel-activity-rules.view')
            <li class="nav-item">
              <a href="{{route('show.activity_rules')}}" class="nav-link">All Rules</a>
            </li>
            @endcan
            @can('hotel-activity-rules.create')
            <li class="nav-item">
              <a href="{{route('show.creat_rules')}}" class="nav-link">Add Rules</a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Employees" role="button" aria-expanded="false" aria-controls="Employees">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">{{__('Employees')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Employees">
          <ul class="nav sub-menu">
            @can('employees.create')
            <li class="nav-item">
              <a href="{{route('tourism_office_create_employees')}}" class="nav-link">{{__('Add employees')}}</a>
            </li>
            @endcan
            @can('employees.view')
            <li class="nav-item">
              <a href="{{route('tourism_office_index_employees')}}" class="nav-link">{{__('All employees')}}</a>
            </li>
            @endcan
            @can('roles.view')
            <li class="nav-item">
              <a href="{{route('tourism_office_roles_all.index')}}" class="nav-link">{{__('All jobs')}}</a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#Hotels" role="button" aria-expanded="false" aria-controls="Hotels">
            <i class="link-icon" data-feather="home"></i>
            <span class="link-title">Hotels</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="Hotels">
            <ul class="nav sub-menu">
              {{-- <li class="nav-item">
                <a href="" class="nav-link">Guests Todays</a>
              </li> --}}
              @can('hotels.view')
              <li class="nav-item">
                <a href="{{route('tourism_office_all_hotels')}}" class="nav-link">All Hotel</a>
              </li>
              <li class="nav-item">
                <a href="{{route('hotel_block')}}" class="nav-link">Closed Hotels</a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#Residetial" role="button" aria-expanded="false" aria-controls="Residetial">
            <i class="link-icon" data-feather="file-text"></i>
            <span class="link-title">Taxes</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="Residetial">
            <ul class="nav sub-menu">
              
              <li class="nav-item">
                <a href="{{route('all_t')}}" class="nav-link">All taxes</a>
              </li>
             
              <li class="nav-item">
                <a href="{{route('all_percentage')}}" class="nav-link">Determine the tax value</a>
              </li>
              
            </ul>
          </div>
        </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Wanted" role="button" aria-expanded="false" aria-controls="Wanted">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Guests</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Wanted">
          <ul class="nav sub-menu">
            @can('hotel-requests.reply')
            <li class="nav-item">
              <a href="{{route('tourism_office_guests_today.daily')}}" class="nav-link">Today's guests</a>
            </li>
            @endcan
            @can('guests.daily')
            <li class="nav-item">
              <a href="{{route('tourism_office_guests_all.index')}}" class="nav-link">All guests</a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#guests" role="button" aria-expanded="false" aria-controls="guests">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Reports</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="guests">
          <ul class="nav sub-menu">
            @can('hotel-requests.reply')
            <li class="nav-item">
              <a href="{{route('tourism_office_report_accommodation')}}" class="nav-link">Accommodations</a>
            </li>
            @endcan
            @can('hotel-requests.reply')
            <li class="nav-item">
              <a href="{{route('tourism_office_report_guest')}}" class="nav-link">Guests</a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">Communicate</li>
      @can('hotel-requests.reply')
      <li class="nav-item">
          <a href="{{route('tourism_office_chat.index')}}" class="nav-link">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Chat</span>
          </a>
        </li>
      </li>
      @endcan
      <li class="nav-item">
          <a href="{{route('tourism_office_alert.index')}}" class="nav-link">
            <i class="link-icon" data-feather="alert-octagon"></i>
            <span class="link-title">Alert</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>