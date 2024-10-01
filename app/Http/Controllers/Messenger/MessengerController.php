<?php

namespace App\Http\Controllers\Messenger;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\HotelUser;
use App\Models\MessagingAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class MessengerController extends Controller
{
    public function index($id = null)
    {
        $user = Auth::user();
        $messaging_account = MessagingAccount::getMessagingAccount($user);

        if($messaging_account->type == 'tourist_police' || $messaging_account->type == 'tourism_office'){
            // $this->authorize('messenger.use');
            $chats = $messaging_account->conversations()->with([
                'lastMessage',
                'participants' => function($builder) use ($messaging_account){
                    $builder->where('id', '<>', $messaging_account->id);
                }])->get();
        } else {
            $chats = $messaging_account->conversations()->where('type', 'peer')->with([
                'lastMessage',
                'participants' => function($builder) use ($messaging_account){
                    $builder->where('id', '<>', $messaging_account->id);
                }])->get();
        }
        
            
        $messages = [];
        $activeChat = new Conversation();
        if($id){
            $activeChat = $chats->where('id', $id)->first();
            $messages = $activeChat->messages()->where('type_message', '=', 'chat')->with('messaging_account')->get();
        }

        $user = Auth::user();
        $class_name = class_basename($user);
        $folder_name = Str::snake($class_name);
        if ($folder_name=='hotel_user') {
            $folder_name = 'hotels' ;
        } else {
            $folder_name = Str::snake($class_name);
        }
        // dd($folder_name);
        return view('pages.chat.index',[
            'messaging_account' => $messaging_account,
            'chats' => $chats,
            'activeChat' => $activeChat,
            'messages' => $messages,
            'x'=>$folder_name, //folder_name
        ]);
    }
}
