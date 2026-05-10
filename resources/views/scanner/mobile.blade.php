<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner - Zéro Déchet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4 text-center">
    <h4 class="text-success">🌿 Scanner un produit</h4>
    <p class="text-muted">Pointez la caméra vers le code-barres</p>
    <div id="reader" style="width:100%"></div>
    <div id="msg" class="mt-3"></div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
<script>
const html5QrCode = new Html5Qrcode("reader");
html5QrCode.start(
    { facingMode: "environment" },
    { fps: 10, qrbox: { width: 250, height: 150 } },
    (code) => {
        html5QrCode.stop();
        document.getElementById('msg').innerHTML =
            '<div class="alert alert-success">✅ Code : <strong>' + code + '</strong><br>Envoi au PC...</div>';
        fetch('/scanner/send-code', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ token: '{{ $token }}', code_barre: code })
        }).then(r => r.json()).then(() => {
            document.getElementById('msg').innerHTML =
                '<div class="alert alert-success">✅ Résultat envoyé au PC !</div>';
        });
    }
);
</script>
</body>
</html>
