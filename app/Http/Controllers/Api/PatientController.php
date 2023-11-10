<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        // metodo 'with' per caricare anche i dati relativi all'utente e alle categorie associate ai pazienti
        $patients = Patient::with('user', 'categories')->get();

        return response()->json(['patients' => $patients], 200);
    }
}
