<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Auth::user();
        
        $user_id = auth()->user()->id;
        $patients = Patient::where('user_id', $user_id)
            ->orderBy('created_at')
            ->get();

        if(Auth::user()->email == 'admin@gmail.com') {
            $users = User::all();
            $patients = Patient::all();
        }

        return view('dashboard', compact('patients', 'users'));
    }
}
