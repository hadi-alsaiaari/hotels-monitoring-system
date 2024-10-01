<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Hotel;
use App\Models\HotelActivityRule;
use App\Models\HotelExecutiveManager;
use App\Models\HotelUser;
use App\Models\MessagingAccount;
use App\Models\TourismOffice;
use App\Models\TouristPolice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;
use Illuminate\Validation\Rule;

class AlertController extends Controller
{
    public function index($id = null)
    {
        // $this->authorize('alert);

        $user = Auth::user();
        $messaging_account = MessagingAccount::getMessagingAccount($user);

        if($messaging_account->type == 'tourist_police' || $messaging_account->type == 'tourism_office'){
            $chats = $messaging_account->conversations()->with([
                'participants' => function($builder) use ($messaging_account){
                    $builder->where('id', '<>', $messaging_account->id);
                }])->get();
        } else {
            $chats = $messaging_account->conversations()->where('type', 'peer')->with([
                'participants' => function($builder) use ($messaging_account){
                    $builder->where('id', '<>', $messaging_account->id);
                }])->get();
        }
            
        $messages = [];
        $activeChat = new Conversation();
        if($id){
            $activeChat = $chats->where('id', $id)->first();
            $messages = $activeChat->messages()->where('type_message', '=', 'alert')->with('messaging_account')->get();
        }

        $user = Auth::user();
        $class_name = class_basename($user);
        $folder_name = Str::snake($class_name);
        if ($folder_name=='hotel_user') {
            $folder_name = 'hotels' ;
        } else {
            $folder_name = Str::snake($class_name);
        }
        
        return view('pages.alerts.index',[
            'messaging_account' => $messaging_account,
            'chats' => $chats,
            'activeChat' => $activeChat,
            'messages' => $messages,
            'x'=>$folder_name,
        ]);
    }

    public function store(Request $request)
    {
        // $this->authorize('alert);

        $request->validate([
            // 'message' => ['required', 'string'],
            'conversation_id' => [
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('messaging_account_id');
                }),
                'int',
                'exists:conversations,id',
            ],
            'messaging_account_id' => [
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('conversation_id');
                }),
                'int',
                'exists:messaging_accounts,id',
            ],
        ]);

        $user = Auth::user();

        $messaging_account = MessagingAccount::getMessagingAccount($user);
        $conversation_id = $request->post('conversation_id');
        // $messaging_account_id = $request->post('messaging_account_id');
        // dd($messaging_account);
        DB::beginTransaction();
        try {
            $conversation = $messaging_account->conversations()->findOrFail($conversation_id);
            if ($conversation_id == 1 || $conversation_id == 2) {
                // dd($conversation_id);
                if ($messaging_account->type == 'tourism_office' || $messaging_account->type == 'tourist_police') {
                $conversation = $messaging_account->conversations()->findOrFail($conversation_id);
                } else {
                    return 'Can not send message.';
                }
            }
            if (class_basename($user) != 'HotelUser') {
                $sender_name = $user->identity->first_name . ' ' . $user->identity->second_name;
            } else {
                $sender_name = $user->user_of_hotel->identity->first_name . ' ' . $user->user_of_hotel->identity->second_name;
            }


            $type = 'text';
            $message = $request->post('message');
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $message = [
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'mimetype' => $file->getMimeType(),
                    'file_path' => $file->store('attachments', [
                        'disk' => 'public'
                    ]),
                ];
                $type = 'attachment';
            }

            if ($conversation->type == 'group') {
                $messagable = $conversation->messages()->create([
                    'messaging_account_id' => $messaging_account->id,
                    'type' => $type,
                    'body' => $message,
                    'sender_id' => $user->id,
                    'sender_name' => $sender_name,
                    'type_message' => 'alert',
                ]);
                $conversation->update([
                    'last_message_id' => $messagable->id,
                ]);
                $conversations = $messaging_account->conversations()->where('type', '=', 'peer')->get();
                foreach ($conversations as $key => $conversation) {
                    $messagable = $conversation->messages()->create([
                        'messaging_account_id' => $messaging_account->id,
                        'type' => $type,
                        'body' => $message,
                        'sender_id' => $user->id,
                        'sender_name' => $sender_name,
                        'type_message' => 'alert',
                    ]);

                    DB::statement('
                        INSERT INTO recipients (messaging_account_id, message_id)
                        SELECT messaging_account_id, ? FROM participants
                        WHERE conversation_id = ?
                    ', [$messagable->id, $conversation->id]);

                    $conversation->update([
                        'last_message_id' => $messagable->id,
                    ]);
                }
            } else {
                $messagable = $conversation->messages()->create([
                    'messaging_account_id' => $messaging_account->id,
                    'type' => $type,
                    'body' => $message,
                    'sender_id' => $user->id,
                    'sender_name' => $sender_name,
                    'type_message' => 'alert',
                ]);

                DB::statement('
                    INSERT INTO recipients (messaging_account_id, message_id)
                    SELECT messaging_account_id, ? FROM participants
                    WHERE conversation_id = ?
                ', [$messagable->id, $conversation->id]);

                $conversation->update([
                    'last_message_id' => $messagable->id,
                ]);
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->back();
    }

    public function getAlerts()
    {
        // $this->authorize('alert);

        $user = Auth::user();
        $messaging_account = MessagingAccount::getMessagingAccount($user);
        $messages = $messaging_account->receivedMessages()->where('type_message', '=', 'alert')->get();

        return $messages;
    }
}
