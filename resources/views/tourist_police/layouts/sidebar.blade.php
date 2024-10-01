
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
        <li class="nav-item nav-category">{{__('Main')}}</li>
        <li class="nav-item">
          <a href="{{route('dashboard_tp')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">{{__('Dashboard')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('Tabs')}}</li>
        {{-- <li class="nav-item">
          <a href="" class="nav-link">
            <i class="link-icon" data-feather="truck"></i>
            <span class="link-title">Roles</span>
          </a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#Residetial" role="button" aria-expanded="false" aria-controls="Residetial">
            <i class="link-icon" data-feather="file-text"></i>
            <span class="link-title">{{__('Residetial Permits')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="Residetial">
            <ul class="nav sub-menu">
              @can('residential-permit.view')
              <li class="nav-item">
                <a href="{{route('residential_permit.index')}}" class="nav-link">{{__('All Permits')}}</a>
              </li>                
              @endcan
              @can('residential-permit.create')
              <li class="nav-item">
                <a href="{{url('t-p/residential_permit/create')}}" class="nav-link">{{__('Add Permits')}}</a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#Firearms" role="button" aria-expanded="false" aria-controls="Firearms">
            <i class="link-icon" data-feather="crosshair"></i>
            <span class="link-title">{{__('Firearms')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="Firearms">
            <ul class="nav sub-menu">
              @can('firearms.view')
              <li class="nav-item">
                <a href="{{route('firearm_all.index')}}" class="nav-link">{{__('All Firearms')}}</a>
              </li>
              @endcan
              @can('firearms.daily')
              <li class="nav-item">
                <a href="{{route('firearm_today.daily')}}" class="nav-link">{{__('Todays Firearms')}}</a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Activity_Rules" role="button" aria-expanded="false" aria-controls="Activity_Rules">
          <i class="link-icon" data-feather="book-open"></i>
          <span class="link-title">Hotel Activity Rules</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Activity_Rules">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('show.activity_rules')}}" class="nav-link">All Rules</a>
            </li>
            <li class="nav-item">
              <a href="{{route('show.creat_rules')}}" class="nav-link">Add Rules</a>
            </li>
          </ul>
        </div>
      </li> --}}
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
                <a href="{{route('tourist_police_create_employees')}}" class="nav-link">{{__('Add employees')}}</a>
              </li>
              @endcan
              @can('employees.view')
              <li class="nav-item">
                <a href="{{route('tourist_police_index_employees')}}" class="nav-link">{{__('All employees')}}</a>
              </li>
              @endcan
              @can('roles.view')
              <li class="nav-item">
                <a href="{{route('tourist_police_roles_all.index')}}" class="nav-link">{{__('All jobs')}}</a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @can('hotels.view')
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#Hotels" role="button" aria-expanded="false" aria-controls="Hotels">
            <i class="link-icon" data-feather="home"></i>
            <span class="link-title">{{__('Hotels')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="Hotels">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('tourist_police_all_hotels')}}" class="nav-link">{{__('All Hotel')}}</a>
              </li>
            </ul>
          </div>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#Wanted" role="button" aria-expanded="false" aria-controls="Wanted">
            <i class="link-icon" data-feather="file-text"></i>
            <span class="link-title">{{__('Wanted People')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="Wanted">
            <ul class="nav sub-menu">
              @can('wanted-people.view')
              <li class="nav-item">
                <a href="{{route('tourist_police_wanted_people_all.index')}}" class="nav-link">{{__('All Wanted People')}}</a>
              </li>
              @endcan
              @can('wanted-people.create')
              <li class="nav-item">
                <a href="{{route('tourist_police_wanted_people.create')}}" class="nav-link">{{__('Add Wanted People')}}</a>
              </li>
              @endcan
            </ul>
          </div>
        </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Accommodations" role="button" aria-expanded="false" aria-controls="Accommodations">
          <i class="link-icon" data-feather="archive"></i>
          <span class="link-title">{{__('Accommodations')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Accommodations">
          <ul class="nav sub-menu">
            @can('accommodations.daily')
            <li class="nav-item">
              <a href="{{route('tourist_police_accommodations_today.daily')}}" class="nav-link">{{__('Todays Accommodations')}}</a>
            </li>
            @endcan
            @can('accommodations.view')
            <li class="nav-item">
              <a href="{{route('tourist_police_accommodations_all.index')}}" class="nav-link">{{__('All Accommodations')}}</a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Guest" role="button" aria-expanded="false" aria-controls="Guest">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">{{__('Guests')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Guest">
          <ul class="nav sub-menu">
            @can('guests.daily')
            <li class="nav-item">
              <a href="{{route('tourist_police_guests_today.daily')}}" class="nav-link">{{__('Todays Guests')}}</a>
            </li>
            @endcan
            @can('guests.view')
            <li class="nav-item">
              <a href="{{route('tourist_police_guests_all.index')}}" class="nav-link">{{__('All Guests')}}</a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#guests" role="button" aria-expanded="false" aria-controls="guests">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">{{__('Reports')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="guests">
          <ul class="nav sub-menu">
            @can('accommodations.report')
            <li class="nav-item">
              <a href="{{route('tourist_police_report_accommodation')}}" class="nav-link">{{__('Accommodations')}}</a>
            </li>
            @endcan
            @can('guests.report')
            <li class="nav-item">
              <a href="{{route('tourist_police_report_guest')}}" class="nav-link">{{__('Guests')}}</a>
            </li>
            @endcan
            @can('firearms.report')
            <li class="nav-item">
              <a href="{{route('report_fir')}}" class="nav-link">{{__('Firearm')}}</a>
            </li>
            @endcan
            @can('wanted-people.report')
            <li class="nav-item">
              <a href="{{route('tourist_police_report_wantpeople')}}" class="nav-link">{{__('Wanted People')}}</a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('Communicate')}}</li>
      @can('messenger.use')
      <li class="nav-item">
          <a href="{{route('tourist_police_chat.index')}}" class="nav-link">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">{{__('Chat')}}</span>
          </a>
        </li>
        @endcan
      </li>
      {{-- @can() --}}
      <li class="nav-item">
          <a href="{{route('tourist_police_alert.index')}}" class="nav-link">
            <i class="link-icon" data-feather="alert-octagon"></i>
            <span class="link-title">{{__('Alert')}}</span>
          </a>
        </li>
        {{-- @endcan --}}
      </ul>
    </div>
  </nav>