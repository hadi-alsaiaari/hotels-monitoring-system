<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i data-feather="bell"></i>
      <div class="indicator">
        <div class="circle" style="color: red;text-transform: uppercase;font-size: 0.875rem;font-weight: 400;padding: 1.1px 0px 0px 10px;">
          @if ($newCount)
        <span >{{$newCount}}</span>
        @endif
        </div>
      </div>
    </a>
    <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
      <div class="">
        <span class="dropdown-header">{{ $newCount }} Notifications</span>
        <div class="dropdown-divider"></div>
        @auth('tourism_office')
        @foreach($notifications as $notification)
        <a href="{{route('show.requests',$notification->data['id'])}}?notification_id={{$notification->id}}" class="dropdown-item text-wrap @if ($notification->unread()) text-bold @endif">
            {{-- <div class="me-3">
              <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="userr">
            </div> --}}

            <div class="d-flex justify-content-between flex-grow-1">
              <div class="me-4">
                <p>Leonardo Payne</p>
                <p class="tx-12 text-muted" style="width: 200px;">{{ $notification->data['body'] }}</p>
              </div>
              <p class="tx-12 text-muted">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</p>
            </div>	

            {{-- <i class="{{ $notification->data['icon'] }} mr-2"></i> 
            <span class="float-right text-muted text-sm"></span> --}}
        </a>
        <div class="dropdown-divider"></div>
        @endforeach
        @endauth
        {{-- @auth('tourist_police') --}}
        @if (!Auth::guard('tourism_office')->check())
            
        
        @foreach($notifications as $notification)
        <a href="#" class="dropdown-item text-wrap @if ($notification->unread()) text-bold @endif">
          {{-- <div class="me-3">
            <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="userr">
          </div> --}}

          <div class="d-flex justify-content-between flex-grow-1">
            <div class="me-4">
              <p>Leonardo Payne</p>
              <p class="tx-12 text-muted" style="width: 200px;">{{ $notification->data['body'] }}</p>
            </div>
            <p class="tx-12 text-muted">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</p>
          </div>	

          {{-- <i class="{{ $notification->data['icon'] }} mr-2"></i> 
          <span class="float-right text-muted text-sm"></span> --}}
      </a>
        @endforeach
        {{-- @endauth --}}
        @endif
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </div>
  </li>
  
  {{-- <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if ($newCount)
        <span class="badge badge-warning navbar-badge">{{ $newCount }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ $newCount }} Notifications</span>
        <div class="dropdown-divider"></div>
        @foreach($notifications as $notification)
        <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}" class="dropdown-item text-wrap @if ($notification->unread()) text-bold @endif">
            <i class="{{ $notification->data['icon'] }} mr-2"></i> {{ $notification->data['body'] }}
            <span class="float-right text-muted text-sm">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</span>
        </a>
        <div class="dropdown-divider"></div>
        @endforeach
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li> --}}