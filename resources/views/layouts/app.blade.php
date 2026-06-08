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

        /* ── HERO ── */
        .hero {
            padding: 4rem 0 3rem;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -100px; right: -120px;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59,130,246,0.07) 0%, transparent 65%);
            pointer-events: none;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(59,130,246,0.08);
            border: 1px solid rgba(59,130,246,0.2);
            color: var(--blue-dk);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 100px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
        .hero-pill::before {
            content: '';
            display: inline-block;
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--blue);
        }

        .hero h1 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            color: var(--dark);
            margin-bottom: 1rem;
        }
        .hero h1 .accent { color: var(--blue); }

        .hero-sub {
            font-size: 1rem;
            font-weight: 400;
            color: var(--muted);
            line-height: 1.7;
            max-width: 460px;
            margin-bottom: 2rem;
        }

        /* ── SEARCH ── */
        .search-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 100px;
            padding: 8px 8px 8px 20px;
            max-width: 520px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .search-wrap:focus-within {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }
        .search-wrap .fa-location-dot { color: #9ca3af; }
        .search-wrap input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem;
            color: var(--dark);
        }
        .search-wrap input::placeholder { color: #9ca3af; }
        .search-wrap .btn-search {
            background: var(--blue);
            color: #ffffff;
            border: none;
            border-radius: 100px;
            padding: 8px 22px;
            font-size: 0.8125rem;
            font-weight: 700;
            font-family: 'Nunito', sans-serif;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.2s;
        }
        .search-wrap .btn-search:hover { background: var(--blue-dk); }

        /* ── CARDS ── */
        .trip-card {
            background: var(--surface) !important;
            border: 1px solid var(--border) !important;
            border-radius: 16px !important;
            overflow: hidden;
            transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
        }
        .trip-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(59,130,246,0.1) !important;
            border-color: rgba(59,130,246,0.3) !important;
        }
        .trip-card .card-img-top { height: 180px; object-fit: cover; }
        .trip-card .card-body { padding: 1rem 1.25rem; background: var(--surface); }
        .trip-card .card-label {
            font-size: 0.6875rem;
            font-weight: 700;
            color: var(--blue);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 4px;
        }
        .trip-card .card-title {
            font-size: 0.9375rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.75rem;
        }
        .trip-card .card-price {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--muted);
        }
        .trip-card .card-stars { color: #d1d5db; font-size: 0.75rem; }
        .trip-card .card-stars .filled { color: var(--blue); }
    </style>
</head>
<body>

<nav class="navbar" id="mainNav">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}">
            <img src="{{ asset('logo.png') }}" alt="OnlyTrip" class="navbar-logo">
        </a>

        <div class="d-flex align-items-center gap-2">
            <button class="btn-connexion" data-bs-toggle="modal" data-bs-target="#loginModal">
                Connexion
            </button>
            <button class="btn-inscription" data-bs-toggle="modal" data-bs-target="#registerModal">
                Inscription
            </button>
        </div>

    </div>
</nav>

<div class="container">
    @yield('content')
</div>

@include('auth.modals')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 10);
    });
</script>
</body>
</html>