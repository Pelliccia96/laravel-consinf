@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="text-center pt-2 mt-4">
        <h1 class="text-dark">CONSENSO INFORMATO</h1>
    </div>
    <div class="pt-2 mt-4">
        <h2 class="text-dark">Dati del Paziente:</h2>
    </div>
    {{-- Validazione Dati / Client Side --}}
    <div id="error-container" class="alert alert-danger" style="display: none;">
        <ul id="error-list">
        </ul>
    </div>
    {{-- Validazione Dati / Server Side --}}
    @if($errors->any())
    <div>
        <div class="alert alert-danger">I dati inseriti non sono validi:
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ is_array($error) ? '' : htmlspecialchars($error) }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="d-flex justify-content-center gap-3 mt-5">
        <h5 class="text-dark">Medico di riferimento:</h5>
        <p class="fw-semibold"><i>{{ $user->name }} - {{ $user->department->department }}</i></p>
    </div>
    <div>
        <form id="consent-form" action="{{ route('patients.store') }}" method="POST" class="p-5"
            enctype="multipart/form-data">
            @csrf

            <div class="d-flex justify-content-center gap-5">
                <div class="mb-4 col-md-4">
                    <label class="form-label">Cognome*: </label>
                    <input type="text" id="surname" name="surname"
                        class="form-control @error('surname') is-invalid @enderror"
                        value="{{ $errors->has('surname') ? '' : old('surname') }}">
                    @error('surname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-4">
                    <label class="form-label">Nome*: </label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ $errors->has('name') ? '' : old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-2">
                    <label class="form-label">Data di nascita*: </label>
                    <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror"
                        value="{{ $errors->has('date') ? '' : (old('date') ? old('date') : '') }}">
                    @error('date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-center gap-5">
                <div class="mb-4 col-md-2">
                    <label class="form-label">Comune di nascita*: </label>
                    <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror"
                        value="{{ $errors->has('city') ? '' : old('city') }}">
                    @error('city')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-3">
                    <label class="form-label">Codice Fiscale*: </label>
                    <input type="text" id="cf" name="cf" class="form-control @error('cf') is-invalid @enderror"
                        value="{{ $errors->has('cf') ? '' : old('cf') }}">
                    @error('cf')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-3">
                    <label class="form-label">N° Tessera Sanitaria: </label>
                    <input type="text" id="ts" name="ts" class="form-control @error('ts') is-invalid @enderror"
                        value="{{ $errors->has('ts') ? '' : (old('ts') ? old('ts') : '') }}">
                    @error('ts')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-2">
                    <label class="form-label">Scadenza: </label>
                    <input type="date" id="expiry" name="expiry"
                        class="form-control @error('expiry') is-invalid @enderror"
                        value="{{ $errors->has('expiry') ? '' : old('expiry') }}">
                    @error('expiry')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-center gap-5">
                <div class="mb-4 col-md-4">
                    <label class="form-label">Residenza*: </label>
                    <input type="text" id="address" name="address"
                        class="form-control @error('address') is-invalid @enderror"
                        value="{{ $errors->has('address') ? '' : old('address') }}">
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-1">
                    <label class="form-label">CAP*: </label>
                    <input type="text" id="cap" name="cap" class="form-control @error('cap') is-invalid @enderror"
                        value="{{ $errors->has('cap') ? '' : old('cap') }}">
                    @error('cap')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-2">
                    <label class="form-label">Telefono*: </label>
                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        value="{{ $errors->has('phone') ? '' : old('phone') }}">
                    @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-3">
                    <label class="form-label">E-mail: </label>
                    <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ $errors->has('email') ? '' : old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="mb-4 col-md-12">
                <label class="form-label">Categoria diagnostica &#x2768;MDC&#x2769;*:</label>
                <div class="d-flex flex-wrap">
                    @foreach($categories as $category)
                    <div class="form-check me-4 mb-2">
                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}"
                            id="category_{{ $category->id }}">
                        <label class="form-check-label" for="category_{{ $category->id }}">
                            {{ $category->category }}
                        </label>
                    </div>
                    @endforeach
                </div>
                @error('categories')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-flex justify-content-center my-5 py-5">
                <div class="mb-4 col-md-11">
                    <label class="form-label fw-bold fs-4"><i>Autorizzazione al trattamento sanitario:</i></label>
                    <div class="form-check d-flex align-items-center gap-3">
                        <input class="form-check-input fs-3" type="checkbox" id="consent" name="consent" id="consent">
                        <label class="form-check-label fw-semibold fs-5" for="consent">
                            Ho preso visione del Consenso Informato, dichiaro di averlo compreso e accettato nel pieno
                            delle mie facoltà.*
                        </label>
                    </div>
                    @error('consent')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="my-5 text-center">
                <button type="submit" class="btn btn-primary me-5 p-4 px-5 fw-semibold">Firma e Salva</button>
                <a class="btn btn-secondary p-4 px-5" href="{{ url('dashboard') }}">Annulla</a>
            </div>
        </form>
    </div>
</div>
<script>
    // Validazione Client Side
$(document).ready(function() {
    // Gestisci l'invio del modulo
    $('#consent-form').submit(function(event) {
        event.preventDefault(); // Impedisce l'invio del modulo

        // Nascondi gli errori precedenti
        $('#error-container').hide();
        $('#error-list').empty();

        // Esegui la validazione dei campi
        var errors = [];

        // Validazione del campo Cognome
        var surname = $('#surname').val();
        if (!surname) {
            errors.push("Il Cognome è obbligatorio.");
            $('#surname').addClass('is-invalid');
        } else if (surname.length > 255) {
            errors.push("Il Cognome può contenere al massimo 255 caratteri.");
            $('#surname').addClass('is-invalid');
        }

        // Validazione del campo Nome
        var name = $('#name').val();
        if (!name) {
            errors.push("Il Nome è obbligatorio.");
            $('#name').addClass('is-invalid');
        } else if (name.length > 255) {
            errors.push("Il Nome può contenere al massimo 255 caratteri.");
            $('#name').addClass('is-invalid');
        }

        // Validazione del campo Data di nascita
        var date = $('#date').val();
        if (!date) {
            errors.push("La Data di Nascita è obbligatoria.");
            $('#date').addClass('is-invalid');
        }

        // Validazione del campo Comune di nascita
        var city = $('#city').val();
        if (!city) {
            errors.push("Il Comune di nascita è obbligatorio.");
            $('#city').addClass('is-invalid');
        } else if (city.length > 255) {
            errors.push("Il Comune di nascita può contenere al massimo 255 caratteri.");
            $('#city').addClass('is-invalid');
        }

        // Validazione del campo Codice Fiscale
        var cf = $('#cf').val();
        if (!cf) {
            errors.push("Il Codice Fiscale è obbligatorio.");
            $('#cf').addClass('is-invalid');
        } else if (cf.length !== 16) {
            errors.push("Il Codice Fiscale deve contenere esattamente 16 caratteri alfanumerici.");
            $('#cf').addClass('is-invalid');
        }

        // Validazione del campo N° Tessera Sanitaria
        var ts = $('#ts').val();
        var regex = /^[0-9]{20}$/; // Espressione regolare per verificare che ci siano solo numeri e 20 caratteri
        if (ts && !regex.test(ts)) {
            errors.push("La Tessera Sanitaria deve contenere esattamente 20 caratteri numerici.");
            $('#ts').addClass('is-invalid');
        }

        // Validazione del campo Scadenza
        var expiry = $('#expiry').val();
        if (expiry) {
            var today = new Date().toISOString().split('T')[0];
            if (expiry < today) {
                errors.push("La Data di Scadenza deve essere una data futura.");
                $('#expiry').addClass('is-invalid');
            }
        }

        // Validazione del campo Residenza
        var address = $('#address').val();
        if (!address) {
            errors.push("La Residenza è obbligatoria.");
            $('#address').addClass('is-invalid');
        } else if (address.length > 255) {
            errors.push("La Residenza può contenere al massimo 255 caratteri.");
            $('#address').addClass('is-invalid');
        }

        // Validazione del campo CAP
        var cap = $('#cap').val();
        if (!cap) {
            errors.push("Il CAP è obbligatorio.");
            $('#cap').addClass('is-invalid');
        } else if (cap.length !== 5) {
            errors.push("Il CAP deve contenere esattamente 5 caratteri numerici.");
            $('#cap').addClass('is-invalid');
        }

        // Validazione del campo Telefono
        var phone = $('#phone').val();
        if (!phone) {
            errors.push("Il Telefono è obbligatorio.");
            $('#phone').addClass('is-invalid');
        } else if (phone.length !== 10) {
            errors.push("Il Telefono deve contenere esattamente 10 caratteri numerici.");
            $('#phone').addClass('is-invalid');
        }

        // Validazione del campo Email
        var email = $('#email').val();
        if (email && !/.*@.*/.test(email)) {
            errors.push("L'email non è valida, deve contenere la @.");
            $('#email').addClass('is-invalid');
        }

        // Validazione delle categorie
        var selectedCategories = $('input[name="categories[]"]:checked');
        if (selectedCategories.length === 0) {
            errors.push("Devi selezionare almeno una categoria.");
            $('input[name="categories[]"]').addClass('is-invalid');
        } else {
            $('input[name="categories[]"]').removeClass('is-invalid');
        }

        // Validazione del campo Autorizzazione al trattamento sanitario
        var consent = $('#consent').is(':checked');
        if (!consent) {
            errors.push("Devi accettare l'Autorizzazione al trattamento sanitario per procedere.");
            $('#consent').addClass('is-invalid');
        }

        // Scroll verso l'inizio della pagina se ci sono errori
        if (errors.length > 0) {
            var errorList = $('#error-list');
            for (var i = 0; i < errors.length; i++) {
                errorList.append('<li>' + errors[i] + '</li>');
            }
            $('#error-container').show();

            // Scroll verso l'inizio della pagina
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        } else {
            // Invia il modulo
            this.submit();
        }
    });
});
</script>
@endsection