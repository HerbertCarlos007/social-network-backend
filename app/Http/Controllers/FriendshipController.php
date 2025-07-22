<?php

namespace App\Http\Controllers;

use App\Enums\FriendshipStatus;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\get;

class FriendshipController extends Controller
{
    public function getAllFriends()
    {
        $requests = Friendship::with('user')
            ->where('status', FriendshipStatus::ACCEPTED)
            ->get();

        return response()->json($requests);
    }

    public function getNonFriends()
    {
        $userId = auth()->id();

        $friends = DB::table('friendships')
            ->select('friend_id as id')
            ->where('status', FriendshipStatus::ACCEPTED)
            ->where('user_id', $userId)
            ->union(
                DB::table('friendships')
                    ->select('user_id as id')
                    ->where('status', FriendshipStatus::ACCEPTED)
                    ->where('friend_id', $userId)
            )
            ->pluck('id');

        $nonFriends = DB::table('users')
            ->where('id', '!=', $userId)
            ->whereNotIn('id', $friends)
            ->get();

        return response()->json($nonFriends);
    }

    public function getFriendRequests()
    {
        $userId = auth()->id();

        $requests = Friendship::with('user')
            ->where('friend_id', $userId)
            ->where('status', FriendshipStatus::PENDING)
            ->get();

        return response()->json($requests);
    }

    public function sendFriendRequest($toUserId)
    {
        $fromUserId = auth()->id();

        if ($fromUserId == $toUserId) {
            return response()->json(['message' => 'Você não pode se adicionar.'], 400);
        }

        $exists = Friendship::whereIn('user_id', [$fromUserId, $toUserId])
            ->whereIn('friend_id', [$fromUserId, $toUserId])
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Pedido já enviado ou amizade existente.'], 400);
        }

        Friendship::create([
            'user_id' => $fromUserId,
            'friend_id' => $toUserId,
            'status' => FriendshipStatus::PENDING
        ]);

        return response()->json(['message' => 'Pedido enviado com sucesso.']);
    }

    public function acceptFriendRequest($senderId)
    {
        $receiverId = auth()->id();

        $friendship = Friendship::where('user_id', $senderId)
            ->where('friend_id', $receiverId)
            ->where('status', FriendshipStatus::PENDING)
            ->first();

        if (!$friendship) {
            return response()->json(['message' => 'Pedido não encontrado ou já aceito.'], 404);
        }

        $friendship->status = FriendshipStatus::ACCEPTED;
        $friendship->save();

        return response()->json(['message' => 'Pedido aceito com sucesso.']);
    }

    public function rejectFriendRequest($senderId)
    {
        $receiverId = auth()->id();

        $friendship = Friendship::where('user_id', $senderId)
            ->where('friend_id', $receiverId)
            ->where('status', FriendshipStatus::PENDING)
            ->first();

        if (!$friendship) {
            return response()->json(['message' => 'Pedido não encontrado ou já rejeitado.'], 404);
        }

        $friendship->status = FriendshipStatus::REJECTED;
        $friendship->save();

        return response()->json(['message' => 'Pedido rejeitado com sucesso.']);
    }

    public function deleteFriend($senderId)
    {
        $receiverId = auth()->id();

        $friendship = Friendship::where('user_id', $senderId)
            ->where('friend_id', $receiverId)
            ->where('status', FriendshipStatus::ACCEPTED)
            ->first();

        if (!$friendship) {
            return response()->json(['message' => 'Amizade não encontrada.'], 404);
        }

        $friendship->delete();

        return response()->json(['message' => 'Amizade deletada com sucesso.']);
    }
}
