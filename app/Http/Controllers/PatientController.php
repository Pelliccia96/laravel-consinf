<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\StoreSignatureRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Category;
use App\Models\Patient;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PatientController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('patients.create', compact('user', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $data = $request->validated();

        // La checkbox non restitusci un boolean -> elaborazione dati
        $data["consent"] = ($data["consent"] == "on" ? true : false);

        $patient = Patient::create($data);

        // Associa il dottore attualmente loggato al paziente
        $user = Auth::user();
        $patient->user()->associate($user);

        $patient->save();

        // Associa le categorie al paziente
        if (isset($data['categories'])) {
            $patient->categories()->attach($data['categories']);
        }

        return view('patients.signature', compact('patient'));
    }

    public function storeSignature(StoreSignatureRequest $request, Patient $patient)
    {
        // Recupera l'immagine della firma dal campo "signature_image"
        $signatureImage = $request->input('signature_image');

        // Salva l'immagine della firma nel database associandola al paziente
        $signature = Signature::create([
            'signature' => $signatureImage
        ]);
        
        $patient->signature()->associate($signature);
        $patient->save();

        // Imposta il messaggio di successo nella sessione
        Session::flash('success_message', 'Registrazione avvenuta con successo!');

        // Esegui il redirect a patients.show dopo aver salvato la firma
        return redirect()->route('patients.show', ['patient' => $patient->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $users = User::all();
        $categories = Category::all();

        $user_id = auth()->user()->id;
        $patients = Patient::where('user_id', $user_id)
            ->orderBy('created_at')
            ->get();

        if (Auth::user()->email == 'admin@gmail.com') {
            $patients = Patient::all();
        }

        return view("patients.show", compact('patients', 'users', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $user = Auth::user();

        // Verifica se l'utente loggato è autorizzato a modificare il paziente O se è un admin
        if ($patient->user_id !== $user->id && $user->email !== 'admin@gmail.com') {
            abort(403, 'Unauthorized'); // Ritorna un errore di accesso negato
        }

        return view("patients.edit", compact('user', 'patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        // Verifica se l'utente loggato è autorizzato a modificare il paziente O se è un admin
        if ($patient->user_id !== auth()->user()->id && auth()->user()->email !== 'admin@gmail.com') {
            abort(403, 'Unauthorized'); // Ritorna un errore di accesso negato
        }

        $data = $request->validated();

        // La checkbox non restitusci un boolean -> elaborazione dati
        $data["consent"] = ($data["consent"] == "on" ? true : false);

        $patient->update($data);

        // Imposta il messaggio di successo nella sessione
        Session::flash('success_message', 'Aggiornamento avvenuto con successo!');

        return redirect()->route('patients.show', $patient->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        // Verifica se l'utente loggato è autorizzato a eliminare il paziente O se è un admin
        if ($patient->user_id !== auth()->user()->id && auth()->user()->email !== 'admin@gmail.com') {
            abort(403, 'Unauthorized'); // Ritorna un errore di accesso negato
        }

        $patient->delete();

        // Imposta il messaggio di successo nella sessione
        Session::flash('success_message', 'Paziente eliminato con successo!');

        return redirect()->route('dashboard');
    }
}
