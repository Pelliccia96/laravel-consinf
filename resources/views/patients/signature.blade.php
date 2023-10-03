@extends('layouts.app')

@section('content')
<div class="container my-5">
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
    <div>
        <form id="consent-form" action="{{ route('patients.signature', ['patient' => $patient->id]) }}" method="POST" class="p-5" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="text-center fw-semibold mb-2">Firma*:</div>
            <div class="text-center">
                <canvas id="signature-pad" width="1200" height="550"></canvas>
            </div>

            <div class="my-5 text-center">
                <button type="submit" class="btn btn-primary p-4 px-5 fw-semibold">Salva</button>
            </div>
        </form>
    </div>
</div>
<style>
    #signature-pad {
        border: 1px solid lightgray;
    }
</style>
<script src="https://unpkg.com/signature_pad"></script>
<script>
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);

    // Aggiungi un event listener al form per salvare la firma come immagine
    var form = document.getElementById('consent-form');
    form.addEventListener('submit', function(event) {
        // Previene l'invio del form di default
        event.preventDefault();

        // Ottieni la firma come immagine base64
        var signatureImage = signaturePad.toDataURL();

        // Aggiungi un campo nascosto al form per inviare l'immagine al controller
        var signatureInput = document.createElement('input');
        signatureInput.setAttribute('type', 'hidden');
        signatureInput.setAttribute('name', 'signature_image');
        signatureInput.setAttribute('value', signatureImage);
        form.appendChild(signatureInput);

        // Invia il form
        form.submit();
    });
</script>
@endsection