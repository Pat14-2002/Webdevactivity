<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // gets all users from DB
        return view('index', compact('users')); // passes data to the view
    }
}
