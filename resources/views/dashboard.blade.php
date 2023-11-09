@extends('layouts.app')

@section('content')
@if (Session::has('success_message'))
<div class="alert alert-success">
    {{ Session::get('success_message') }}
</div>
@endif
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                @if (Auth::user()->email === 'admin@gmail.com')
                <div class="card-header">{{ __('Admin Dashboard') }}</div>
                @else
                <div class="card-header">{{ __('Doctor Dashboard') }}</div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->email == 'admin@gmail.com')
    <div class="my-5">
        <div>
            <h3 class="text-dark fw-semibold">Dottori Registrati:</h3>
        </div>
        @foreach ($users as $user)
            @unless($user->id === auth()->user()->id)
            <!-- Visualizza solo gli altri utenti -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dettagli Dottore</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-text"><strong>Nome e Cognome:</strong> {{ $user->name }} </p>
                            <p class="card-text"><strong>e-mail:</strong> {{ $user->email }} </p>
                            <p class="card-text"><strong>Telefono:</strong> {{ $user->phone }} </p>
                            <p class="card-text"><strong>Dipartimento:</strong> <i>{{ $user->department->department }}</i> </p>
                        </div>
                    </div>
                </div>
            </div>
            @endunless
        @endforeach
    </div>
    @endif
    @if(Auth::user()->email !== 'admin@gmail.com')
    <div class="row justify-content-center my-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2 class="fw-bold"><i>Consenso Informato</i></h2>
                </div>
                <div class="card-body">
                    <p class="col-md-8">Il consenso informato nel campo medico, è una forma di autorizzazione utilizzata
                        in Italia che deve essere espressa da un paziente per ricevere un qualunque trattamento
                        sanitario previa la necessaria informazione sul caso da parte del personale sanitario
                        proponente.</p>
                    <a href="{{ route('patients.create') }}" class="btn btn-dark btn-lg" type="button">Compila Form
                        Paziente</a>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($patients->count() > 0)
    <div class="my-5">
        <div>
            <h3 class="text-dark fw-semibold">Elenco Pazienti:</h3>
        </div>
        @foreach ($patients as $patient)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Dettagli Paziente</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text"><strong>Cognome:</strong> {{ $patient->surname }}</p>
                        <p class="card-text"><strong>Nome:</strong> {{ $patient->name }}</p>
                        <p class="card-text"><strong>Data di Nascita:</strong> {{
                            \Carbon\Carbon::parse($patient->date)->format('d/m/Y') }}</p>
                        <p class="card-text"><strong>Codice Fiscale:</strong> {{ $patient->cf }}</p>
                        <p class="card-text"><strong>MDC:</strong>
                            @foreach ($patient->categories as $category)
                                {{ $category->category }}.
                            @endforeach
                        </p>
                        @if($patient->ts)
                        <p class="card-text"><strong>Tessera Sanitaria:</strong> {{ $patient->ts }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <p class="card-text">
                            <strong>Dottore di riferimento:</strong>
                            @if ($patient->user) <br>
                            <span class="fw-semibold">Nome e Cognome:</span> <i>{{ $patient->user->name }}</i> <br>
                            <span class="fw-semibold">Dipartimento:</span> <i>{{ $patient->user->department->department }}</i> <br>
                            <span class="fw-semibold">Telefono:</span> <i>{{ $patient->user->phone }}</i> <br>
                            @else
                            <br>
                            Nessun dottore associato
                            @endif
                        </p>
                        <div class="d-flex gap-2">
                            <span>
                                <a href="{{ route('patients.show', $patient->id) }}"
                                    class="text-decoration-none fw-semibold text-white">
                                    <button class="btn btn-secondary"><span class="fw-semibold"><i>i</i></span></button>
                                </a>
                            </span>
                            <span>
                                <a href="{{ route('patients.edit', $patient->id) }}"
                                    class="text-decoration-none fw-semibold text-white">
                                    <button class="btn btn-secondary text-white"><span class="fw-semibold"><i>#{{ $patient->id
                                                }}</i></span></button>
                                </a>
                            </span>
                            <span>
                                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                    class="delete-form">
                                    @csrf()
                                    @method('delete')
                                    <button class="btn btn-secondary fw-bold">X</button>
                                </form>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="my-5">
            <h3 class="text-dark fw-semibold">Nessun paziente associato</h3>
        </div>
        @endif
    </div>
</div>
<script>
    // Conferma eliminazione paziente
    const forms = document.querySelectorAll(".delete-form");
    forms.forEach((form) => {
        form.addEventListener("submit", function(e) {
        e.preventDefault();
        const conferma = confirm("Sicuro?");
        if (conferma === true) {
            form.submit();
        }
        })
    })
</script>
@endsection