@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4>🤖 Assistant Écologique IA</h4>
            </div>
            <div class="card-body">
                <div id="messages" style="height:400px;overflow-y:auto;border:1px solid #ddd;border-radius:8px;padding:15px;margin-bottom:15px">
                    <div class="text-center text-muted">
                        <p>Bonjour ! Je suis votre assistant écologique. Posez-moi vos questions ! 🌿</p>
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" id="question" class="form-control form-control-lg"
                           placeholder="Ex: Comment réduire mon CO₂ ?">
                    <button onclick="envoyerQuestion()" class="btn btn-success">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function envoyerQuestion() {
    const question = document.getElementById('question').value.trim();
    if (!question) return;

    const messages = document.getElementById('messages');
    messages.innerHTML += `<div class="text-end mb-2"><span class="badge bg-success p-2">${question}</span></div>`;
    messages.innerHTML += `<div class="mb-2"><span class="badge bg-light text-dark p-2">🤖 En train de réfléchir...</span></div>`;
    document.getElementById('question').value = '';
    messages.scrollTop = messages.scrollHeight;

    fetch('/ai/chatbot', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ question })
    })
    .then(r => r.json())
    .then(data => {
        const lastMsg = messages.lastElementChild;
        lastMsg.innerHTML = `<span class="badge bg-light text-dark p-2" style="white-space:pre-wrap;text-align:left">🌿 ${data.reponse}</span>`;
        messages.scrollTop = messages.scrollHeight;
    });
}

document.getElementById('question').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') envoyerQuestion();
});
</script>
@endsection
