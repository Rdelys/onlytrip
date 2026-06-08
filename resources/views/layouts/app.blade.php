<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'OnlyTrip')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg:      #f8f9fc;
            --surface: #ffffff;
            --blue:    #3b82f6;
            --blue-dk: #1d4ed8;
            --dark:    #0a0a0f;
            --muted:   #6b7280;
            --border:  #e5e7eb;
        }

        * { box-sizing: border-box; }

        body {
            background: var(--bg);
            font-family: 'Nunito', sans-serif;
            color: var(--dark);
            padding-top: 80px;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: #ffffff !important;
            height: 80px;
            position: fixed !important;
            top: 0; left: 0; right: 0;
            z-index: 1030;
            border-bottom: 1px solid var(--border);
            transition: box-shadow 0.3s;
        }
        .navbar.scrolled {
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
        }

        .navbar-logo {
            height: 56px;
            width: auto;
            object-fit: contain;
        }

        /* Menu de navigation */
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .nav-menu li a {
            font-family: 'Nunito', sans-serif;
            font-size: 0.9375rem;
            font-weight: 600;
            color: var(--dark);
            text-decoration: none;
            transition: color 0.2s;
            padding: 8px 0;
            position: relative;
            cursor: pointer;
        }

        .nav-menu li a:hover {
            color: var(--blue);
        }

        /* Boutons */
        .btn-connexion {
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--muted);
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 100px;
            padding: 8px 22px;
            transition: all 0.2s;
        }
        .btn-connexion:hover {
            color: var(--dark);
            border-color: #9ca3af;
        }

        .btn-inscription {
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            color: #ffffff;
            background: var(--blue);
            border: none;
            border-radius: 100px;
            padding: 9px 24px;
            transition: background 0.2s;
        }
        .btn-inscription:hover { background: var(--blue-dk); }

        .btn-profile {
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--dark);
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 100px;
            padding: 8px 22px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-profile:hover {
            border-color: var(--blue);
            color: var(--blue);
        }

        .btn-deconnexion {
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            color: #ef4444;
            background: transparent;
            border: 1px solid #fecaca;
            border-radius: 100px;
            padding: 8px 22px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-deconnexion:hover {
            background: #fef2f2;
            border-color: #fca5a5;
        }

        /* Dropdown menu */
        .dropdown-menu-custom {
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.1);
            padding: 8px 0;
            margin-top: 8px;
        }

        .dropdown-menu-custom .dropdown-item {
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem;
            padding: 10px 20px;
            transition: background 0.2s;
            cursor: pointer;
        }

        .dropdown-menu-custom .dropdown-item:hover {
            background: #f3f4f6;
        }

        .dropdown-menu-custom .dropdown-item i {
            width: 20px;
            margin-right: 10px;
            color: var(--muted);
        }

        @media (max-width: 992px) {
            .nav-menu {
                gap: 1rem;
            }
            .nav-menu li a {
                font-size: 0.8125rem;
            }
        }

        @media (max-width: 768px) {
            .navbar .container {
                flex-wrap: wrap;
            }
            .nav-menu {
                order: 3;
                width: 100%;
                justify-content: center;
                margin-top: 12px;
                padding-bottom: 8px;
            }
            body {
                padding-top: 120px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar" id="mainNav">
    <div class="container d-flex align-items-center justify-content-between">
        
        {{-- Logo --}}
        <a href="#">
            <img src="{{ asset('logo.png') }}" alt="OnlyTrip" class="navbar-logo">
        </a>

        {{-- Menu de navigation --}}
        <ul class="nav-menu">
            <li><a href="#" onclick="showPage('accueil')">Accueil</a></li>
            <li><a href="#" onclick="showPage('locaux')">Nos Locaux</a></li>
            <li><a href="#" onclick="showPage('services')">Services</a></li>
        </ul>

        {{-- Boutons selon authentification --}}
        <div class="d-flex align-items-center gap-2">
            @auth
                {{-- Utilisateur connecté --}}
                <div class="dropdown">
                    <button class="btn-profile dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-user"></i> {{ Auth::user()->name ?? 'Mon compte' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-custom dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#" onclick="showPage('profil')">
                                <i class="fa-regular fa-id-card"></i> Mon profil
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="showPage('reservations')">
                                <i class="fa-regular fa-calendar-check"></i> Mes réservations
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#" onclick="deconnexion()">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                {{-- Utilisateur non connecté --}}
                <button class="btn-connexion" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="fa-regular fa-user"></i> Connexion
                </button>
                <button class="btn-inscription" data-bs-toggle="modal" data-bs-target="#registerModal">
                    <i class="fa-regular fa-pen-to-square"></i> Inscription
                </button>
            @endauth
        </div>

    </div>
</nav>

<div class="container">
    @yield('content')
</div>

@include('layouts.footer') 
@include('auth.modals')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Navbar scroll effect
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        if (nav) {
            nav.classList.toggle('scrolled', window.scrollY > 10);
        }
    });

    // Fonctions de navigation sans route
    function showPage(page) {
        if(page === 'accueil') {
            // Recharger la page d'accueil ou afficher via AJAX
            location.reload();
        } else if(page === 'locaux') {
            alert('Page "Nos Locaux" - À venir');
        } else if(page === 'services') {
            alert('Page "Services" - À venir');
        } else if(page === 'profil') {
            alert('Page "Mon profil" - À venir');
        } else if(page === 'reservations') {
            alert('Page "Mes réservations" - À venir');
        }
    }

    function deconnexion() {
        if(confirm('Voulez-vous vraiment vous déconnecter ?')) {
            // Formulaire de déconnexion
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '#';
            form.innerHTML = '@csrf<input type="hidden" name="_method" value="POST">';
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
</body>
</html>