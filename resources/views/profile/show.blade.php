{{-- resources/views/profile/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Mon Profil – OnlyTrip')

@push('styles')
<style>
/* ═══════════════════════════════════════════════════════
   PROFILE PAGE  –  OnlyTrip
═══════════════════════════════════════════════════════ */

.profile-banner {
    border-radius: 20px;
    padding: 20px 28px;
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 16px;
    font-weight: 600;
}
.profile-banner.inactif {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    border: 1px solid #fcd34d;
}
.profile-banner.actif {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    color: #065f46;
    border: 1px solid #6ee7b7;
}
.profile-banner .banner-icon { font-size: 1.75rem; flex-shrink: 0; }
.profile-banner .banner-text { flex: 1; }
.profile-banner .banner-title { font-size: 1rem; margin: 0; }
.profile-banner .banner-sub { font-size: 0.8125rem; font-weight: 400; margin: 0; opacity: .85; }

.completion-bar-wrap {
    background: rgba(255,255,255,.45);
    border-radius: 100px;
    height: 8px;
    margin-top: 10px;
    overflow: hidden;
    width: 220px;
}
.completion-bar-fill {
    height: 100%;
    border-radius: 100px;
    background: currentColor;
    transition: width .6s ease;
}

.profile-grid {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 28px;
    align-items: start;
}
@media (max-width: 900px) { .profile-grid { grid-template-columns: 1fr; } }

.profile-card {
    background: #fff;
    border-radius: 24px;
    border: 1px solid var(--border);
    padding: 28px;
    box-shadow: 0 2px 12px rgba(0,0,0,.04);
}

.avatar-zone { display: flex; flex-direction: column; align-items: center; gap: 14px; }
.avatar-wrap { position: relative; width: 140px; height: 140px; }
.avatar-img {
    width: 140px; height: 140px; border-radius: 50%;
    object-fit: cover; border: 4px solid var(--border);
}
.avatar-placeholder {
    width: 140px; height: 140px; border-radius: 50%;
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    display: flex; align-items: center; justify-content: center;
    font-size: 3rem; color: var(--blue); border: 4px solid var(--border);
}
.avatar-badge {
    position: absolute; bottom: 4px; right: 4px;
    width: 32px; height: 32px; border-radius: 50%;
    border: 3px solid #fff; display: flex; align-items: center; justify-content: center;
    font-size: 0.75rem; cursor: pointer;
}
.avatar-badge.actif   { background: #10b981; color: #fff; }
.avatar-badge.inactif { background: #f59e0b; color: #fff; }

.photo-actions { display: flex; gap: 8px; flex-wrap: wrap; justify-content: center; }
.btn-photo {
    font-family: 'Nunito', sans-serif; font-size: 0.75rem; font-weight: 700;
    border-radius: 100px; padding: 6px 14px; border: 1px solid var(--border);
    background: #fff; color: var(--dark); cursor: pointer; transition: all .2s;
    display: flex; align-items: center; gap: 6px;
}
.btn-photo:hover { border-color: var(--blue); color: var(--blue); }
.btn-photo:disabled { opacity: .5; cursor: not-allowed; }

.star-rating { display: flex; gap: 3px; font-size: 1.125rem; color: #fbbf24; justify-content: center; }
.star-rating .empty { color: #d1d5db; }

.section-label {
    font-size: 0.75rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .08em; color: var(--muted); margin-bottom: 18px;
    display: flex; align-items: center; gap: 10px;
}
.section-label::after { content: ''; flex: 1; height: 1px; background: var(--border); }
.section-label i { color: var(--blue); font-size: 0.875rem; }

.field-group { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
@media (max-width: 600px) { .field-group { grid-template-columns: 1fr; } }
.field-group.full { grid-template-columns: 1fr; }

.form-label { font-size: 0.8125rem; font-weight: 700; color: var(--dark); margin-bottom: 6px; display: block; }

.form-control, .form-select {
    font-family: 'Nunito', sans-serif; font-size: 0.875rem;
    border: 1.5px solid var(--border); border-radius: 12px;
    padding: 10px 14px; transition: border-color .2s, box-shadow .2s;
    width: 100%; background: #fff;
}
.form-control:focus, .form-select:focus {
    border-color: var(--blue); box-shadow: 0 0 0 3px rgba(59,130,246,.12); outline: none;
}

/* Sexe – champ verrouillé, lecture seule, jamais éditable manuellement */
.sexe-readonly {
    display: flex; align-items: center; gap: 10px;
    border: 1.5px dashed var(--border);
    border-radius: 12px;
    padding: 10px 14px;
    background: #f9fafb;
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--dark);
    min-height: 42px;
}
.sexe-readonly.empty { color: var(--muted); font-weight: 600; }
.sexe-readonly i.lock { color: var(--muted); font-size: 0.75rem; margin-left: auto; }

.btn-detect {
    font-family: 'Nunito', sans-serif; font-size: 0.8125rem; font-weight: 700;
    padding: 9px 18px; border-radius: 100px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff; border: none; cursor: pointer; transition: opacity .2s;
    display: flex; align-items: center; gap: 8px; white-space: nowrap;
}
.btn-detect:hover { opacity: .88; }
.btn-detect:disabled { opacity: .55; cursor: not-allowed; }

/* ── Interest chips ── */
.interests-grid { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 4px; }

.interest-chip {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    border-radius: 100px;
    border: 1.5px solid var(--border);
    background: #fff;
    font-family: 'Nunito', sans-serif;
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--dark);
    cursor: pointer;
    user-select: none;
    position: relative;
    transition: background-color .18s ease, border-color .18s ease,
                color .18s ease, box-shadow .18s ease, transform .12s ease;
}
.interest-chip input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}
.interest-chip i {
    font-size: 0.8125rem;
    width: 14px;
    text-align: center;
    flex-shrink: 0;
}
.interest-chip:hover {
    border-color: var(--blue);
    color: var(--blue);
    background: #eff6ff;
}
.interest-chip:hover i { color: var(--blue); }
.interest-chip.selected {
    background: var(--blue);
    border-color: var(--blue);
    color: #fff;
}
.interest-chip.selected i { color: #fff; }
.interest-chip.selected:hover {
    background: var(--blue-dk);
    border-color: var(--blue-dk);
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(29,78,216,.25);
}
.interest-chip.selected:hover i { color: #fff; }
.interest-chip:has(input:focus-visible) {
    outline: 2px solid var(--blue);
    outline-offset: 2px;
}
.interest-chip .check-icon { display: none; font-size: 0.75rem; }
.interest-chip.selected .check-icon { display: inline-block; }
.interest-chip.selected .main-icon { display: none; }

.btn-save {
    font-family: 'Nunito', sans-serif; font-weight: 700; font-size: 0.9375rem;
    padding: 12px 36px; border-radius: 100px; background: var(--blue);
    color: #fff; border: none; cursor: pointer; transition: background .2s;
}
.btn-save:hover { background: var(--blue-dk); }

/* ── Camera modal: réutilisée pour photo de profil ET vérification sexe ── */
.camera-modal-backdrop {
    display: none; position: fixed; inset: 0;
    background: rgba(10,10,15,.65); z-index: 2000;
    align-items: center; justify-content: center;
}
.camera-modal-backdrop.open { display: flex; }
.camera-modal { background: #fff; border-radius: 24px; padding: 28px; width: 420px; max-width: 96vw; text-align: center; }
.camera-modal video { width: 100%; border-radius: 16px; margin: 16px 0; background: #000; }
.camera-modal canvas { display: none; }

/* Overlay d'analyse pendant le traitement DeepFace */
.camera-analyzing {
    display: none;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px;
    background: #eef2ff;
    border-radius: 14px;
    color: #4338ca;
    font-weight: 700;
    font-size: 0.875rem;
    margin-top: 10px;
}
.camera-analyzing.active { display: flex; }
.camera-analyzing i { animation: spin 1s linear infinite; }
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

.alert-profile { border-radius: 14px; padding: 14px 20px; font-size: 0.875rem; font-weight: 600; margin-bottom: 20px; }
.alert-success { background:#d1fae5; color:#065f46; border:1px solid #6ee7b7; }
.alert-info    { background:#dbeafe; color:#1e40af; border:1px solid #93c5fd; }

.detect-hint {
    font-size: 0.75rem; color: var(--muted); margin-top: 6px; line-height: 1.4;
    display: flex; align-items: flex-start; gap: 6px;
}
.detect-hint i { margin-top: 2px; flex-shrink: 0; }
</style>
@endpush

@section('content')

@php
    $interests = [
        ['label'=>'Aventure / Découverte','icon'=>'fa-mountain-sun'],
        ['label'=>'Culture',              'icon'=>'fa-landmark'],
        ['label'=>'Culinaire',            'icon'=>'fa-utensils'],
        ['label'=>'Randonnée / Nature',   'icon'=>'fa-person-hiking'],
        ['label'=>'Famille',              'icon'=>'fa-people-roof'],
        ['label'=>'Road Trips',           'icon'=>'fa-car-side'],
        ['label'=>'Sport',                'icon'=>'fa-futbol'],
        ['label'=>'Spirituel',            'icon'=>'fa-place-of-worship'],
        ['label'=>'Plage',                'icon'=>'fa-umbrella-beach'],
        ['label'=>'Animaux',              'icon'=>'fa-paw'],
        ['label'=>'Autres',               'icon'=>'fa-star'],
    ];
    $isActif   = $user->status === 'actif';
    $isLocal   = $user->profil == 0;
    $selected  = $user->centres_interet ?? [];

    $sexeLabels = ['homme' => 'Homme', 'femme' => 'Femme', 'autre' => 'Autre / Non déterminé'];

    $fields = ['nom','prenom','pseudo','date_naissance','sexe','telephone','photo_profil','centres_interet'];
    if ($isLocal) $fields[] = 'bio';
    $filled = 0;
    foreach ($fields as $f) {
        $v = $user->$f;
        if ($f === 'centres_interet') { if (!empty($v)) $filled++; }
        elseif ($v) $filled++;
    }
    $pct = (int) round($filled / count($fields) * 100);
@endphp

{{-- Alerts --}}
@if(session('success'))
    <div class="alert-profile alert-success"><i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}</div>
@endif
@if(session('info'))
    <div class="alert-profile alert-info"><i class="fa-solid fa-circle-info me-2"></i>{{ session('info') }}</div>
@endif
@if($errors->any())
    <div class="alert-profile" style="background:#fee2e2;color:#991b1b;border:1px solid #fca5a5;">
        <i class="fa-solid fa-triangle-exclamation me-2"></i>
        {{ $errors->first() }}
    </div>
@endif

{{-- Completion banner --}}
<div class="profile-banner {{ $user->status }}">
    <div class="banner-icon">
        <i class="fa-solid {{ $isActif ? 'fa-circle-check' : 'fa-triangle-exclamation' }}"></i>
    </div>
    <div class="banner-text">
        <p class="banner-title">
            @if($isActif) Profil complet — vous pouvez utiliser OnlyTrip !
            @else Profil incomplet — complétez-le pour accéder à toutes les fonctionnalités.
            @endif
        </p>
        @if(!$isActif)
        <p class="banner-sub">{{ $pct }}% complété</p>
        <div class="completion-bar-wrap">
            <div class="completion-bar-fill" style="width: {{ $pct }}%"></div>
        </div>
        @endif
    </div>
</div>

<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
@csrf

<div class="profile-grid">

    {{-- ── LEFT COLUMN: avatar + meta ── --}}
    <div>
        <div class="profile-card avatar-zone">
            <div class="avatar-wrap">
                @if($user->photo_profil)
                    <img id="avatarPreview" src="{{ Storage::url($user->photo_profil) }}" class="avatar-img" alt="Photo de profil">
                @else
                    <div class="avatar-placeholder" id="avatarPlaceholder">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <img id="avatarPreview" src="" class="avatar-img" alt="" style="display:none;">
                @endif
                <div class="avatar-badge {{ $user->status }}" title="Statut : {{ ucfirst($user->status) }}">
                    <i class="fa-solid {{ $isActif ? 'fa-check' : 'fa-clock' }}"></i>
                </div>
            </div>

            <span style="font-size:.8125rem;font-weight:700;color:{{ $isActif ? '#10b981' : '#f59e0b' }}">
                <i class="fa-solid fa-circle" style="font-size:.5rem;vertical-align:middle;"></i>
                {{ ucfirst($user->status) }}
            </span>

            {{-- Photo de profil : import OU caméra, libre choix --}}
            <div class="photo-actions">
                <label class="btn-photo" for="photoInput">
                    <i class="fa-solid fa-upload"></i> Importer
                </label>
                <button type="button" class="btn-photo" onclick="openCamera('avatar')">
                    <i class="fa-solid fa-camera"></i> Caméra
                </button>
            </div>
            <input type="file" id="photoInput" name="photo_profil" accept="image/*" style="display:none">

            <div style="text-align:center;margin-top:8px;">
                <span style="font-size:.875rem;font-weight:700;color:var(--blue);">
                    <i class="fa-solid {{ $isLocal ? 'fa-house' : 'fa-plane-departure' }} me-1"></i>
                    {{ $user->profilLabel() }}
                </span>
                <br>
                <small style="color:var(--muted);font-size:.75rem;">{{ $user->mail }}</small>
            </div>

            @if($isLocal)
            <div style="margin-top:8px;">
                <p style="font-size:.75rem;font-weight:700;color:var(--muted);text-align:center;margin-bottom:6px;">CLASSEMENT</p>
                <div class="star-rating">
                    @for($i = 1; $i <= 5; $i++)
                        @php
                            $star = $user->classement_etoile ?? 0;
                            $full = $star >= $i;
                            $half = !$full && ($star >= $i - 0.5);
                        @endphp
                        @if($full)
                            <i class="fa-solid fa-star"></i>
                        @elseif($half)
                            <i class="fa-solid fa-star-half-stroke"></i>
                        @else
                            <i class="fa-regular fa-star empty"></i>
                        @endif
                    @endfor
                </div>
                @if($user->classement_etoile)
                    <p style="text-align:center;font-size:.75rem;color:var(--muted);margin-top:4px;">{{ number_format($user->classement_etoile,1) }} / 5</p>
                @else
                    <p style="text-align:center;font-size:.75rem;color:var(--muted);margin-top:4px;">Aucune note encore</p>
                @endif
            </div>
            @endif
        </div>
    </div>

    {{-- ── RIGHT COLUMN: form ── --}}
    <div style="display:flex;flex-direction:column;gap:24px;">

        {{-- Identity --}}
        <div class="profile-card">
            <p class="section-label"><i class="fa-solid fa-id-card"></i> Identité</p>

            <div class="field-group" style="margin-bottom:16px;">
                <div>
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $user->prenom) }}" placeholder="Votre prénom">
                </div>
                <div>
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom', $user->nom) }}" placeholder="Votre nom">
                </div>
            </div>

            <div class="field-group" style="margin-bottom:16px;">
                <div>
                    <label class="form-label">Pseudo <small style="color:var(--muted);">(visible publiquement)</small></label>
                    <input type="text" name="pseudo" class="form-control" value="{{ old('pseudo', $user->pseudo) }}" placeholder="@votre_pseudo">
                </div>
                <div>
                    <label class="form-label">Date de naissance</label>
                    <input type="date" name="date_naissance" class="form-control"
                        value="{{ old('date_naissance', optional($user->date_naissance)->format('Y-m-d')) }}">
                </div>
            </div>

            {{-- Sexe : lecture seule, déterminé uniquement par caméra en direct + DeepFace.
                 Aucune option d'import de fichier ici — empêche d'utiliser une photo
                 d'une autre personne pour usurper le sexe. --}}
            <div class="field-group" style="align-items:end;">
                <div>
                    <label class="form-label">
                        Sexe <i class="fa-solid fa-lock" style="font-size:.6875rem;color:var(--muted);" title="Déterminé automatiquement"></i>
                    </label>
                    <div class="sexe-readonly {{ !$user->sexe ? 'empty' : '' }}" id="sexeBox">
                        @if($user->sexe)
                            <i class="fa-solid fa-circle-check" style="color:#10b981;"></i>
                            {{ $sexeLabels[$user->sexe] ?? ucfirst($user->sexe) }}
                        @else
                            <i class="fa-regular fa-circle-question"></i>
                            Non déterminé
                        @endif
                        <i class="fa-solid fa-lock lock"></i>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn-detect" id="detectBtn" onclick="openCamera('verify')">
                        <i class="fa-solid fa-camera-retro"></i>
                        <span id="detectLabel">{{ $user->sexe ? 'Re-vérifier en direct' : 'Vérifier via caméra' }}</span>
                    </button>
                    <p id="detectResult" style="font-size:.75rem;color:var(--muted);margin-top:6px;display:none;"></p>
                </div>
            </div>
            <p class="detect-hint">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Pour la sécurité de la communauté, le sexe est déterminé uniquement via une capture caméra en direct — aucune photo importée n'est acceptée, afin d'éviter toute usurpation.</span>
            </p>
        </div>

        {{-- Contact --}}
        <div class="profile-card">
            <p class="section-label"><i class="fa-solid fa-phone"></i> Contact</p>
            <div class="field-group full">
                <div>
                    <label class="form-label">Téléphone</label>
                    <input type="tel" name="telephone" class="form-control" value="{{ old('telephone', $user->telephone) }}" placeholder="+33 6 00 00 00 00">
                </div>
            </div>
        </div>

        {{-- Interests --}}
        <div class="profile-card">
            <p class="section-label"><i class="fa-solid fa-heart"></i> Centres d'intérêt</p>
            <p style="font-size:.8125rem;color:var(--muted);margin-bottom:12px;">Sélectionnez tout ce qui vous correspond :</p>
            <div class="interests-grid" id="interestsGrid">
                @foreach($interests as $interest)
                    @php $checked = in_array($interest['label'], $selected) @endphp
                    <label class="interest-chip {{ $checked ? 'selected' : '' }}">
                        <input type="checkbox" name="centres_interet[]" value="{{ $interest['label'] }}" {{ $checked ? 'checked' : '' }}>
                        <i class="fa-solid {{ $interest['icon'] }} main-icon"></i>
                        <i class="fa-solid fa-check check-icon"></i>
                        {{ $interest['label'] }}
                    </label>
                @endforeach
            </div>
        </div>

        {{-- Bio (local only) --}}
        @if($isLocal)
        <div class="profile-card">
            <p class="section-label"><i class="fa-solid fa-pen-nib"></i> Bio <small style="font-size:.7rem;font-weight:400;color:var(--muted);">Visible par les voyageurs</small></p>
            <textarea name="bio" class="form-control" rows="5" maxlength="1000"
                placeholder="Présentez-vous : qui vous êtes, ce que vous aimez partager avec les voyageurs…">{{ old('bio', $user->bio) }}</textarea>
            <p style="font-size:.75rem;color:var(--muted);margin-top:6px;" id="bioCount">
                <span id="bioLen">{{ strlen($user->bio ?? '') }}</span>/1000 caractères
            </p>
        </div>
        @endif

        <div style="display:flex;justify-content:flex-end;">
            <button type="submit" class="btn-save">
                <i class="fa-solid fa-floppy-disk me-2"></i> Enregistrer le profil
            </button>
        </div>

    </div>
</div>
</form>

{{-- ── CAMERA MODAL (réutilisée : avatar OU vérification sexe) ── --}}
<div class="camera-modal-backdrop" id="cameraBackdrop">
    <div class="camera-modal">
        <h5 style="font-weight:800;margin-bottom:0;" id="cameraTitle">
            <i class="fa-solid fa-camera-retro"></i> Prendre une photo
        </h5>
        <p style="font-size:.8125rem;color:var(--muted);margin-top:4px;" id="cameraSubtitle">
            Centrez votre visage dans le cadre
        </p>
        <video id="cameraVideo" autoplay playsinline></video>
        <canvas id="cameraCanvas"></canvas>

        <div class="camera-analyzing" id="cameraAnalyzing">
            <i class="fa-solid fa-spinner"></i> Analyse en cours…
        </div>

        <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;" id="cameraActions">
            <button type="button" class="btn-save" onclick="capturePhoto()" id="captureBtn">
                <i class="fa-solid fa-camera"></i> Capturer
            </button>
            <button type="button" class="btn-photo" onclick="closeCamera()" style="padding:10px 22px;">
                Annuler
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.interest-chip').forEach(chip => {
    chip.addEventListener('click', () => {
        requestAnimationFrame(() => {
            const input = chip.querySelector('input[type="checkbox"]');
            chip.classList.toggle('selected', input.checked);
        });
    });
});

const bioArea = document.querySelector('[name="bio"]');
if (bioArea) {
    bioArea.addEventListener('input', () => {
        document.getElementById('bioLen').textContent = bioArea.value.length;
    });
}

document.getElementById('photoInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => setAvatarPreview(e.target.result);
    reader.readAsDataURL(file);
});

function setAvatarPreview(src) {
    const preview = document.getElementById('avatarPreview');
    const placeholder = document.getElementById('avatarPlaceholder');
    preview.src = src;
    preview.style.display = 'block';
    if (placeholder) placeholder.style.display = 'none';
}

// ── Caméra : deux modes ──────────────────────────────────────────────────
// 'avatar' : capture utilisée comme photo de profil (injectée dans #photoInput)
// 'verify' : capture envoyée directement à DeepFace, jamais stockée comme avatar
let stream = null;
let cameraMode = 'avatar';

async function openCamera(mode = 'avatar') {
    cameraMode = mode;

    const title    = document.getElementById('cameraTitle');
    const subtitle = document.getElementById('cameraSubtitle');
    const actions  = document.getElementById('cameraActions');
    const analyzing= document.getElementById('cameraAnalyzing');

    analyzing.classList.remove('active');
    actions.style.display = 'flex';

    if (mode === 'verify') {
        title.innerHTML = '<i class="fa-solid fa-shield-halved"></i> Vérification d\'identité';
        subtitle.textContent = 'Regardez la caméra, visage bien visible et éclairé';
    } else {
        title.innerHTML = '<i class="fa-solid fa-camera-retro"></i> Prendre une photo';
        subtitle.textContent = 'Centrez votre visage dans le cadre';
    }

    try {
        stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
        document.getElementById('cameraVideo').srcObject = stream;
        document.getElementById('cameraVideo').style.display = 'block';
        document.getElementById('cameraBackdrop').classList.add('open');
    } catch(e) {
        alert('Impossible d\'accéder à la caméra. Vérifiez les permissions de votre navigateur.');
    }
}

function closeCamera() {
    if (stream) { stream.getTracks().forEach(t => t.stop()); stream = null; }
    document.getElementById('cameraBackdrop').classList.remove('open');
    document.getElementById('cameraAnalyzing').classList.remove('active');
    document.getElementById('cameraActions').style.display = 'flex';
    document.getElementById('cameraVideo').style.display = 'block';
}

function capturePhoto() {
    const video  = document.getElementById('cameraVideo');
    const canvas = document.getElementById('cameraCanvas');
    canvas.width  = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    if (cameraMode === 'avatar') {
        canvas.toBlob(blob => {
            setAvatarPreview(canvas.toDataURL('image/jpeg'));
            const file = new File([blob], 'camera_photo.jpg', { type: 'image/jpeg' });
            const dt   = new DataTransfer();
            dt.items.add(file);
            document.getElementById('photoInput').files = dt.files;
            closeCamera();
        }, 'image/jpeg', .92);
        return;
    }

    // mode 'verify' : on envoie directement à DeepFace, sans rien stocker
    canvas.toBlob(blob => sendForGenderVerification(blob), 'image/jpeg', .92);
}

// ── Vérification du sexe : capture caméra → DeepFace directement ─────────
async function sendForGenderVerification(blob) {
    const video     = document.getElementById('cameraVideo');
    const actions   = document.getElementById('cameraActions');
    const analyzing = document.getElementById('cameraAnalyzing');
    const detectBtn = document.getElementById('detectBtn');
    const label     = document.getElementById('detectLabel');
    const result    = document.getElementById('detectResult');
    const sexeBox   = document.getElementById('sexeBox');

    // Affiche l'état "analyse en cours" dans la modal
    video.style.display = 'none';
    actions.style.display = 'none';
    analyzing.classList.add('active');

    detectBtn.disabled = true;
    result.style.display = 'none';

    const fd = new FormData();
    fd.append('image', blob, 'verification.jpg');
    fd.append('_token', '{{ csrf_token() }}');

    try {
        const resp = await fetch('{{ route("profile.detect-gender") }}', { method: 'POST', body: fd });
        const data = await resp.json();

        if (data.sexe) {
            const map = { homme: 'Homme', femme: 'Femme', autre: 'Autre / Non déterminé' };
            sexeBox.classList.remove('empty');
            sexeBox.innerHTML = `<i class="fa-solid fa-circle-check" style="color:#10b981;"></i> ${map[data.sexe]} <i class="fa-solid fa-lock lock"></i>`;
            result.textContent = `Sexe vérifié et enregistré : ${map[data.sexe]}.`;
            label.textContent = 'Re-vérifier en direct';
        } else {
            result.textContent = data.error || 'Vérification impossible. Réessayez avec un visage bien visible et éclairé.';
            label.textContent = 'Réessayer';
        }
    } catch(e) {
        result.textContent = 'Service de vérification indisponible. Réessayez plus tard.';
        label.textContent = 'Réessayer';
    }

    result.style.display = 'block';
    detectBtn.disabled = false;
    closeCamera();
}

document.getElementById('cameraBackdrop').addEventListener('click', function(e) {
    if (e.target === this) closeCamera();
});
</script>
@endpush