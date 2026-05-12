<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zéro Déchet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { background: #f0f7f0; }

        .navbar {
            background: linear-gradient(135deg, #1a6b3c 0%, #2d9e5f 100%) !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            padding: 12px 0;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .nav-link {
            font-weight: 500;
            transition: all 0.3s;
            border-radius: 20px;
            padding: 6px 14px !important;
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-1px);
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        .card-header {
            border-radius: 16px 16px 0 0 !important;
            padding: 16px 20px;
            font-weight: 600;
        }

        .btn-success {
            background: linear-gradient(135deg, #1a6b3c, #2d9e5f);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(45,158,95,0.3);
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(45,158,95,0.4);
        }

        .stat-card {
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
        }
        .stat-card h3 { font-size: 2rem; font-weight: 700; margin: 0; }
        .stat-card p { margin: 5px 0 0; opacity: 0.9; font-weight: 500; }

        .alert { border-radius: 12px; border: none; }
        .badge { border-radius: 20px; padding: 6px 12px; }

        .container { padding-top: 30px; padding-bottom: 30px; }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a6b3c;
            margin-bottom: 25px;
        }

        footer {
            background: linear-gradient(135deg, #1a6b3c, #2d9e5f);
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 50px;
            font-weight: 500;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand text-white" href="/">🌿 Zéro Déchet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto gap-1">
                @auth
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard') }}">🏠 Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('scanner.index') }}">📱 Scanner</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('produits.index') }}">🛒 Produits</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('defis.index') }}">⚡ Défis</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('badges.index') }}">🎖️ Badges</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('stats.index') }}">📊 Stats</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('messages.index') }}">💬 Messages</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="#" data-bs-toggle="dropdown">🤖 IA</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('ai.chatbot') }}">💬 Chatbot</a></li>
                            <li><a class="dropdown-item" href="{{ route('ai.rapport') }}">📊 Rapport</a></li>
                            <li><a class="dropdown-item" href="{{ route('ai.defis') }}">🎯 Défis IA</a></li>
                            <li><a class="dropdown-item" href="{{ route('ai.empreinte') }}">🌍 Empreinte</a></li>
                        </ul>
                    </li>
                    @if(auth()->user()->is_admin)
                        <li class="nav-item"><a class="nav-link text-warning fw-bold" href="{{ route('admin.dashboard') }}">⚙️ Admin</a></li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm rounded-pill ms-2">Déconnexion</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success shadow-sm">✅ {{ session('success') }}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning shadow-sm">⚠️ {{ session('warning') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow-sm">❌ {{ session('error') }}</div>
    @endif
    @yield('content')
</div>

<footer>
    🌿 Zéro Déchet &copy; 2026 — Pour une planète plus verte 🌍
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!-- Lamis Oueslati - Design UI UX Bootstrap Animations -->
