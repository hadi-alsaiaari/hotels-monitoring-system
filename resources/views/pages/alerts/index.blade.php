
@extends("{$x}.layouts.index")
@section('dashboard')
@php
  $user_id=App\Models\MessagingAccount::getMessagingAccount(Auth::user());
@endphp
{{-- @dd($chats) --}}
<div class="page-content">
  <div class="row chat-wrapper">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body" style="background-color: #e300002b;">
          <div class="row position-relative">
            <div class="col-lg-4 chat-aside border-end-lg">
              <div class="aside-content">
                <div class="aside-header">
                  <div class="d-flex justify-content-between align-items-center pb-2 mb-2">
                    <div class="d-flex align-items-center">
                      <figure class="me-2 mb-0">
                        <img src="https://via.placeholder.com/43x43" class="img-sm rounded-circle" alt="profile">
                        <div class="status online"></div>
                      </figure>
                      <div>
                        <h6>{{$messaging_account->name}}</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="aside-body">
                  <ul class="nav nav-tabs nav-fill mt-3" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="chats-tab" data-bs-toggle="tab" data-bs-target="#chats" role="tab" aria-controls="chats" aria-selected="true">
                        <div class="d-flex flex-row flex-lg-column flex-xl-row align-items-center justify-content-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square icon-sm me-sm-2 me-lg-0 me-xl-2 mb-md-1 mb-xl-0"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                          <p class="d-none d-sm-block">Alert</p>
                        </div>
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content mt-3">
                    <div class="tab-pane fade show active ps ps--active-y" id="chats" role="tabpanel" aria-labelledby="chats-tab">
                      <div>
                        <p class="text-muted mb-1">Recent chats</p>
                        <ul class="list-unstyled chat-list px-1">
                          @foreach ($chats as $chat)
                          <li class="chat-item pe-1">
                            <a href="{{route($x.'_alert.index',['id' => $chat->id]) }}" class="d-flex align-items-center">
                              <figure class="mb-0 me-2">
                                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{$chat->label}}" class="img-xs rounded-circle" alt="user">
                                <div class="status online"></div>
                              </figure>
                              <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                                <div>
                                  <p class="text-body fw-bolder">{{$chat->label}}</p>
                                  <p class="text-muted tx-13">
                                @if ($chat->lastMessage->type_message=='alert')
                                {{(!empty($chat->lastMessage->body)) ? $chat->lastMessage->body : '....' }}
                                @endif</p>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                  <p class="text-muted tx-13 mb-1">{{ !empty($chat->lastMessage->created_at) ? $chat->lastMessage->created_at->diffForHumans() : ''}}</p>
                                  <div class="badge rounded-pill bg-primary ms-auto">5</div>
                                </div>
                              </div>
                            </a>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 213px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 66px;"></div></div></div>
                    <div class="tab-pane fade ps" id="calls" role="tabpanel" aria-labelledby="calls-tab">
                      <p class="text-muted mb-1">Recent calls</p>
                      
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8 chat-content">
              <div class="chat-header border-bottom pb-2">
                <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left icon-lg me-2 ms-n2 text-muted d-lg-none" id="backToChatList"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                    <figure class="mb-0 me-2">
                      <img src="https://via.placeholder.com/43x43" class="img-sm rounded-circle" alt="image">
                      <div class="status online"></div>
                      <div class="status online"></div>
                    </figure>
                    <div>
                      <p>{{$activeChat->label}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="chat-body ps ps--active-y" >
                @if (!empty($messages))
                <ul class="messages" id="chat-body">
                  @foreach ($messages as $message)
                  {{-- @dd($message) --}}
                  <li class="message-item @if($message->messaging_account_id == Auth::id()) me @endif friend">
                    <img src="https://via.placeholder.com/36x36" class="img-xs rounded-circle" alt="avatar">
                    <div class="content">
                      <div class="message">
                        <div class="bubble">
                          <p>{{$message->body}}</p>
                        </div>
                        <span>{{$message->created_at->diffForHumans()}}</span>
                      </div>
                    </div>
                  </li>
                
              <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 258px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 76px;"></div></div>
              @endforeach
            </ul>
                @else
                <div class="d-flex flex-column h-100 justify-content-center text-center"><div class="mb-6"><span class="icon icon-xl text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather" data-feather="alert-octagon"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg></span></div><p class="text-muted">Pick a person from left menu, <br> and start your conversation.</p></div>
                @endif
                
            </div>
              
              <div class="chat-footer d-flex">
                {{-- <div class="d-none d-md-block">
                  <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" data-bs-title="Attatch files">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip text-muted"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                  </button>
                </div> --}}
                <form id="search-form" class="flex-grow-1 me-2 d-flex" action="{{route($x.'_alert.message')}}" method="post">
                  @csrf
                  <input type="hidden" name="conversation_id" value="{{$activeChat->id}}">
                  {{-- <div class="input-group">
                    <div  style="height: 40px;" class="dropify-wrapper"><div class="dropify-message"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip text-muted"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg><p class="dropify-error">Ooops, something wrong appended.</p></div><div class="dropify-loader"></div><div class="dropify-errors-container"><ul></ul></div><input type="file" onchange="document.getElementById('searchText').style.display = 'none'" id="myDropify" class="border" ><button type="button" class="dropify-clear">Remove</button><div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
                  </div> --}}
                  {{-- <div class="input-group" id="searchText">
                    <input type="text" name="message" class="form-control rounded-pill" id="chatForm" placeholder="Type a message">
                  </div> --}}
                  <div class="input-group" id="searchText">
                    {{-- <input type="text" name="message" class="form-control rounded-pill" id="chatForm" placeholder="Type a message"> --}}
                    <textarea name="message" id="" class="form-control rounded-pill" id="chatForm" placeholder="Type a message" cols="10" rows="1" style="resize: none;"></textarea>
                  </div>

                  <div>
                    <button type="submit" class="btn btn-primary btn-icon rounded-circle">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
  const userID ="{{ $user_id->id}}";
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('f4327f01110cdf0ed9a1', {
    cluster: 'ap2',
    authEndpoint: "/broadcasting/auth",
  });

  var channel = pusher.subscribe(`presence-Messenger.${userID}`);
  channel.bind('new-message', function(data) {
    alert(JSON.stringify(data));
  });
</script>
<script>
  $('#search-form').on('submit', function(e){
    e.preventDefault();
    let msg= $(this).find('textarea').val();
    $.post($(this).attr('action'), $(this).serialize(), function(response){

    });
    $('#chat-body').append(`<li class="message-item me"><img src="https://via.placeholder.com/36x36" class="img-xs rounded-circle" alt="avatar"><div class="content"><div class="message"><div class="bubble"><p>${msg}</p></div></div><div class="message"><span>{{!empty($message->created_at) ? $message->created_at->diffForHumans() : 'no'}}</span></div></div></div></li>`);
    $(this).find('textarea').val('');
  })
</script>

@endsection