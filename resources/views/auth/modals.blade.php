{{-- ═══════════════════════════════════════════
     ALERTES (erreurs / succès)
════════════════════════════════════════════ --}}
@if($errors->any())
<div class="alert alert-danger position-fixed top-0 start-50 translate-middle-x mt-3 shadow" style="z-index:2000;">
    @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

@if(session('success'))
<div class="alert alert-success position-fixed top-0 start-50 translate-middle-x mt-3 shadow" style="z-index:2000;">
    {{ session('success') }}
</div>
@endif

{{-- ═══════════════════════════════════════════
     CONNEXION MODAL
════════════════════════════════════════════ --}}
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mx-auto" style="max-width:440px; width:calc(100% - 2rem);">
        <div class="modal-content ot-modal">

            <button type="button" class="ot-modal-close" data-bs-dismiss="modal" aria-label="Fermer">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="ot-modal-logo">
                <img src="{{ asset('logo.png') }}" alt="OnlyTrip">
            </div>

            <h2 class="ot-modal-title" id="loginModalLabel">Bon retour !</h2>
            <p class="ot-modal-sub">Connectez-vous avec votre email, nous vous envoyons un code</p>

            <form method="POST" action="{{ route('login.send') }}">
                @csrf
                <div class="ot-field">
                    <label><i class="fa-solid fa-envelope me-1"></i> Adresse email</label>
                    <input type="email" name="mail" placeholder="vous@exemple.com" required value="{{ old('mail') }}">
                </div>

                <button type="submit" class="ot-btn-primary">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Recevoir le code
                </button>
            </form>

            <p class="ot-modal-footer-text mt-3">
                Pas encore de compte ?
                <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">S'inscrire</a>
            </p>

        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════
     INSCRIPTION MODAL
════════════════════════════════════════════ --}}
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mx-auto" style="max-width:480px; width:calc(100% - 2rem);">
        <div class="modal-content ot-modal">

            <button type="button" class="ot-modal-close" data-bs-dismiss="modal" aria-label="Fermer">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="ot-modal-logo">
                <img src="{{ asset('logo.png') }}" alt="OnlyTrip">
            </div>

            {{-- ÉTAPE 1 : choix du rôle --}}
            <div id="reg-step-role">
                <h2 class="ot-modal-title" id="registerModalLabel">Rejoindre OnlyTrip</h2>
                <p class="ot-modal-sub">Vous êtes…</p>

                <div class="ot-role-grid">
                    <button type="button" class="ot-role-card" onclick="otSelectRole(1)">
                        <i class="fa-solid fa-plane-departure ot-role-icon"></i>
                        <div class="ot-role-name">Voyageur</div>
                        <div class="ot-role-desc">Je cherche des expériences locales authentiques</div>
                    </button>
                    <button type="button" class="ot-role-card" onclick="otSelectRole(0)">
                        <i class="fa-solid fa-house ot-role-icon"></i>
                        <div class="ot-role-name">Local</div>
                        <div class="ot-role-desc">Je propose mes services aux voyageurs</div>
                    </button>
                </div>
            </div>

            {{-- ÉTAPE 2 : email (commun voyageur/local) --}}
            <div id="reg-step-email" style="display:none;">
                <button type="button" class="ot-back-btn" onclick="otShowStep('role')">
                    <i class="fa-solid fa-arrow-left me-1"></i> Retour
                </button>

                <div class="ot-role-badge voyageur" id="reg-role-badge-voyageur">
                    <i class="fa-solid fa-plane-departure"></i> Voyageur
                </div>
                <div class="ot-role-badge local" id="reg-role-badge-local" style="display:none;">
                    <i class="fa-solid fa-house"></i> Local
                </div>

                <h2 class="ot-modal-title">Créer mon compte</h2>
                <p class="ot-modal-sub">Entrez votre email pour recevoir un code de vérification</p>

                <form method="POST" action="{{ route('register.send') }}">
                    @csrf
                    <input type="hidden" name="profil" id="reg-profil-input" value="1">

                    <div class="ot-field">
                        <label><i class="fa-solid fa-envelope me-1"></i> Adresse email</label>
                        <input type="email" name="mail" placeholder="vous@exemple.com" required value="{{ old('mail') }}">
                    </div>

                    <button type="submit" class="ot-btn-primary">
                        <i class="fa-solid fa-user-plus me-2"></i> Recevoir le code
                    </button>
                </form>
            </div>

            <p class="ot-modal-footer-text">
                Déjà un compte ?
                <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">Se connecter</a>
            </p>

        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════
     OTP MODAL (commun inscription / connexion)
════════════════════════════════════════════ --}}
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mx-auto" style="max-width:420px; width:calc(100% - 2rem);">
        <div class="modal-content ot-modal">

            <button type="button" class="ot-modal-close" data-bs-dismiss="modal" aria-label="Fermer">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="ot-modal-logo">
                <img src="{{ asset('logo.png') }}" alt="OnlyTrip">
            </div>

            <h2 class="ot-modal-title" id="otpModalLabel">Vérification</h2>
            <p class="ot-modal-sub">
                Un code à 6 chiffres a été envoyé à<br>
                <strong>{{ session('otp_email') }}</strong>
            </p>

            <form method="POST" action="{{ route('otp.verify') }}">
                @csrf
                <div class="ot-field">
                    <label><i class="fa-solid fa-key me-1"></i> Code de vérification</label>
                    <input type="text" name="otp_code" maxlength="6" inputmode="numeric"
                           placeholder="------" required
                           style="text-align:center; letter-spacing:10px; font-size:1.25rem; font-weight:700;">
                </div>

                <button type="submit" class="ot-btn-primary">
                    <i class="fa-solid fa-circle-check me-2"></i> Vérifier
                </button>
            </form>
        </div>
    </div>
</div>

<style>
.ot-modal {
    border: none;
    border-radius: 20px;
    padding: 2rem 2rem 1.5rem;
    position: relative;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12);
}
@media (max-width: 480px) {
    .ot-modal { padding: 1.5rem 1.25rem 1.25rem; border-radius: 16px; }
}

.ot-modal-close {
    position: absolute;
    top: 1rem; right: 1rem;
    background: #f3f4f6;
    border: none;
    border-radius: 50%;
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    color: #6b7280;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
}
.ot-modal-close:hover { background: #e5e7eb; color: #111; }

.ot-modal-logo {
    text-align: center;
    margin-bottom: 1.25rem;
}
.ot-modal-logo img {
    height: 52px;
    width: auto;
    object-fit: contain;
}

.ot-modal-title {
    font-family: 'Nunito', sans-serif;
    font-size: 1.375rem;
    font-weight: 800;
    color: #0a0a0f;
    text-align: center;
    margin: 0 0 6px;
    letter-spacing: -0.01em;
}

.ot-modal-sub {
    font-size: 0.875rem;
    color: #6b7280;
    text-align: center;
    margin-bottom: 1.5rem;
}

.ot-field { margin-bottom: 14px; }
.ot-field label {
    display: block;
    font-size: 0.8125rem;
    font-weight: 700;
    color: #374151;
    margin-bottom: 6px;
    font-family: 'Nunito', sans-serif;
}
.ot-field input {
    width: 100%;
    padding: 11px 16px;
    border: 1.5px solid #e5e7eb;
    border-radius: 10px;
    font-family: 'Nunito', sans-serif;
    font-size: 0.9375rem;
    color: #0a0a0f;
    background: #f9fafb;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
}
.ot-field input:focus {
    border-color: #3b82f6;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
}
.ot-field input::placeholder { color: #9ca3af; }

.ot-btn-primary {
    width: 100%;
    padding: 12px;
    background: #3b82f6;
    color: #fff;
    border: none;
    border-radius: 100px;
    font-family: 'Nunito', sans-serif;
    font-size: 0.9375rem;
    font-weight: 700;
    cursor: pointer;
    margin-top: 6px;
    transition: background 0.2s, transform 0.15s;
}
.ot-btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); }
.ot-btn-primary:active { transform: translateY(0); }

.ot-modal-footer-text {
    text-align: center;
    font-size: 0.8125rem;
    color: #6b7280;
    margin: 1rem 0 0;
}
.ot-modal-footer-text a {
    color: #3b82f6;
    font-weight: 700;
    text-decoration: none;
}
.ot-modal-footer-text a:hover { text-decoration: underline; }

.ot-role-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 1.5rem;
}
@media (max-width: 380px) {
    .ot-role-grid { grid-template-columns: 1fr; }
}

.ot-role-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 1.5rem 1rem;
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: 14px;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s, transform 0.15s;
}
.ot-role-card:hover {
    border-color: #3b82f6;
    background: #eff6ff;
    transform: translateY(-2px);
}

.ot-role-icon {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #3b82f6;
}
.ot-role-card:nth-child(2) .ot-role-icon { color: #16a34a; }

.ot-role-name {
    font-size: 1rem;
    font-weight: 800;
    color: #0a0a0f;
    font-family: 'Nunito', sans-serif;
    margin-bottom: 6px;
}
.ot-role-desc {
    font-size: 0.75rem;
    color: #6b7280;
    line-height: 1.4;
}

.ot-role-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    font-family: 'Nunito', sans-serif;
    padding: 4px 12px;
    border-radius: 100px;
    margin-bottom: 12px;
}
.ot-role-badge.voyageur { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
.ot-role-badge.local    { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }

.ot-back-btn {
    background: none;
    border: none;
    padding: 0;
    font-family: 'Nunito', sans-serif;
    font-size: 0.8125rem;
    font-weight: 600;
    color: #6b7280;
    cursor: pointer;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    transition: color 0.2s;
}
.ot-back-btn:hover { color: #0a0a0f; }
</style>

<script>
// Navigation entre les étapes de l'inscription
function otShowStep(step) {
    ['role','email'].forEach(s => {
        const el = document.getElementById('reg-step-' + s);
        if (el) el.style.display = 'none';
    });
    const target = document.getElementById('reg-step-' + step);
    if (target) target.style.display = 'block';
}

// Choix du rôle : 1 = voyageur, 0 = local
function otSelectRole(profil) {
    document.getElementById('reg-profil-input').value = profil;

    const badgeVoyageur = document.getElementById('reg-role-badge-voyageur');
    const badgeLocal    = document.getElementById('reg-role-badge-local');

    if (profil === 1) {
        badgeVoyageur.style.display = 'inline-flex';
        badgeLocal.style.display = 'none';
    } else {
        badgeVoyageur.style.display = 'none';
        badgeLocal.style.display = 'inline-flex';
    }

    otShowStep('email');
}

document.getElementById('registerModal').addEventListener('hidden.bs.modal', function () {
    otShowStep('role');
});

// Ouverture automatique des modals selon la session/erreurs Laravel
document.addEventListener('DOMContentLoaded', function () {
    @if(session('otp_sent'))
        ['loginModal', 'registerModal'].forEach(function (id) {
            var el = document.getElementById(id);
            var instance = bootstrap.Modal.getInstance(el);
            if (instance) instance.hide();
        });
        new bootstrap.Modal(document.getElementById('otpModal')).show();
    @elseif(session('open_modal'))
        new bootstrap.Modal(document.getElementById('{{ session('open_modal') }}')).show();
    @elseif($errors->has('otp_code'))
        new bootstrap.Modal(document.getElementById('otpModal')).show();
    @endif
});
</script>