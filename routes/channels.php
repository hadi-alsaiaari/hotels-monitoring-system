<?php

use App\Models\MessagingAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// Broadcast::channel('Messenger.{id}', function($user,$id) {
//     $user = Auth::user();
//     if ($user->id == $id) {
//         return $user;
//     }
// });

Broadcast::channel('Messenger.{id}', function($id , $user) {
    $user = Auth::user();
    $messaging_account = MessagingAccount::getMessagingAccount($user);
    if ($messaging_account->id == $id) {
        return $messaging_account;
    }
});