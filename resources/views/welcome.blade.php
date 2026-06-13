@extends('layouts.app')
@section('title', 'Accueil — OnlyTrip')
@section('content')

{{-- ══════════════════════════════════════
     HERO
══════════════════════════════════════ --}}
<section class="wc-hero">
    <div class="wc-hero-content">
        <div class="wc-hero-pill">
            <i class="fa-solid fa-star"></i> +2 400 expériences locales disponibles
        </div>
        <h1>
            Voyagez avec les<br>
            <span class="wc-hero-accent">vrais locaux</span>
        </h1>
        <p class="wc-hero-sub">
            Découvrez des guides, hébergements et expériences uniques proposés
            par des habitants passionnés, partout dans le monde.
        </p>
        <div class="wc-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Destination, service ou guide...">
            <button>Rechercher</button>
        </div>
        <div class="wc-hero-stats">
            <div class="wc-stat">
                <i class="fa-solid fa-earth-africa"></i>
                <span><strong>80+</strong> pays</span>
            </div>
            <div class="wc-stat">
                <i class="fa-solid fa-users"></i>
                <span><strong>12 000+</strong> locaux</span>
            </div>
            <div class="wc-stat">
                <i class="fa-solid fa-star"></i>
                <span><strong>4.9/5</strong> satisfaction</span>
            </div>
        </div>
    </div>
    <div class="wc-hero-img">
        <img src="{{ asset('voyage.png') }}" alt="Voyage">
        <div class="wc-hero-badge">
            <i class="fa-solid fa-shield-halved"></i>
            <span>Paiement<br>sécurisé</span>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     VOYAGES POPULAIRES
══════════════════════════════════════ --}}
{{-- ══════════════════════════════════════
     SERVICES POPULAIRES PAR DES LOCAUX
══════════════════════════════════════ --}}
{{-- ══════════════════════════════════════
     SERVICES POPULAIRES PAR DES LOCAUX
══════════════════════════════════════ --}}
<section class="wc-section">
    <div class="wc-section-header">
        <h2><i class="fa-solid fa-hand-peace me-2 text-primary"></i>Services populaires par des locaux</h2>
        <p>Des expériences authentiques proposées par des habitants passionnés</p>
    </div>

    <div class="wc-trips-grid">
        @php
        $services = [
            [
                'id'          => 1,
                'title'       => 'Cours de cuisine traditionnelle',
                'local_name'  => 'Fatima Zahra',
                'country'     => 'Maroc',
                'city'        => 'Marrakech',
                'price'       => 45,
                'tag'         => 'Gastronomie',
                'img'         => 'https://images.unsplash.com/photo-1539020140153-e479b8c22e70?w=600&q=80',
                'description' => 'Préparez un tajine et découvrez les épices locales',
                'full_description' => 'Plongez au cœur de la cuisine marocaine traditionnelle. Fatima vous accueille dans sa maison familiale pour vous apprendre les secrets du tajine, du couscous et des pâtisseries orientales. Vous visiterez d\'abord le marché local pour sélectionner les épices et les légumes frais, puis passerez 3 heures en cuisine avant de déguster votre repas sur la terrasse avec vue sur les montagnes.',
                'duration' => '4 heures',
                'languages' => 'Français, Arabe, Anglais',
                'includes' => 'Ingrédients, repas, boissons, tablier, recettes écrites',
                'max_people' => 6
            ],
            [
                'id'          => 2,
                'title'       => 'Safari photo en 4x4',
                'local_name'  => 'Joseph Ole',
                'country'     => 'Kenya',
                'city'        => 'Nairobi',
                'price'       => 350,
                'tag'         => 'Nature',
                'img'         => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=600&q=80',
                'description' => 'Partez observer les Big Five avec un guide Maasai',
                'full_description' => 'Joseph, guide Maasai né dans la réserve, vous emmène pour une journée de safari photo inoubliable. Avec son œil expert, vous aurez la meilleure chance d\'observer lions, éléphants, buffles, léopards et rhinocéros. Joseph partagera ses connaissances sur la faune, la flore et les traditions Maasai. Déjeuner brousse inclus.',
                'duration' => 'Journée complète (8-10 heures)',
                'languages' => 'Anglais, Swahili, Maa',
                'includes' => 'Transport 4x4, eau, déjeuner, jumelles, guide',
                'max_people' => 7
            ],
            [
                'id'          => 3,
                'title'       => 'Excursion en dhoni traditionnel',
                'local_name'  => 'Ali Shamin',
                'country'     => 'Maldives',
                'city'        => 'Malé',
                'price'       => 120,
                'tag'         => 'Bateau',
                'img'         => 'https://images.unsplash.com/photo-1573843981267-be1999ff37cd?w=600&q=80',
                'description' => 'Navigation au coucher du soleil et pêche locale',
                'full_description' => 'Montez à bord du dhoni traditionnel d\'Ali pour une excursion magique au coucher du soleil. Vous apprendrez les techniques de pêche locales et pourrez pêcher votre propre poisson qui sera grillé pour vous sur une île déserte. Baignade en eaux cristallines et observation des dauphins sont également au programme.',
                'duration' => '3-4 heures',
                'languages' => 'Anglais, Dhivehi',
                'includes' => 'Boissons, matériel de pêche, collation, bouteille d\'eau',
                'max_people' => 10
            ],
            [
                'id'          => 4,
                'title'       => 'Cérémonie du thé et atelier kimono',
                'local_name'  => 'Yuki Tanaka',
                'country'     => 'Japon',
                'city'        => 'Kyoto',
                'price'       => 280,
                'tag'         => 'Culture',
                'img'         => 'https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=600&q=80',
                'description' => 'Immersion dans la tradition japonaise',
                'full_description' => 'Yuki, passionnée de culture traditionnelle japonaise, vous invite dans sa maison de thé à Kyoto. Commencez par l\'habillage en kimono authentique (location incluse), puis participez à une cérémonie du thé complète. Vous apprendrez les gestes, l\'histoire et la philosophie du "chanoyu". Repas kaori léger inclus.',
                'duration' => '2.5 heures',
                'languages' => 'Japonais, Anglais',
                'includes' => 'Kimono, cérémonie du thé, pâtisseries traditionnelles, photo souvenir',
                'max_people' => 4
            ],
            [
                'id'          => 5,
                'title'       => 'Dégustation dans vignoble familial',
                'local_name'  => 'Sofia & Matteo',
                'country'     => 'Italie',
                'city'        => 'Florence',
                'price'       => 195,
                'tag'         => 'Vin & fromages',
                'img'         => 'https://images.unsplash.com/photo-1534568338506-7f0b9f4b38f0?w=600&q=80',
                'description' => 'Visite des caves et repas chez l\'habitant',
                'full_description' => 'La famille de Sofia produit du vin depuis 3 générations en Toscane. Visitez leurs caves historiques, participez à une dégustation de 5 crus accompagnés de fromages et charcuteries locaux, puis partagez un repas traditionnel dans leur ferme. Matteo vous expliquera l\'art de l\'assemblage et les secrets du Chianti.',
                'duration' => '4 heures',
                'languages' => 'Italien, Anglais, Français',
                'includes' => 'Visite des caves, dégustation, repas complet, eau et vin',
                'max_people' => 12
            ],
            [
                'id'          => 6,
                'title'       => 'Randonnée glaciaire en petit comité',
                'local_name'  => 'Cristian Lopez',
                'country'     => 'Chili',
                'city'        => 'Punta Arenas',
                'price'       => 420,
                'tag'         => 'Aventure',
                'img'         => 'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=600&q=80',
                'description' => 'Explorez les glaciers avec un guide de Patagonie',
                'full_description' => 'Cristian, guide de montagne certifié, vous emmène pour une randonnée exclusive sur le glacier Perito Moreno. Équipement technique fourni (crampons, piolet, baudrier). Vous marcherez sur la glace bleue, découvrirez les crevasses et profiterez d\'une vue imprenable. Petit groupe pour une expérience intime et sécurisée.',
                'duration' => '6 heures',
                'languages' => 'Espagnol, Anglais',
                'includes' => 'Équipement technique complet, bâtons, collation énergétique, eau, photos',
                'max_people' => 8
            ],
        ];
        @endphp

        @foreach($services as $service)
        <div class="wc-trip-card">
            <div class="wc-trip-img-wrap">
                <img src="{{ $service['img'] }}" alt="{{ $service['title'] }}">
                <span class="wc-trip-tag">{{ $service['tag'] }}</span>
                <button class="wc-trip-fav" aria-label="Favoris">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </div>
            <div class="wc-trip-body">
                {{-- Local et pays --}}
                <div class="wc-trip-local">
                    <i class="fa-solid fa-user-astronaut"></i> {{ $service['local_name'] }}
                    <span class="wc-trip-country">
                        <i class="fa-solid fa-location-dot"></i> {{ $service['country'] }}
                    </span>
                </div>

                <h3 class="wc-trip-title">{{ $service['title'] }}</h3>
                <p class="wc-trip-description">{{ $service['description'] }}</p>

                <div class="wc-trip-meta">
                    <span><i class="fa-regular fa-building"></i> {{ $service['city'] }}</span>
                </div>

                <div class="wc-trip-footer">
                    <div class="wc-trip-price">
                        <span class="wc-from">dès</span>
                        <strong>{{ $service['price'] }} €</strong>
                        <span class="wc-per">/pers.</span>
                    </div>
                    <button class="wc-btn-details" data-bs-toggle="modal" data-bs-target="#serviceModal{{ $service['id'] }}">
                        Voir <i class="fa-solid fa-arrow-right ms-1"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- MODAL pour ce service --}}
        <div class="modal fade" id="serviceModal{{ $service['id'] }}" tabindex="-1" aria-labelledby="serviceModalLabel{{ $service['id'] }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="wc-modal-img">
                            <img src="{{ $service['img'] }}" alt="{{ $service['title'] }}">
                            <span class="wc-modal-tag">{{ $service['tag'] }}</span>
                        </div>
                        
                        <div class="wc-modal-header">
                            <div class="wc-modal-local">
                                <i class="fa-solid fa-user-astronaut"></i> {{ $service['local_name'] }}
                                <span><i class="fa-solid fa-location-dot"></i> {{ $service['country'] }}, {{ $service['city'] }}</span>
                            </div>
                            <h3 class="wc-modal-title">{{ $service['title'] }}</h3>
                        </div>

                        <div class="wc-modal-details">
                            <div class="wc-modal-info-grid">
                                <div class="wc-modal-info-item">
                                    <i class="fa-regular fa-clock"></i>
                                    <span><strong>Durée</strong><br>{{ $service['duration'] }}</span>
                                </div>
                                <div class="wc-modal-info-item">
                                    <i class="fa-solid fa-language"></i>
                                    <span><strong>Langues</strong><br>{{ $service['languages'] }}</span>
                                </div>
                                <div class="wc-modal-info-item">
                                    <i class="fa-solid fa-users"></i>
                                    <span><strong>Max. personnes</strong><br>{{ $service['max_people'] }}</span>
                                </div>
                                <div class="wc-modal-info-item">
                                    <i class="fa-solid fa-euro-sign"></i>
                                    <span><strong>Prix</strong><br>{{ $service['price'] }} € / personne</span>
                                </div>
                            </div>

                            <div class="wc-modal-description">
                                <h4><i class="fa-solid fa-book-open"></i> Description détaillée</h4>
                                <p>{{ $service['full_description'] }}</p>
                            </div>

                            <div class="wc-modal-includes">
                                <h4><i class="fa-solid fa-gift"></i> Ce qui est inclus</h4>
                                <ul>
                                    @foreach(explode(', ', $service['includes']) as $item)
                                        <li><i class="fa-solid fa-check-circle"></i> {{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="wc-modal-close" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="wc-modal-book">
                            <i class="fa-regular fa-calendar-check"></i> Réserver cette expérience
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
{{-- ══════════════════════════════════════
     COMMENT ÇA MARCHE
══════════════════════════════════════ --}}
<section class="wc-section wc-how">
    <div class="wc-section-header">
        <h2><i class="fa-solid fa-circle-question me-2 text-primary"></i>Comment ça marche ?</h2>
        <p>Réserver une expérience locale en 3 étapes simples</p>
    </div>

    <div class="wc-steps">
        <div class="wc-step">
            <div class="wc-step-num">01</div>
            <div class="wc-step-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
            <h4>Recherchez</h4>
            <p>Parcourez des centaines d'offres locales par destination, date ou type d'activité.</p>
        </div>
        <div class="wc-step-arrow"><i class="fa-solid fa-arrow-right"></i></div>
        <div class="wc-step">
            <div class="wc-step-num">02</div>
            <div class="wc-step-icon"><i class="fa-solid fa-comments"></i></div>
            <h4>Contactez</h4>
            <p>Échangez directement avec le local pour personnaliser votre expérience.</p>
        </div>
        <div class="wc-step-arrow"><i class="fa-solid fa-arrow-right"></i></div>
        <div class="wc-step">
            <div class="wc-step-num">03</div>
            <div class="wc-step-icon"><i class="fa-solid fa-calendar-check"></i></div>
            <h4>Réservez</h4>
            <p>Confirmez et payez en toute sécurité. Votre aventure commence ici.</p>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     POURQUOI ONLYTRIP
══════════════════════════════════════ --}}
<section class="wc-section wc-why">
    <div class="wc-why-text">
        <div class="wc-section-header" style="text-align:left;">
            <h2><i class="fa-solid fa-trophy me-2 text-primary"></i>Pourquoi OnlyTrip ?</h2>
            <p>Nous mettons l'humain au cœur du voyage</p>
        </div>
        <div class="wc-why-list">
            <div class="wc-why-item">
                <i class="fa-solid fa-shield-halved"></i>
                <div>
                    <strong>Paiements 100 % sécurisés</strong>
                    <span>Stripe & PayPal. Remboursement garanti si annulation.</span>
                </div>
            </div>
            <div class="wc-why-item">
                <i class="fa-solid fa-user-check"></i>
                <div>
                    <strong>Locaux vérifiés</strong>
                    <span>Chaque prestataire est vérifié et évalué par notre équipe.</span>
                </div>
            </div>
            <div class="wc-why-item">
                <i class="fa-solid fa-headset"></i>
                <div>
                    <strong>Support 24h/24</strong>
                    <span>Notre équipe est disponible à tout moment pour vous aider.</span>
                </div>
            </div>
            <div class="wc-why-item">
                <i class="fa-solid fa-earth-americas"></i>
                <div>
                    <strong>Impact local positif</strong>
                    <span>Chaque réservation bénéficie directement à la communauté locale.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="wc-why-img">
        <img src="{{ asset('support.png') }}" alt="Équipe locale">
        <div class="wc-why-card-float">
            <i class="fa-solid fa-star text-warning"></i>
            <div>
                <strong>4.9 / 5</strong>
                <span>sur +8 000 avis</span>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     TÉMOIGNAGES
══════════════════════════════════════ --}}
<section class="wc-section">
    <div class="wc-section-header">
        <h2><i class="fa-solid fa-quote-left me-2 text-primary"></i>Ce que disent nos voyageurs</h2>
        <p>Des expériences authentiques racontées par ceux qui les ont vécues</p>
    </div>

    <div class="wc-testimonials">
        @php
        $testimonials = [
            ['name' => 'Sophie L.',    'country' => 'France',     'text' => 'Une semaine au Maroc organisée par un local incroyable. Tout était parfait, authentique et loin des circuits touristiques classiques.', 'rating' => 5, 'avatar' => 'SL'],
            ['name' => 'Marco T.',     'country' => 'Italie',     'text' => "Le safari au Kenya organisé via OnlyTrip était une expérience de vie. Notre guide connaissait chaque coin de la réserve.",              'rating' => 5, 'avatar' => 'MT'],
            ['name' => 'Aiko N.',      'country' => 'Japon',      'text' => 'J\'ai découvert des temples cachés à Kyoto grâce à un habitant passionné. Impossible à trouver dans un guide classique.',              'rating' => 5, 'avatar' => 'AN'],
        ];
        @endphp

        @foreach($testimonials as $t)
        <div class="wc-testi-card">
            <div class="wc-testi-stars">
                @for($i = 0; $i < $t['rating']; $i++)
                    <i class="fa-solid fa-star"></i>
                @endfor
            </div>
            <p class="wc-testi-text">"{{ $t['text'] }}"</p>
            <div class="wc-testi-author">
                <div class="wc-testi-avatar">{{ $t['avatar'] }}</div>
                <div>
                    <strong>{{ $t['name'] }}</strong>
                    <span><i class="fa-solid fa-location-dot me-1"></i>{{ $t['country'] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ══════════════════════════════════════
     CTA FINAL
══════════════════════════════════════ --}}
<section class="wc-cta">
    <i class="fa-solid fa-plane-departure wc-cta-icon"></i>
    <h2>Prêt à vivre une expérience unique ?</h2>
    <p>Rejoignez +50 000 voyageurs qui ont fait confiance à OnlyTrip.</p>
    <div class="wc-cta-btns">
        <button class="wc-cta-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
            <i class="fa-solid fa-user-plus me-2"></i> Créer un compte gratuit
        </button>
        <button class="wc-cta-secondary">
            <i class="fa-solid fa-compass me-2"></i> Explorer les offres
        </button>
    </div>
</section>

{{-- ══════════════════════════════════════
     STYLES PAGE ACCUEIL
══════════════════════════════════════ --}}
<style>
/* ── GLOBALS ── */
.wc-section { margin-bottom: 5rem; }
.wc-section-header { text-align: center; margin-bottom: 2.5rem; }
.wc-section-header h2 {
    font-family: 'Nunito', sans-serif;
    font-size: 1.625rem;
    font-weight: 800;
    color: #0a0a0f;
    margin-bottom: 6px;
    letter-spacing: -0.01em;
}
.wc-section-header p { color: #6b7280; font-size: 0.9375rem; margin: 0; }

/* ── HERO ── */
.wc-hero {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
    padding: 3.5rem 0 4rem;
}
@media (max-width: 768px) {
    .wc-hero { grid-template-columns: 1fr; }
    .wc-hero-img { display: none; }
}

.wc-hero-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(59,130,246,0.08);
    border: 1px solid rgba(59,130,246,0.2);
    color: #1d4ed8;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 100px;
    letter-spacing: 0.05em;
    margin-bottom: 1.25rem;
    font-family: 'Nunito', sans-serif;
}
.wc-hero-pill i { color: #f59e0b; }

.wc-hero-content h1 {
    font-family: 'Nunito', sans-serif;
    font-size: clamp(2.25rem, 4vw, 3.25rem);
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -0.025em;
    color: #0a0a0f;
    margin-bottom: 1rem;
}
.wc-hero-accent { color: #3b82f6; }

.wc-hero-sub {
    font-size: 1rem;
    color: #6b7280;
    line-height: 1.7;
    max-width: 460px;
    margin-bottom: 2rem;
}

.wc-search {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    border: 1.5px solid #e5e7eb;
    border-radius: 100px;
    padding: 10px 10px 10px 20px;
    max-width: 500px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    margin-bottom: 2rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.wc-search:focus-within {
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
}
.wc-search i { color: #9ca3af; font-size: 15px; flex-shrink: 0; }
.wc-search input {
    flex: 1; border: none; outline: none;
    font-family: 'Nunito', sans-serif;
    font-size: 0.9375rem; color: #0a0a0f; background: transparent;
}
.wc-search input::placeholder { color: #9ca3af; }
.wc-search button {
    background: #3b82f6; color: #fff; border: none;
    border-radius: 100px; padding: 9px 22px;
    font-family: 'Nunito', sans-serif; font-size: 0.875rem;
    font-weight: 700; cursor: pointer; white-space: nowrap;
    transition: background 0.2s;
}
.wc-search button:hover { background: #1d4ed8; }

.wc-hero-stats {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}
.wc-stat {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.875rem;
    color: #6b7280;
    font-family: 'Nunito', sans-serif;
}
.wc-stat i { color: #3b82f6; font-size: 1rem; }
.wc-stat strong { color: #0a0a0f; font-weight: 800; }

.wc-hero-img { position: relative; }
.wc-hero-img img {
    width: 100%; height: 420px;
    object-fit: contain;
    border-radius: 20px;
}
.wc-hero-badge {
    position: absolute;
    bottom: 20px; left: -20px;
    background: #fff;
    border-radius: 12px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    font-family: 'Nunito', sans-serif;
}
.wc-hero-badge i { color: #3b82f6; font-size: 1.25rem; }
.wc-hero-badge span { font-size: 0.75rem; font-weight: 700; color: #0a0a0f; line-height: 1.3; }

/* ── CATÉGORIES ── */
.wc-categories {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
    gap: 12px;
}
.wc-cat-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1.25rem 0.75rem;
    background: #fff;
    border: 1.5px solid #e5e7eb;
    border-radius: 14px;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s, transform 0.15s;
    gap: 8px;
}
.wc-cat-card:hover {
    border-color: #3b82f6;
    background: #eff6ff;
    transform: translateY(-3px);
}
.wc-cat-card i { font-size: 1.5rem; color: #3b82f6; }
.wc-cat-label { font-size: 0.875rem; font-weight: 700; color: #0a0a0f; font-family: 'Nunito', sans-serif; }
.wc-cat-count { font-size: 0.7rem; color: #9ca3af; font-family: 'Nunito', sans-serif; }

/* ── TRIPS GRID ── */
.wc-trips-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}
.wc-trip-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
    transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
}
.wc-trip-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(59,130,246,0.1);
    border-color: rgba(59,130,246,0.3);
}
.wc-trip-img-wrap { position: relative; }
.wc-trip-img-wrap img { width: 100%; height: 200px; object-fit: cover; display: block; }
.wc-trip-tag {
    position: absolute; top: 12px; left: 12px;
    background: #3b82f6; color: #fff;
    font-size: 0.6875rem; font-weight: 700;
    font-family: 'Nunito', sans-serif;
    padding: 3px 10px; border-radius: 100px;
    letter-spacing: 0.04em;
}
.wc-trip-fav {
    position: absolute; top: 10px; right: 10px;
    background: rgba(255,255,255,0.9);
    border: none; border-radius: 50%;
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: #9ca3af;
    transition: color 0.2s, background 0.2s;
}
.wc-trip-fav:hover { color: #ef4444; background: #fff; }

.wc-trip-body { padding: 1rem 1.125rem; }
.wc-trip-meta {
    display: flex; justify-content: space-between; align-items: center;
    font-size: 0.8125rem; color: #9ca3af;
    font-family: 'Nunito', sans-serif; margin-bottom: 6px;
}
.wc-trip-meta i { color: #3b82f6; font-size: 11px; }
.wc-trip-rating { display: flex; align-items: center; gap: 4px; }
.wc-trip-rating i { color: #f59e0b; font-size: 12px; }
.wc-trip-rating { font-weight: 700; color: #0a0a0f; }
.wc-trip-reviews { font-weight: 400; color: #9ca3af; }

.wc-trip-title {
    font-family: 'Nunito', sans-serif;
    font-size: 0.9375rem; font-weight: 700;
    color: #0a0a0f; margin: 0 0 0.75rem;
    line-height: 1.3;
}
.wc-trip-footer {
    display: flex; align-items: center; justify-content: space-between;
}
.wc-trip-price { font-family: 'Nunito', sans-serif; }
.wc-from { font-size: 0.75rem; color: #9ca3af; }
.wc-trip-price strong { font-size: 1.125rem; font-weight: 800; color: #0a0a0f; margin: 0 2px; }
.wc-per { font-size: 0.75rem; color: #9ca3af; }

.wc-btn-details {
    background: #0a0a0f; color: #fff; border: none;
    border-radius: 100px; padding: 7px 16px;
    font-family: 'Nunito', sans-serif; font-size: 0.8125rem;
    font-weight: 700; cursor: pointer;
    transition: background 0.2s;
    display: flex; align-items: center;
}
.wc-btn-details:hover { background: #3b82f6; }

/* ── COMMENT ÇA MARCHE ── */
.wc-how { background: #f8f9fc; border-radius: 20px; padding: 3rem 2rem; }
.wc-steps {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
}
.wc-step {
    flex: 1; min-width: 200px; max-width: 260px;
    text-align: center;
    padding: 1.5rem 1rem;
}
.wc-step-num {
    font-size: 0.75rem; font-weight: 800;
    color: #3b82f6; letter-spacing: 0.1em;
    font-family: 'Nunito', sans-serif; margin-bottom: 12px;
}
.wc-step-icon {
    width: 60px; height: 60px; border-radius: 50%;
    background: #eff6ff; border: 2px solid #bfdbfe;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1rem;
}
.wc-step-icon i { font-size: 1.375rem; color: #3b82f6; }
.wc-step h4 { font-family: 'Nunito', sans-serif; font-size: 1rem; font-weight: 800; color: #0a0a0f; margin-bottom: 6px; }
.wc-step p { font-size: 0.875rem; color: #6b7280; line-height: 1.6; margin: 0; }
.wc-step-arrow { font-size: 1.25rem; color: #d1d5db; flex-shrink: 0; }
@media (max-width: 576px) { .wc-step-arrow { display: none; } }

/* ── POURQUOI ── */
.wc-why {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}
@media (max-width: 768px) {
    .wc-why { grid-template-columns: 1fr; }
    .wc-why-img { display: none; }
}
.wc-why-list { display: flex; flex-direction: column; gap: 1.25rem; }
.wc-why-item {
    display: flex; align-items: flex-start; gap: 1rem;
    padding: 1rem 1.25rem;
    background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.wc-why-item:hover { border-color: #bfdbfe; box-shadow: 0 4px 16px rgba(59,130,246,0.08); }
.wc-why-item > i { font-size: 1.25rem; color: #3b82f6; flex-shrink: 0; margin-top: 2px; }
.wc-why-item strong { display: block; font-size: 0.9375rem; font-weight: 700; color: #0a0a0f; font-family: 'Nunito', sans-serif; margin-bottom: 3px; }
.wc-why-item span { font-size: 0.875rem; color: #6b7280; line-height: 1.5; }

.wc-why-img { position: relative; }
.wc-why-img img { width: 100%; height: 400px; object-fit: cover; border-radius: 20px; }
.wc-why-card-float {
    position: absolute; bottom: 20px; right: -20px;
    background: #fff; border-radius: 12px;
    padding: 12px 18px; display: flex; align-items: center; gap: 12px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    font-family: 'Nunito', sans-serif;
}
.wc-why-card-float i { font-size: 1.5rem; }
.wc-why-card-float strong { display: block; font-size: 1rem; font-weight: 800; color: #0a0a0f; }
.wc-why-card-float span { font-size: 0.75rem; color: #6b7280; }

/* ── TÉMOIGNAGES ── */
.wc-testimonials {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
}
.wc-testi-card {
    background: #fff; border: 1px solid #e5e7eb;
    border-radius: 16px; padding: 1.5rem;
    transition: box-shadow 0.2s, border-color 0.2s;
}
.wc-testi-card:hover { box-shadow: 0 8px 24px rgba(59,130,246,0.08); border-color: #bfdbfe; }
.wc-testi-stars { color: #f59e0b; font-size: 0.875rem; margin-bottom: 12px; letter-spacing: 2px; }
.wc-testi-text {
    font-size: 0.9rem; color: #374151; line-height: 1.7;
    font-style: italic; margin-bottom: 1.25rem;
    font-family: 'Nunito', sans-serif;
}
.wc-testi-author { display: flex; align-items: center; gap: 12px; }
.wc-testi-avatar {
    width: 40px; height: 40px; border-radius: 50%;
    background: #eff6ff; border: 2px solid #bfdbfe;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.75rem; font-weight: 800; color: #1d4ed8;
    font-family: 'Nunito', sans-serif; flex-shrink: 0;
}
.wc-testi-author strong { display: block; font-size: 0.875rem; font-weight: 700; color: #0a0a0f; font-family: 'Nunito', sans-serif; }
.wc-testi-author span { font-size: 0.75rem; color: #9ca3af; }
.wc-testi-author span i { color: #3b82f6; font-size: 10px; }

/* ── CTA ── */
.wc-cta {
    background: #0a0a0f;
    border-radius: 24px;
    padding: 4rem 2rem;
    text-align: center;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}
.wc-cta::before {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 300px; height: 300px; border-radius: 50%;
    background: radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 65%);
}
.wc-cta-icon { font-size: 2.5rem; color: #3b82f6; margin-bottom: 1rem; display: block; }
.wc-cta h2 {
    font-family: 'Nunito', sans-serif;
    font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800;
    color: #fff; margin-bottom: 10px; letter-spacing: -0.01em;
}
.wc-cta p { color: rgba(255,255,255,0.5); font-size: 1rem; margin-bottom: 2rem; }
.wc-cta-btns { display: flex; justify-content: center; gap: 12px; flex-wrap: wrap; }
.wc-cta-primary {
    background: #3b82f6; color: #fff; border: none;
    border-radius: 100px; padding: 13px 28px;
    font-family: 'Nunito', sans-serif; font-size: 0.9375rem; font-weight: 700;
    cursor: pointer; transition: background 0.2s, transform 0.15s;
    display: flex; align-items: center;
}
.wc-cta-primary:hover { background: #1d4ed8; transform: translateY(-1px); }
.wc-cta-secondary {
    background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.8);
    border: 1px solid rgba(255,255,255,0.15); border-radius: 100px;
    padding: 13px 28px; font-family: 'Nunito', sans-serif;
    font-size: 0.9375rem; font-weight: 700; cursor: pointer;
    transition: background 0.2s; display: flex; align-items: center;
}
.wc-cta-secondary:hover { background: rgba(255,255,255,0.14); }
/* ── LOCAL INFO CARD ── */
.wc-trip-local {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f0fdf4;
    color: #15803d;
    font-size: 0.7rem;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 100px;
    margin-bottom: 10px;
    width: fit-content;
    font-family: 'Nunito', sans-serif;
    letter-spacing: 0.02em;
}

.wc-trip-local i {
    font-size: 0.7rem;
    color: #15803d;
}

.wc-trip-country {
    background: transparent;
    color: #166534;
    margin-left: 4px;
    font-weight: 600;
}

.wc-trip-country i {
    color: #3b82f6;
    font-size: 0.65rem;
    margin-right: 3px;
}

/* Description courte */
.wc-trip-description {
    font-size: 0.75rem;
    color: #6b7280;
    margin: 6px 0 12px 0;
    line-height: 1.4;
    font-family: 'Nunito', sans-serif;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* ── MODAL STYLES ── */
.modal-content {
    border-radius: 24px;
    border: none;
    overflow: hidden;
}

.wc-modal-img {
    position: relative;
    margin: -1rem -1rem 1rem -1rem;
}

.wc-modal-img img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.wc-modal-tag {
    position: absolute;
    bottom: -12px;
    left: 20px;
    background: #3b82f6;
    color: #fff;
    font-size: 0.75rem;
    font-weight: 700;
    font-family: 'Nunito', sans-serif;
    padding: 5px 16px;
    border-radius: 100px;
    letter-spacing: 0.04em;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.wc-modal-header {
    padding: 0 0.5rem 1rem 0.5rem;
}

.wc-modal-local {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: #f0fdf4;
    color: #15803d;
    font-size: 0.8rem;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 100px;
    margin-bottom: 16px;
    font-family: 'Nunito', sans-serif;
}

.wc-modal-local i {
    font-size: 0.8rem;
}

.wc-modal-local span {
    color: #6b7280;
    font-weight: 500;
}

.wc-modal-local span i {
    color: #3b82f6;
}

.wc-modal-title {
    font-family: 'Nunito', sans-serif;
    font-size: 1.5rem;
    font-weight: 800;
    color: #0a0a0f;
    margin: 0;
}

.wc-modal-details {
    padding: 0 0.5rem;
}

.wc-modal-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 16px;
    background: #f8f9fc;
    border-radius: 16px;
    padding: 16px;
    margin-bottom: 24px;
}

.wc-modal-info-item {
    display: flex;
    align-items: center;
    gap: 12px;
}

.wc-modal-info-item i {
    font-size: 1.25rem;
    color: #3b82f6;
    width: 28px;
}

.wc-modal-info-item span {
    font-size: 0.85rem;
    color: #6b7280;
    line-height: 1.4;
}

.wc-modal-info-item strong {
    color: #0a0a0f;
    font-weight: 700;
}

.wc-modal-description h4,
.wc-modal-includes h4 {
    font-family: 'Nunito', sans-serif;
    font-size: 1rem;
    font-weight: 800;
    color: #0a0a0f;
    margin-bottom: 12px;
}

.wc-modal-description h4 i,
.wc-modal-includes h4 i {
    color: #3b82f6;
    margin-right: 8px;
}

.wc-modal-description p {
    font-size: 0.9rem;
    color: #4b5563;
    line-height: 1.6;
    margin-bottom: 24px;
}

.wc-modal-includes ul {
    list-style: none;
    padding: 0;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 8px;
    margin-bottom: 0;
}

.wc-modal-includes li {
    font-size: 0.85rem;
    color: #374151;
    padding: 6px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.wc-modal-includes li i {
    color: #10b981;
    font-size: 0.85rem;
    width: 18px;
}

.wc-modal-close {
    background: #f3f4f6;
    color: #4b5563;
    border: none;
    border-radius: 100px;
    padding: 10px 24px;
    font-family: 'Nunito', sans-serif;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.wc-modal-close:hover {
    background: #e5e7eb;
}

.wc-modal-book {
    background: #3b82f6;
    color: #fff;
    border: none;
    border-radius: 100px;
    padding: 10px 28px;
    font-family: 'Nunito', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.wc-modal-book:hover {
    background: #1d4ed8;
}

@media (max-width: 576px) {
    .wc-modal-info-grid {
        grid-template-columns: 1fr;
    }
    .wc-modal-includes ul {
        grid-template-columns: 1fr;
    }
    .modal-footer {
        flex-direction: column-reverse;
    }
    .wc-modal-close, .wc-modal-book {
        width: 100%;
        justify-content: center;
    }
}
</style>

@endsection