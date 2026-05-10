<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zéro Déchet — Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0a3d1f 0%, #1a6b3c 50%, #2d9e5f 100%);
            display: flex; align-items: center; justify-content: center; padding: 20px;
        }
        .register-container { width: 100%; max-width: 500px; }
        .register-card {
            background: white; border-radius: 24px;
            padding: 40px; box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        }
        .logo-section { text-align: center; margin-bottom: 25px; }
        .logo-icon {
            width: 70px; height: 70px;
            background: linear-gradient(135deg, #1a6b3c, #2d9e5f);
            border-radius: 50%; display: flex; align-items: center;
            justify-content: center; font-size: 2rem;
            margin: 0 auto 12px; box-shadow: 0 10px 30px rgba(45,158,95,0.4);
        }
        .logo-section h2 { color: #1a6b3c; font-weight: 700; font-size: 1.6rem; margin: 0; }
        .logo-section p { color: #6c757d; font-size: 0.85rem; margin: 5px 0 0; }
        .form-label { font-weight: 600; color: #333; font-size: 0.88rem; }
        .form-control {
            border: 2px solid #e9ecef; border-radius: 12px;
            padding: 11px 16px; font-size: 0.93rem; transition: all 0.3s;
        }
        .form-control:focus { border-color: #2d9e5f; box-shadow: 0 0 0 4px rgba(45,158,95,0.1); }
        .form-control.is-invalid { border-color: #dc3545; }
        .form-control.is-valid { border-color: #28a745; }
        .invalid-feedback { font-size: 0.82rem; color: #dc3545; }
        .btn-register {
            background: linear-gradient(135deg, #1a6b3c, #2d9e5f);
            border: none; border-radius: 12px; padding: 13px;
            font-weight: 600; font-size: 1rem; width: 100%; color: white;
            transition: all 0.3s; box-shadow: 0 6px 20px rgba(45,158,95,0.35);
        }
        .btn-register:hover { transform: translateY(-2px); color: white; }
        .login-link { text-align: center; margin-top: 20px; font-size: 0.9rem; color: #6c757d; }
        .login-link a { color: #1a6b3c; font-weight: 600; text-decoration: none; }
        .alert { border-radius: 12px; border: none; }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="logo-section">
                <div class="logo-icon">🌿</div>
                <h2>Créer un compte</h2>
                <p>Rejoignez la communauté Zéro Déchet 🌍</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    @foreach($errors->all() as $error)
                        <p class="mb-0">❌ {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}" id="registerForm">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">👤 Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control"
                               placeholder="Ex: Ali" required
                               pattern="[A-Za-zÀ-ÿ\s\-]+"
                               title="Le prénom doit contenir uniquement des lettres"
                               value="{{ old('prenom') }}"
                               oninput="validerNom(this, 'erreurPrenom')">
                        <div class="invalid-feedback" id="erreurPrenom"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">👤 Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control"
                               placeholder="Ex: Boukhris" required
                               pattern="[A-Za-zÀ-ÿ\s\-]+"
                               title="Le nom doit contenir uniquement des lettres"
                               value="{{ old('nom') }}"
                               oninput="validerNom(this, 'erreurNom')">
                        <div class="invalid-feedback" id="erreurNom"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">📧 Email</label>
                    <input type="email" name="email" class="form-control"
                           placeholder="votre@email.com" required
                           value="{{ old('email') }}"
                           oninput="validerEmail(this)">
                    <div class="invalid-feedback" id="erreurEmail"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">🔒 Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control"
                           placeholder="Minimum 6 caractères" required
                           oninput="validerPassword(this)">
                    <div class="invalid-feedback" id="erreurPassword"></div>
                </div>
                <div class="mb-4">
                    <label class="form-label">🔒 Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control" placeholder="Répétez le mot de passe" required
                           oninput="validerConfirmation(this)">
                    <div class="invalid-feedback" id="erreurConfirmation"></div>
                </div>
                <button type="submit" class="btn-register" onclick="return validerFormulaire()">
                    🌱 Créer mon compte
                </button>
            </form>

            <div class="login-link">
                Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
            </div>
        </div>
    </div>

<script>
function validerNom(input, erreurId) {
    const regex = /^[A-Za-zÀ-ÿ\s\-]+$/;
    const erreur = document.getElementById(erreurId);
    if (!regex.test(input.value)) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        erreur.textContent = '❌ Uniquement des lettres (pas de chiffres)';
        input.value = input.value.replace(/[^A-Za-zÀ-ÿ\s\-]/g, '');
    } else if (input.value.length < 2) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        erreur.textContent = '❌ Minimum 2 caractères';
    } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        erreur.textContent = '';
    }
}

function validerEmail(input) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regex.test(input.value)) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        document.getElementById('erreurEmail').textContent = '❌ Email invalide';
    } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        document.getElementById('erreurEmail').textContent = '';
    }
}

function validerPassword(input) {
    if (input.value.length < 6) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        document.getElementById('erreurPassword').textContent = '❌ Minimum 6 caractères';
    } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        document.getElementById('erreurPassword').textContent = '';
    }
}

function validerConfirmation(input) {
    const password = document.getElementById('password').value;
    if (input.value !== password) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        document.getElementById('erreurConfirmation').textContent = '❌ Les mots de passe ne correspondent pas';
    } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        document.getElementById('erreurConfirmation').textContent = '';
    }
}

function validerFormulaire() {
    const prenom = document.getElementById('prenom');
    const nom = document.getElementById('nom');
    const password = document.getElementById('password');
    const confirmation = document.getElementById('password_confirmation');

    validerNom(prenom, 'erreurPrenom');
    validerNom(nom, 'erreurNom');
    validerPassword(password);
    validerConfirmation(confirmation);

    if (prenom.classList.contains('is-invalid') ||
        nom.classList.contains('is-invalid') ||
        password.classList.contains('is-invalid') ||
        confirmation.classList.contains('is-invalid')) {
        return false;
    }
    return true;
}
</script>
</body>
</html>
