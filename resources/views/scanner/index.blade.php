@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 text-center">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4>📱 Scanner un produit</h4>
            </div>
            <div class="card-body">
                <p class="lead">Scannez ce QR code avec votre téléphone</p>

                <img src="https://api.qrserver.com/v1/create-qr-code/?size=280x280&data={{ urlencode('https://everyone-civic-putdown.ngrok-free.dev/scanner/mobile/' . $session->token) }}"
                     alt="QR Code" class="img-fluid border p-3 rounded my-3">

                <p class="text-muted small">⏱️ QR code valide 10 minutes</p>

                <div id="resultat" class="mt-3"></div>

                <hr>
                <p class="text-muted">Ou entre le code manuellement :</p>
                <form method="POST" action="{{ route('scanner.scan') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="code_barre" class="form-control form-control-lg"
                               placeholder="Ex: 6194013922153" inputmode="numeric">
                        <button type="submit" class="btn btn-success">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
setInterval(function() {
    fetch('/scanner/poll/{{ $session->token }}')
        .then(r => r.json())
        .then(data => {
            if (data.status === 'ok') {
                window.location.href = '/produits/' + data.code_barre;
            }
        });
}, 2000);
</script>
@endsection
