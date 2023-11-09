@extends('layouts.app')

@section('content')
{{--
<?php var_dump($patients) ?> --}}
<div class="container my-5">
    @if (Session::has('success_message'))
        <div class="alert alert-success">
            {{ Session::get('success_message') }}
        </div>
    @endif
    @foreach ($patients as $patient)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dettagli Paziente</h5>
            <div class="row">
                <div class="col-md-6">
                    <p class="card-text"><strong>Cognome:</strong> {{ $patient->surname }}</p>
                    <p class="card-text"><strong>Nome:</strong> {{ $patient->name }}</p>
                    <p class="card-text"><strong>Data di Nascita:</strong> {{ \Carbon\Carbon::parse($patient->date)->format('d/m/Y') }}</p>
                    <p class="card-text"><strong>Codice Fiscale:</strong> {{ $patient->cf }}</p>
                    <p class="card-text"><strong>MDC:</strong>
                        @foreach ($patient->categories as $category)
                            {{ $category->category }}.
                        @endforeach
                    </p>
                    @if($patient->ts)
                        <p class="card-text"><strong>Tessera Sanitaria:</strong> {{ $patient->ts }}</p>
                        <p class="card-text"><strong>Scadenza Tessera:</strong> {{ \Carbon\Carbon::parse($patient->expiry)->format('d/m/Y') }}</p>
                    @endif
                    @if($patient->signature)
                    <p class="card-text"><strong>Firma:</strong></p>
                        <img src="{{ $patient->signature->signature }}" alt="" width="500px">
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
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="my-5">
        <a href="{{ url('dashboard') }}" class="btn btn-dark btn-lg ms-3" type="button">Torna in Dashboard</a>
    </div>
</div>

@endsection