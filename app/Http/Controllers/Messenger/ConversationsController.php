<?php

namespace App\Http\Controllers\Messenger;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\MessagingAccount;
use App\Models\TouristPolice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $messaging_account = MessagingAccount::getMessagingAccount($user);
        return $messaging_account->conversations()->paginate();
    }

    public function show($id)
    {
        $user = Auth::user();
        $messaging_account = MessagingAccount::getMessagingAccount($user);
        $conversation = $messaging_account->conversations()->findOrFail($id);
        return $conversation->load('participants');
    }
}
