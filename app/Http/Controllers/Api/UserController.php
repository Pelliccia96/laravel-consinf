<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // metodo 'select' per specificare i campi che si desidera ottenere
        $users = User::select('id', 'name', 'email')->get();

        return response()->json(['users' => $users], 200);
    }
}
