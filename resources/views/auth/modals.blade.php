{{-- LOGIN MODAL --}}
{{-- LOGIN MODAL --}}
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4" style="border-radius:15px;">

            <h4 class="text-center mb-3">
                🔐 Connexion à OnlyTrip
            </h4>

            <p class="text-center text-muted small">
                Entrez votre email pour continuer
            </p>

            {{-- EMAIL ONLY --}}
            <input type="email"
                   class="form-control form-control-lg my-2"
                   placeholder="Votre email">

            <button class="btn btn-primary btn-lg w-100 mt-2">
                Continuer
            </button>

            <div class="text-center my-3 text-muted">
                ou
            </div>

            {{-- SOCIAL LOGIN --}}
            <button class="btn btn-outline-danger w-100 mb-2">
                <i class="fa-brands fa-google me-2"></i>
                Continuer avec Google
            </button>

            <button class="btn btn-dark w-100">
                <i class="fa-brands fa-apple me-2"></i>
                Continuer avec Apple
            </button>

        </div>
    </div>
</div>

{{-- REGISTER MODAL --}}
{{-- REGISTER MODAL --}}
<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4" style="border-radius:15px;">

            <h4 class="text-center mb-3">
                🌍 Rejoindre OnlyTrip
            </h4>

            <p class="text-center text-muted small">
                Créez votre compte avec votre email
            </p>

            {{-- NAME + EMAIL --}}
            <input type="text"
                   class="form-control form-control-lg my-2"
                   placeholder="Nom complet">

            <input type="email"
                   class="form-control form-control-lg my-2"
                   placeholder="Adresse email">

            <button class="btn btn-warning btn-lg w-100 mt-2">
                Créer mon compte
            </button>

            <div class="text-center my-3 text-muted">
                ou
            </div>

            {{-- SOCIAL --}}
            <button class="btn btn-outline-danger w-100 mb-2">
                <i class="fa-brands fa-google me-2"></i>
                S’inscrire avec Google
            </button>

            <button class="btn btn-dark w-100">
                <i class="fa-brands fa-apple me-2"></i>
                S’inscrire avec Apple
            </button>

        </div>
    </div>
</div>