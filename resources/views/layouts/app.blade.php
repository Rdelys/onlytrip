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
        .navbar.scrolled { box-shadow: 0 4px 24px rgba(0,0,0,0.07); }

        .navbar-logo { height: 56px; width: auto; object-fit: contain; }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin: 0; padding: 0;
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
            cursor: pointer;
        }
        .nav-menu li a:hover { color: var(--blue); }

        /* Auth buttons */
        .btn-connexion {
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem; font-weight: 600;
            color: var(--muted); background: transparent;
            border: 1px solid var(--border); border-radius: 100px;
            padding: 8px 22px; transition: all 0.2s;
        }
        .btn-connexion:hover { color: var(--dark); border-color: #9ca3af; }

        .btn-inscription {
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem; font-weight: 700;
            color: #ffffff; background: var(--blue);
            border: none; border-radius: 100px;
            padding: 9px 24px; transition: background 0.2s;
        }
        .btn-inscription:hover { background: var(--blue-dk); }

        /* ── Profile dropdown trigger ── */
        .btn-profile {
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem; font-weight: 600;
            color: var(--dark); background: transparent;
            border: 1px solid var(--border); border-radius: 100px;
            padding: 7px 18px; transition: all 0.2s;
            display: flex; align-items: center; gap: 8px;
        }
        .btn-profile:hover { border-color: var(--blue); color: var(--blue); }

        /* Status dot */
        .status-dot {
            width: 9px; height: 9px; border-radius: 50%;
            flex-shrink: 0;
            box-shadow: 0 0 0 2px #fff;
        }
        .status-dot.actif   { background: #10b981; }
        .status-dot.inactif { background: #ef4444; }

        /* Pseudo in button */
        .profile-pseudo {
            max-width: 110px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Dropdown */
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
        .dropdown-menu-custom .dropdown-item:hover { background: #f3f4f6; }
        .dropdown-menu-custom .dropdown-item i { width: 20px; margin-right: 10px; color: var(--muted); }

        /* Status pill inside dropdown */
        .status-pill {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.75rem; font-weight: 700;
            padding: 3px 10px; border-radius: 100px;
            margin: 4px 20px 8px;
        }
        .status-pill.actif   { background: #d1fae5; color: #065f46; }
        .status-pill.inactif { background: #fee2e2; color: #991b1b; }

        @media (max-width: 992px) {
            .nav-menu { gap: 1rem; }
            .nav-menu li a { font-size: 0.8125rem; }
        }
        @media (max-width: 768px) {
            .navbar .container { flex-wrap: wrap; }
            .nav-menu { order: 3; width: 100%; justify-content: center; margin-top: 12px; padding-bottom: 8px; }
            body { padding-top: 120px; }
        }
    </style>

    @stack('styles')
</head>
<body>

<nav class="navbar" id="mainNav">
    <div class="container d-flex align-items-center justify-content-between">

        {{-- Logo --}}
        <a href="#">
            <img src="{{ asset('logo.png') }}" alt="OnlyTrip" class="navbar-logo">
        </a>

        {{-- Navigation menu --}}
        <ul class="nav-menu">
            <li><a href="{{ url('/') }}">Accueil</a></li>
            <li><a href="#" onclick="showPage('locaux')">Nos Locaux</a></li>
            <li><a href="#" onclick="showPage('services')">Services</a></li>
        </ul>

        {{-- Auth buttons --}}
        <div class="d-flex align-items-center gap-2">
            @auth
                @php
                    $user       = Auth::user();
                    $profil     = $user->profil ?? 1;
                    $isActif    = $user->status === 'actif';
                    $profilLabel= $profil == 1 ? 'Voyageur' : 'Local';
                    $profilIcon = $profil == 1 ? 'fa-plane-departure' : 'fa-house';
                    $autreLabel = $profil == 1 ? 'Local' : 'Voyageur';
                    $autreIcon  = $profil == 1 ? 'fa-house' : 'fa-plane-departure';
                    $displayName= $user->displayName();
                @endphp

                <div class="dropdown">
                    <button class="btn-profile dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">

                        {{-- Status dot: green=actif, red=inactif --}}
                        <span class="status-dot {{ $user->status }}"
                              title="{{ $isActif ? 'Profil complet' : 'Profil incomplet' }}"></span>

                        {{-- Icon + pseudo --}}
                        <i class="fa-solid {{ $profilIcon }}"></i>
                        <span class="profile-pseudo">{{ $displayName }}</span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-custom dropdown-menu-end">
 
                        {{-- Mail --}}
                        <li>
                            <span class="dropdown-item-text text-muted small px-3">
                                {{ $user->mail }}
                            </span>
                        </li>
                    
                        {{-- Status pill --}}
                        <li>
                            <span class="status-pill {{ $user->status }}">
                                <i class="fa-solid fa-circle" style="font-size:.45rem;"></i>
                                {{ $isActif ? 'Profil complet' : 'Profil incomplet' }}
                            </span>
                        </li>
                    
                        <li><hr class="dropdown-divider"></li>
                    
                        {{-- Mon profil --}}
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="fa-regular fa-id-card"></i> Mon profil
                            </a>
                        </li>
                    
                        {{-- Mes réservations --}}
                        <li>
                            <a class="dropdown-item" href="#" onclick="showPage('reservations')">
                                <i class="fa-regular fa-calendar-check"></i> Mes réservations
                            </a>
                        </li>
                    
                        {{-- ▶ Mes Services — UNIQUEMENT pour les Locaux (profil == 0) --}}
                        @if($profil == 0 && $isActif)
                            <li>
                                <a class="dropdown-item" href="{{ route('services.index') }}">
                                    <i class="fa-solid fa-briefcase"></i> Mes Services

                                    @php
                                        $nbServices = \App\Models\Service::where('user_id', $user->id)->count();
                                    @endphp

                                    @if($nbServices > 0)
                                        <span style="
                                            margin-left: 6px;
                                            background: #eff6ff;
                                            color: #1d4ed8;
                                            font-size: 0.65rem;
                                            font-weight: 800;
                                            padding: 1px 7px;
                                            border-radius: 100px;
                                            font-family: 'Nunito', sans-serif;
                                        ">
                                            {{ $nbServices }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                    
                        <li><hr class="dropdown-divider"></li>
                    
                        {{-- Changer de mode --}}
                        <li>
                            <a class="dropdown-item" href="#" onclick="switchProfil()">
                                <i class="fa-solid {{ $autreIcon }}"></i> Passer en mode {{ $autreLabel }}
                            </a>
                        </li>
                    
                        <li><hr class="dropdown-divider"></li>
                    
                        {{-- Déconnexion --}}
                        <li>
                            <a class="dropdown-item text-danger" href="#" onclick="deconnexion()">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Déconnexion
                            </a>
                        </li>
                    
                    </ul>
                </div>

                {{-- Hidden switch form --}}
                <form id="switchProfilForm" method="POST" action="{{ route('profil.switch') }}" class="d-none">
                    @csrf
                </form>

            @else
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
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        if (nav) nav.classList.toggle('scrolled', window.scrollY > 10);
    });

    function showPage(page) {
        if (page === 'accueil') { location.reload(); }
        else if (page === 'locaux')       { alert('Page "Nos Locaux" – À venir'); }
        else if (page === 'services')     { alert('Page "Services" – À venir'); }
        else if (page === 'reservations') { alert('Page "Mes réservations" – À venir'); }
    }

    function deconnexion() {
        if (confirm('Voulez-vous vraiment vous déconnecter ?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('logout') }}";
            form.innerHTML = '@csrf';
            document.body.appendChild(form);
            form.submit();
        }
    }

    function switchProfil() {
        document.getElementById('switchProfilForm').submit();
    }
</script>

@stack('scripts')
</body>
</html>