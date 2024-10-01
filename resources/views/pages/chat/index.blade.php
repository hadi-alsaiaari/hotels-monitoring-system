
@extends("{$x}.layouts.index")
@section('dashboard')
@php
  
  $user = Auth::user();
  $messaging_account = App\Models\MessagingAccount::getMessagingAccount($user);
  $user_id = $messaging_account->id;

@endphp
{{-- @dd($messaging_account) --}}

<div class="page-content">
  <div class="row chat-wrapper">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row position-relative">
            <div class="col-lg-4 chat-aside border-end-lg">
              <div class="aside-content">
                <div class="aside-header">
                  <div class="d-flex justify-content-between align-items-center pb-2 mb-2">
                    <div class="d-flex align-items-center">
                      <figure class="me-2 mb-0">
                        <img src="https://ui-avatars.com/api/?background=bb49c5&color=fff&name={{$messaging_account->name}}" class="img-sm rounded-circle" alt="profile">
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
                          <p class="d-none d-sm-block">Chats</p>
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
                            <a href="{{route($x.'_chat.index',['id' => $chat->id]) }}" class="d-flex align-items-center">
                              <figure class="mb-0 me-2">
                                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{$chat->label}}" class="img-xs rounded-circle" alt="user">
                                <div class="status online"></div>
                              </figure>
                              <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                                <div>
                                  <p class="text-body fw-bolder">{{$chat->label}}</p>
                                  
                                  <p class="text-muted tx-13">@if ($chat->lastMessage->type_message=='chat')
                                    {{$chat->lastMessage->type == 'attachment'? $chat->lastMessage->body->file_name : $chat->lastMessage->body}}
                                    @endif</p>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                  <p class="text-muted tx-13 mb-1">{{ !empty($chat->lastMessage->created_at) ? $chat->lastMessage->created_at->diffForHumans() : ''}}</p>
                                  {{-- <div class="badge rounded-pill bg-primary ms-auto">5</div> --}}
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
                      <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{$activeChat->label}}" class="img-sm rounded-circle" alt="image">
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
                {{-- <div class="chat-body hide-scrollbar flex-1 h-100">
                  <div class="chat-body-inner" style="padding-bottom: 87px">
                      <div class="py-6 py-lg-12">
                        @foreach ($messages as $message)
                          <!-- Message -->
                          <div class="message or message message-out">
                              <a href="#" data-bs-toggle="modal" data-bs-target="#modal-user-profile" class="avatar avatar-responsive">
                                  <img class="avatar-img" src="assets/img/avatars/11.jpg" alt="">
                              </a>

                              <div class="message-inner">
                                  <div class="message-body">
                                      <div class="message-content">
                                          <div class="message-text">
                                              <p>Hey, Marshall! How are you? Can you please change the color theme of the website to pink and purple?</p>
                                          </div>

                                          <!-- Dropdown -->
                                          <div class="message-action">
                                              <div class="dropdown">
                                                  <a class="icon text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                  </a>

                                                  <ul class="dropdown-menu">
                                                      <li>
                                                          <a class="dropdown-item d-flex align-items-center" href="#">
                                                              <span class="me-auto">Edit</span>
                                                              <div class="icon">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                                              </div>
                                                          </a>
                                                      </li>
                                                      <li>
                                                          <a class="dropdown-item d-flex align-items-center" href="#">
                                                              <span class="me-auto">Reply</span>
                                                              <div class="icon">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                                                              </div>
                                                          </a>
                                                      </li>
                                                      <li>
                                                          <hr class="dropdown-divider">
                                                      </li>
                                                      <li>
                                                          <a class="dropdown-item d-flex align-items-center text-danger" href="#">
                                                              <span class="me-auto">Delete</span>
                                                              <div class="icon">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                              </div>
                                                          </a>
                                                      </li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="message-content">
                                          <div class="message-text">
                                              <p>Send me the files please.</p>
                                          </div>

                                          <!-- Dropdown -->
                                          <div class="message-action">
                                              <div class="dropdown">
                                                  <a class="icon text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                  </a>

                                                  <ul class="dropdown-menu">
                                                      <li>
                                                          <a class="dropdown-item d-flex align-items-center" href="#">
                                                              <span class="me-auto">Edit</span>
                                                              <div class="icon">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                                              </div>
                                                          </a>
                                                      </li>
                                                      <li>
                                                          <a class="dropdown-item d-flex align-items-center" href="#">
                                                              <span class="me-auto">Reply</span>
                                                              <div class="icon">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                                                              </div>
                                                          </a>
                                                      </li>
                                                      <li>
                                                          <hr class="dropdown-divider">
                                                      </li>
                                                      <li>
                                                          <a class="dropdown-item d-flex align-items-center text-danger" href="#">
                                                              <span class="me-auto">Delete</span>
                                                              <div class="icon">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                              </div>
                                                          </a>
                                                      </li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="message-footer">
                                      <span class="extra-small text-muted">08:45 PM</span>
                                  </div>
                              </div>
                          </div>

                          @endforeach

                      </div>
                  </div>
              </div> --}}
                @if (!empty($messages))
                {{-- <ul class="messages" id="chat-body"> --}}
                  <div class="chat-body flex-1 h-100">
                    <div class="chat-body-inner" style="padding-bottom: 17px">
                        <div class="py-1 py-lg-12" id="chat-body">
                  @foreach ($messages as $message)
                  {{-- @dd($message) --}}
                  {{-- <li class="message-item @if($message->sender_id == $user_id) me @endif friend"> --}}
                    {{-- <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{$chat->label}}" class="img-xs rounded-circle" alt="avatar"> --}}
                    
                    @if ($message->conversation_id == $message->messaging_account_id)
                    <div class=" mt-2 message-item message message">
                      <a href="#" data-bs-toggle="modal" data-bs-target="#modal-user-profile" class="avatar avatar-responsive">
                          <img class="avatar-img" src="assets/img/avatars/11.jpg" alt="">
                          <img src="https://ui-avatars.com/api/?background=bb49c5&color=fff&name={{$messaging_account->name}}" class="img-xs rounded-circle" alt="avatar">

                      </a>

                      <div class="message-inner">
                          <div class="message-body">

                              <div class="message-content">
                                  <div class="message-text">
                                      <p>{{$message->body}}</p>
                                  </div>
                              </div>
                          </div>

                          <div class="message-footer">
                              <span class="extra-small text-muted">{{$message->created_at->diffForHumans()}}</span>
                          </div>
                      </div>
                  </div>
                    @else
                    <div class=" mt-2 message-item message message-out">
                      <a href="#" data-bs-toggle="modal" data-bs-target="#modal-user-profile" class="avatar avatar-responsive">
                          <img class="avatar-img" src="assets/img/avatars/11.jpg" alt="">
                          <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{$chat->label}}" class="img-xs rounded-circle" alt="avatar">

                      </a>

                      <div class="message-inner">
                          <div class="message-body">

                              <div class="message-content">
                                  <div class="message-text">
                                      <p>{{$message->body}}</p>
                                  </div>
                              </div>
                          </div>

                          <div class="message-footer">
                              <span class="extra-small text-muted">{{$message->created_at->diffForHumans()}}</span>
                          </div>
                      </div>
                  </div>
                  @endif
                    {{-- <div class="content">
                      <div class="message">
                        <div class="bubble">
                          <p>{{$message->body}}</p>
                        </div>
                        <span>{{$message->created_at->diffForHumans()}}</span>
                      </div>
                    </div> --}}
                  {{-- </li> --}}
                
              {{-- <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 258px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 76px;"></div></div> --}}
              @endforeach
            </div>
          </div>
      </div>
            {{-- </ul> --}}
                @else
                <div class="d-flex flex-column h-100 justify-content-center text-center"><div class="mb-6"><span class="icon icon-xl text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg></span></div><p class="text-muted">Pick a person from left menu, <br> and start your conversation.</p></div>
                @endif
                
            </div>
              
              <div class="chat-footer">
                <div class="row align-items-center gx-0">
                {{-- <div class="d-none d-md-block">
                  <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" data-bs-title="Attatch files">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip text-muted"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                  </button>
                </div> --}}
                <form id="search-form" class="flex-grow-1 me-2 d-flex" data-emoji-form="" action="{{route($x.'_chat.message')}}" method="post">
                  @csrf
                  <input type="hidden" name="conversation_id" value="{{$activeChat->id}}">
                  {{-- <div class="input-group">
                    <div  style="height: 40px;" class="dropify-wrapper"><div class="dropify-message"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip text-muted"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg><p class="dropify-error">Ooops, something wrong appended.</p></div><div class="dropify-loader"></div><div class="dropify-errors-container"><ul></ul></div><input type="file" onchange="document.getElementById('searchText').style.display = 'none'" id="myDropify" class="border" ><button type="button" class="dropify-clear">Remove</button><div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
                  </div> --}}
                  {{-- <div class="input-group" id="searchText">
                    <input type="text" name="message" class="form-control rounded-pill" id="chatForm" placeholder="Type a message">
                  </div> --}}
                  {{-- <div class="col-auto">
                    <a href="#" class="btn btn-icon btn-link text-body rounded-circle dz-clickable" id="dz-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                    </a>
                </div> --}}
                  <div class="input-group" id="searchText">
                    {{-- <input type="text" name="message" class="form-control rounded-pill" id="chatForm" placeholder="Type a message"> --}}
                    <textarea name="message" id="" class="form-control rounded-pill" id="chatForm" placeholder="Type a message" cols="10"rows="1" data-emoji-input="" data-autosize="true" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;"></textarea>
                    <a href="#" class="input-group-text text-body pe-0" data-emoji-btn="">
                      <span class="icon icon-lg">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                      </span>
                  </a>
                  </div>

                  <div>
                    <button type="submit" class="btn btn-primary btn-icon rounded-circle">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    </button>
                  </div>
                </form>
                {{-- <form class="chat-form rounded-pill" data-emoji-form="">
                  <div class="row align-items-center gx-0">
                      <div class="col-auto">
                          <a href="#" class="btn btn-icon btn-link text-body rounded-circle dz-clickable" id="dz-btn">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                          </a>
                      </div>

                      <div class="col">
                          <div class="input-group">
                              <textarea class="form-control px-0" placeholder="Type your message..." rows="1" data-emoji-input="" data-autosize="true" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;"></textarea>

                              <a href="#" class="input-group-text text-body pe-0" data-emoji-btn="">
                                  <span class="icon icon-lg">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                                  </span>
                              </a>
                          </div>
                      </div>

                      <div class="col-auto">
                          <button class="btn btn-icon btn-primary rounded-circle ms-5">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                          </button>
                      </div>
                  </div>
              </form> --}}
              </div>
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

{{-- 
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>

<script src="{{ asset('js/messages.js') }}"></script> --}}

<script src="{{ asset('assets1/js/vendor.js') }}"></script>
<script src="{{ asset('assets1/js/template.js') }}"></script>

<script>
  // const userId = "{{ Auth::id() }}";
  // const csrf_token = "{{ csrf_token() }}";
  // const userId ="{{$user_id}}";
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('f4327f01110cdf0ed9a1', {
    cluster: 'ap2',
    authEndpoint: "/broadcasting/auth",
  });

  var channel = pusher.subscribe(`Presence-Messenger.{{$user_id}}`);
        channel.bind('new-message', function(data) {
            alert(JSON.stringify(data))
        });
</script>
<script>
  $('#search-form').on('submit', function(e){
    e.preventDefault();
    let msg= $(this).find('textarea').val();
    $.post($(this).attr('action'), $(this).serialize(), function(response){

    });
    // $('#chat-body').append(`<li class="message-item me"><img src="https://via.placeholder.com/36x36" class="img-xs rounded-circle" alt="avatar"><div class="content"><div class="message"><div class="bubble"><p>${msg}</p></div></div><div class="message"><span>{{!empty($message->created_at) ? $message->created_at->diffForHumans() : 'no'}}</span></div></div></div></li>`);
    $('#chat-body').append(`<div class="mt-2 message-item message">
  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-user-profile" class="avatar avatar-responsive">
      <img class="avatar-img" src="assets/img/avatars/11.jpg" alt="">
      <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{$messaging_account->name}}" class="img-xs rounded-circle" alt="avatar">

  </a>

  <div class="message-inner">
      <div class="message-body">

          <div class="message-content">
              <div class="message-text">
                  <p>${msg}</p>
              </div>
          </div>
      </div>

      <div class="message-footer">
          <span class="extra-small text-muted">now</span>
      </div>
  </div>
</div>`);
    $(this).find('textarea').val('');
  })
</script>

@endsection