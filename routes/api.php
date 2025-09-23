<?php

use App\Http\Controllers\AboutProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/user-posts', [PostController::class, 'userPosts']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);

    Route::post('/likes', [LikeController::class, 'store']);

    Route::post('/comments', [CommentController::class, 'store']);
    Route::get('/comments', [CommentController::class, 'index']);
    Route::get('/comments/{comment}', [CommentController::class, 'show']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

    Route::get('/friends', [FriendshipController::class, 'getAllFriends']);
    Route::get('/non-friends', [FriendshipController::class, 'getNonFriends']);
    Route::post('/friend-request/send/{toUserId}', [FriendshipController::class, 'sendFriendRequest']);
    Route::post('/friend-request/accept/{senderId}', [FriendshipController::class, 'acceptFriendRequest']);
    Route::post('/friend-request/reject/{senderId}', [FriendshipController::class, 'rejectFriendRequest']);
    Route::delete('/friend-delete/{senderId}', [FriendshipController::class, 'deleteFriend']);
    Route::get('/friend-requests', [FriendshipController::class, 'getFriendRequests']);

    Route::post('/about-me', [AboutProfileController::class, 'store']);
    Route::get('/about-me', [AboutProfileController::class, 'index']);

});
