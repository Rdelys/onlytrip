@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

{{-- HERO --}}
<div class="hero text-center">
    <h1 class="fw-bold">🌍 Explore le monde avec OnlyTrip</h1>
    <p>Des voyages uniques créés par des prestataires locaux</p>

    <div class="mt-3">
        <input type="text" class="form-control w-50 mx-auto" placeholder="Rechercher une destination...">
    </div>
</div>

{{-- VOYAGES --}}
<h3 class="mt-5 mb-3">🔥 Voyages populaires</h3>

<div class="row">

    @php
    $trips = [
        [
            'title' => 'Découverte de Marrakech',
            'country' => 'Maroc',
            'price' => 120,
            'img' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34'
        ],
        [
            'title' => 'Safari au Kenya',
            'country' => 'Kenya',
            'price' => 350,
            'img' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801'
        ],
        [
            'title' => 'Îles Maldives',
            'country' => 'Maldives',
            'price' => 600,
            'img' => 'https://images.unsplash.com/photo-1500375592092-40eb2168fd21'
        ],
    ];
    @endphp

    @foreach($trips as $trip)
    <div class="col-md-4 mb-4">

        <div class="card trip-card shadow-sm">

            <img src="{{ $trip['img'] }}" height="200" style="object-fit:cover;">

            <div class="card-body">

                <h5>{{ $trip['title'] }}</h5>

                <p class="text-muted">
                    <i class="fa-solid fa-location-dot"></i> {{ $trip['country'] }}
                </p>

                <p class="fw-bold text-primary">
                    {{ $trip['price'] }} €
                </p>

                <button class="btn btn-dark w-100">
                    Voir détails
                </button>

            </div>
        </div>

    </div>
    @endforeach

</div>

@endsection