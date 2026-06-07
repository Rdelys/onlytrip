<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'OnlyTrip')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f7f8fc;
        }

        .navbar {
            background: #0f172a !important;
        }

        .hero {
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            color: white;
            padding: 80px 20px;
            border-radius: 20px;
        }

        .trip-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
        }

        .trip-card:hover {
            transform: translateY(-5px);
        }

        .btn-social {
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="fa-solid fa-plane-departure me-2"></i> OnlyTrip
        </a>

        <div class="ms-auto">
            <button class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                Connexion
            </button>

            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#registerModal">
                Inscription
            </button>
        </div>

    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

@include('auth.modals')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>