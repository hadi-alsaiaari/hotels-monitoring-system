
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
        <a href="{{route('dashboard_sdo')}}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Tabs</li>
      @can('hotels.view')
        <li class="nav-item">
          <a href="{{route('security_department_office_all_hotels')}}" class="nav-link">
            <i class="link-icon" data-feather="home"></i>
            <span class="link-title">Hotels</span>
          </a>
        </li>      
      @endcan
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Wanted" role="button" aria-expanded="false" aria-controls="Wanted">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Wanted People</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Wanted">
          <ul class="nav sub-menu">
            @can('wanted-people.view')
              <li class="nav-item">
                <a href="{{route('security_department_office_wanted_people_all.index')}}" class="nav-link">All Wanted People</a>
              </li>
            @endcan
            @can('wanted-people.create')
              <li class="nav-item">
                <a href="{{route('security_department_office_wanted_people.create')}}" class="nav-link">Add Wanted People</a>
              </li>        
            @endcan
          </ul>
        </div>
      </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#Guest" role="button" aria-expanded="false" aria-controls="Guest">
        <i class="link-icon" data-feather="users"></i>
        <span class="link-title">Guests</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
      </a>
      <div class="collapse" id="Guest">
        <ul class="nav sub-menu">
          @can('guests.daily')
            <li class="nav-item">
              <a href="{{route('security_department_office_guests_today.daily')}}" class="nav-link">Today's Guests</a>
            </li>
          @endcan
          @can('guests.view')
            <li class="nav-item">
              <a href="{{route('security_department_office_guests_all.index')}}" class="nav-link">All Guests</a>
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
            <a href="{{route('security_department_office_accommodations_today.daily')}}" class="nav-link">{{__('Todays Accommodations')}}</a>
          </li>
          @endcan
          @can('accommodations.view')
          <li class="nav-item">
            <a href="{{route('security_department_office_accommodations_all.index')}}" class="nav-link">{{__('All Accommodations')}}</a>
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
              <a href="{{route('security_department_office_create_employees')}}" class="nav-link">{{__('Add employees')}}</a>
            </li>
          @endcan
          @can('employees.view')
            <li class="nav-item">
              <a href="{{route('security_department_office_index_employees')}}" class="nav-link">{{__('All employees')}}</a>
            </li>          
          @endcan
          @can('roles.view')
            <li class="nav-item">
              <a href="{{route('security_department_office_roles_all.index')}}" class="nav-link">{{__('All jobs')}}</a>
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
            <a href="{{route('security_department_office_report_accommodation')}}" class="nav-link">{{__('Accommodations')}}</a>
          </li>
          @endcan
          @can('guests.report')
          <li class="nav-item">
            <a href="{{route('security_department_office_report_guest')}}" class="nav-link">{{__('Guests')}}</a>
          </li>
          @endcan
          @can('wanted-people.report')
          <li class="nav-item">
            <a href="{{route('security_department_office_report_wantpeople')}}" class="nav-link">{{__('Wanted People')}}</a>
          </li>
          @endcan
        </ul>
      </div>
    </li>
    </ul>
  </div>
</nav>