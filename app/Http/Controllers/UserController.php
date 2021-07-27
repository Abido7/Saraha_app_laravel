<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index($id)
    {

        $user = User::findOrFail($id);

        return view('user/publicProfile', ['user' => $user]);
    }

    public function details($id)
    {
        $user = User::findOrFail($id);
        return view('user/profile', ['user' => $user]);
    }
}