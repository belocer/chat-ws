<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::all();
        $users = UserResource::collection($users)->resolve();
        return Inertia::render('Chat/Index', [
            'users' => $users,
            'title' => 'Чаты',
        ]);
    }
}
