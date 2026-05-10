<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zéro Déchet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0a3d1f 0%, #1a6b3c 50%, #2d9e5f 100%);
            display: flex; align-items: center; justify-content: center;
        }
        .main-container { width: 100%; max-width: 1100px; padding: 20px; }
        .hero { color: white; padding: 40px 0; }
        .hero h1 { font-size: 3rem; font-weight: 700; margin-bottom: 15px; }
        .hero p { font-size: 1.2rem; opacity: 0.9; margin-bottom: 30px; }
        .features { display: flex; gap: 20px; margin-bottom: 40px; flex-wrap: wrap; }
        .feature { background: rgba(255,255,255,0.15); border-radius: 16px; padding: 20px; flex: 1; min-width: 150px; text-align: center; color: white; }
        .feature .icon { font-size: 2rem; margin-bottom: 10px; }
        .feature p { margin: 0; font-size: 0.9rem; font-weight: 500; }
        .login-card {
            background: white; border-radius: 24px;
            padding: 40px; box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        }
        .login-card h3 { color: #1a6b3c; font-weight: 700; margin-bottom: 25px; text-align: center; }
        .form-control {
            border: 2px solid #e9ecef; border-radius: 12px;
            padding: 12px 16px; transition: all 0.3s;
        }
        .form-control:focus { border-color: #2d9e5f; box-shadow: 0 0 0 4px rgba(45,158,95,0.1); }
        .btn-login {
            background: linear-gradient(135deg, #1a6b3c, #2d9e5f);
            border: none; border-radius: 12px; padding: 13px;
            font-weight: 600; width: 100%; color: white;
            transition: all 0.3s; box-shadow: 0 6px 20px rgba(45,158,95,0.35);
        }
        .btn-login:hover { transform: translateY(-2px); color: white; }
        .btn-register {
            background: transparent; border: 2px solid #1a6b3c;
            border-radius: 12px; padding: 12px;
            font-weight: 600; width: 100%; color: #1a6b3c;
            transition: all 0.3s; margin-top: 10px;
        }
        .btn-register:hover { background: #f0f7f0; transform: translateY(-2px); }
        .divider { text-align: center; color: #adb5bd; margin: 15px 0; font-size: 0.85rem; }
        .alert { border-radius: 12px; border: none; }
        .leaf { position: fixed; font-size: 1.5rem; opacity: 0.1; animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }
    </style>
</head>
<body>
    <span class="leaf" style="top:10%;left:5%;animation-delay:0s">🌿</span>
    <span class="leaf" style="top:20%;right:8%;animation-delay:1s">🍃</span>
    <span class="leaf" style="bottom:15%;left:10%;animation-delay:2s">🌱</span>
    <span class="leaf" style="bottom:25%;right:5%;animation-delay:3s">🌿</span>

    <div class="main-container">
        <div class="row align-items-center g-5">
            <!-- Hero gauche -->
            <div class="col-lg-6">
                <div class="hero">
                    <div style="font-size:3rem;margin-bottom:15px">🌿</div>
                    <h1>Zéro Déchet</h1>
                    <p>Scannez vos produits, découvrez leur impact écologique et adoptez des alternatives durables !</p>
                    <div class="features">
                        <div class="feature">
                            <div class="icon">📱</div>
                            <p>Scanner produits</p>
                        </div>
                        <div class="feature">
                            <div class="icon">🌍</div>
                            <p>Réduire CO₂</p>
                        </div>
                        <div class="feature">
                            <div class="icon">🏆</div>
                            <p>Gagner points</p>
                        </div>
                        <div class="feature">
                            <div class="icon">🤖</div>
                            <p>IA écologique</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire droite -->
            <div class="col-lg-6">
                <div class="login-card">
                    <h3>🌿 Bienvenue !</h3>

                    @if($errors->any())
                        <div class="alert alert-danger mb-3">
                            @foreach($errors->all() as $error)
                                <p class="mb-0">❌ {{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success mb-3">✅ {{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">📧 Email</label>
                            <input type="email" name="email" class="form-control"
                                   placeholder="votre@email.com" required value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">🔒 Mot de passe</label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="••••••••" required>
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label text-muted" for="remember">Se souvenir de moi</label>
                        </div>
                        <button type="submit" class="btn-login">🚀 Se connecter</button>
                    </form>

                    <div class="divider">— Nouveau sur Zéro Déchet ? —</div>

                    <a href="{{ route('register') }}" class="btn-register d-block text-center text-decoration-none">
                        🌱 Créer un compte gratuit
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
