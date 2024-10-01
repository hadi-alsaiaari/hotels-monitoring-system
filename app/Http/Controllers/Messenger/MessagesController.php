<?php

namespace App\Http\Controllers\Messenger;

use Throwable;
use App\Models\HotelUser;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\TouristPolice;
use App\Events\MessageCreated;
use Illuminate\Validation\Rule;
use App\Models\MessagingAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $user = Auth::user();
        $messaging_account = MessagingAccount::getMessagingAccount($user);
        $conversation = $messaging_account->conversations()->findOrFail($id);
        return $conversation->messages()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => ['required'],
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
        DB::beginTransaction();
        try {
            $conversation = $messaging_account->conversations()->findOrFail($conversation_id);
            if ($conversation_id == 1 || $conversation_id == 2) {
                if ($messaging_account->type == 'tourism_office' || $messaging_account->type == 'tourist_police') {
                $conversation = $messaging_account->conversations()->findOrFail($conversation_id);
                } else {
                    abort(403);
                }
            }
            if (class_basename($user) != 'HotelUser') {
                // $this->authorize('messenger.use');
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
            Broadcast(new MessageCreated($messagable->body));

            // dd($messagable);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->back();
    }
}
