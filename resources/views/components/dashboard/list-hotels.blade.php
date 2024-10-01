{{-- @dd($list_hotels) --}}
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i data-feather="refresh-ccw"></i>
      <div class="indicator">
        <div style="color: red;text-transform: uppercase;font-size: 0.875rem;font-weight: 400;padding: 1.1px 0px 0px 10px;">
          
        </div>
      </div>
    </a>
    <div class="dropdown-menu p-0"  aria-labelledby="notificationDropdown">
      <div >
       
        <!-- <span class="dropdown-header"> Notifications</span> -->
        @if (!empty($list_hotels))
          @foreach($list_hotels as $list_hotel)

          {{-- <a href="{{route('change_hotel',$list_hotel->id)}}?hotel_id={{$list_hotel->id}}" class="dropdown-item text-wrap"> --}}
              <form action="{{route('change_hotel',$list_hotel->id)}}" method="post">
                @csrf
                <input type="text" name="hotel_id" value="{{$list_hotel->id}}" hidden>
                <button class="btn btn-light"  type="submit">
                  <div class="d-flex justify-content-between flex-grow-1">
                    <i data-feather="home"></i>
                    <div class="ml-4" style="margin-left: 10px;">
                      <p>{{ $list_hotel->trade_name }}</p>
                      <p class="tx-12 text-muted" style="width: 200px;">{{ $list_hotel->hotel_email }}</p>
                    </div>
                    <p class="tx-12 text-muted">last week</p>
                  </div>	
                </button>
              </form>
          {{-- </a> --}}
          <div class="dropdown-divider"></div>
          @endforeach
        @endif
        <a href="{{route('create_another_hotel')}}" class="btn btn-link"><i data-feather="plus-square"></i> New Hotel</a>
      </div>
    </div>
  </li>