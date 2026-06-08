<footer class="ot-footer">
    <div class="container">

        {{-- TOP ROW --}}
        <div class="ot-footer-top">

            {{-- BRAND --}}
            <div class="ot-footer-brand">
                <img src="{{ asset('logo.png') }}" alt="OnlyTrip" class="ot-footer-logo">
                <p class="ot-footer-tagline">
                    La plateforme qui connecte les voyageurs<br>aux meilleurs prestataires locaux du monde.
                </p>
                <div class="ot-footer-socials">
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter/X"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>

            {{-- LINKS --}}
            <div class="ot-footer-col">
                <h4><i class="fa-solid fa-compass me-2"></i>Explorer</h4>
                <ul>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Destinations populaires</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Guides locaux</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Hébergements</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Expériences uniques</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Dernières offres</a></li>
                </ul>
            </div>

            <div class="ot-footer-col">
                <h4><i class="fa-solid fa-handshake me-2"></i>Prestataires</h4>
                <ul>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Devenir local</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Publier un service</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Espace pro</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Témoignages</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> FAQ prestataires</a></li>
                </ul>
            </div>

            <div class="ot-footer-col">
                <h4><i class="fa-solid fa-circle-info me-2"></i>À propos</h4>
                <ul>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Notre mission</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Équipe</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Blog</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Presse</a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Contact</a></li>
                </ul>
            </div>

        </div>

        {{-- NEWSLETTER --}}
        <div class="ot-footer-newsletter">
            <div class="ot-newsletter-text">
                <i class="fa-solid fa-paper-plane ot-newsletter-icon"></i>
                <div>
                    <strong>Restez inspiré</strong>
                    <span>Recevez les meilleures offres et destinations chaque semaine.</span>
                </div>
            </div>
            <div class="ot-newsletter-form">
                <input type="email" placeholder="votre@email.com">
                <button><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>

        {{-- BOTTOM ROW --}}
        <div class="ot-footer-bottom">
            <span>© {{ date('Y') }} OnlyTrip. Tous droits réservés.</span>
            <div class="ot-footer-legal">
                <a href="#">Confidentialité</a>
                <a href="#">CGU</a>
                <a href="#">Cookies</a>
            </div>
            <div class="ot-footer-payments">
                <i class="fa-brands fa-cc-visa" title="Visa"></i>
                <i class="fa-brands fa-cc-mastercard" title="Mastercard"></i>
                <i class="fa-brands fa-cc-paypal" title="PayPal"></i>
                <i class="fa-brands fa-cc-stripe" title="Stripe"></i>
            </div>
        </div>

    </div>
</footer>

<style>
.ot-footer {
    background: #0a0a0f;
    color: rgba(255,255,255,0.65);
    font-family: 'Nunito', sans-serif;
    margin-top: 5rem;
    padding: 4rem 0 0;
}

.ot-footer-top {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 3rem;
    padding-bottom: 3rem;
    border-bottom: 1px solid rgba(255,255,255,0.07);
}

@media (max-width: 992px) {
    .ot-footer-top { grid-template-columns: 1fr 1fr; gap: 2rem; }
    .ot-footer-brand { grid-column: 1 / -1; }
}
@media (max-width: 576px) {
    .ot-footer-top { grid-template-columns: 1fr; }
}

.ot-footer-logo {
    height: 48px;
    width: auto;
    object-fit: contain;
    margin-bottom: 1rem;
    display: block;
}

.ot-footer-tagline {
    font-size: 0.875rem;
    line-height: 1.7;
    color: rgba(255,255,255,0.45);
    margin-bottom: 1.25rem;
}

.ot-footer-socials {
    display: flex;
    gap: 10px;
}
.ot-footer-socials a {
    width: 36px; height: 36px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.12);
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,0.5);
    font-size: 14px;
    text-decoration: none;
    transition: border-color 0.2s, color 0.2s, background 0.2s;
}
.ot-footer-socials a:hover {
    border-color: #3b82f6;
    color: #fff;
    background: rgba(59,130,246,0.15);
}

.ot-footer-col h4 {
    font-size: 0.8125rem;
    font-weight: 800;
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
}
.ot-footer-col h4 i { color: #3b82f6; }

.ot-footer-col ul {
    list-style: none;
    padding: 0; margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.ot-footer-col ul li a {
    font-size: 0.875rem;
    color: rgba(255,255,255,0.5);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 7px;
    transition: color 0.2s;
}
.ot-footer-col ul li a i {
    font-size: 10px;
    color: rgba(255,255,255,0.2);
    transition: color 0.2s;
}
.ot-footer-col ul li a:hover { color: #fff; }
.ot-footer-col ul li a:hover i { color: #3b82f6; }

/* ── NEWSLETTER ── */
.ot-footer-newsletter {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    padding: 1.75rem 2rem;
    background: rgba(59,130,246,0.08);
    border: 1px solid rgba(59,130,246,0.18);
    border-radius: 16px;
    margin: 2.5rem 0;
    flex-wrap: wrap;
}

.ot-newsletter-text {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.ot-newsletter-icon {
    font-size: 1.5rem;
    color: #3b82f6;
    flex-shrink: 0;
}
.ot-newsletter-text strong {
    display: block;
    font-size: 0.9375rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 2px;
}
.ot-newsletter-text span {
    font-size: 0.8125rem;
    color: rgba(255,255,255,0.5);
}

.ot-newsletter-form {
    display: flex;
    gap: 0;
    flex-shrink: 0;
}
.ot-newsletter-form input {
    padding: 10px 18px;
    border: 1px solid rgba(255,255,255,0.12);
    border-right: none;
    border-radius: 100px 0 0 100px;
    background: rgba(255,255,255,0.06);
    color: #fff;
    font-family: 'Nunito', sans-serif;
    font-size: 0.875rem;
    outline: none;
    width: 240px;
    transition: border-color 0.2s;
}
.ot-newsletter-form input::placeholder { color: rgba(255,255,255,0.25); }
.ot-newsletter-form input:focus { border-color: rgba(59,130,246,0.5); }
.ot-newsletter-form button {
    padding: 10px 18px;
    background: #3b82f6;
    border: none;
    border-radius: 0 100px 100px 0;
    color: #fff;
    cursor: pointer;
    font-size: 0.875rem;
    transition: background 0.2s;
}
.ot-newsletter-form button:hover { background: #1d4ed8; }

@media (max-width: 768px) {
    .ot-footer-newsletter { flex-direction: column; align-items: flex-start; padding: 1.25rem; }
    .ot-newsletter-form { width: 100%; }
    .ot-newsletter-form input { flex: 1; width: auto; }
}

/* ── BOTTOM ── */
.ot-footer-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    padding: 1.5rem 0;
    border-top: 1px solid rgba(255,255,255,0.07);
    font-size: 0.8125rem;
    color: rgba(255,255,255,0.3);
}

.ot-footer-legal {
    display: flex;
    gap: 1.5rem;
}
.ot-footer-legal a {
    color: rgba(255,255,255,0.3);
    text-decoration: none;
    transition: color 0.2s;
}
.ot-footer-legal a:hover { color: #fff; }

.ot-footer-payments {
    display: flex;
    gap: 10px;
    font-size: 1.5rem;
    color: rgba(255,255,255,0.25);
}
.ot-footer-payments i:hover { color: rgba(255,255,255,0.6); }

@media (max-width: 576px) {
    .ot-footer-bottom { flex-direction: column; align-items: center; text-align: center; }
    .ot-footer-legal { flex-wrap: wrap; justify-content: center; }
}
</style>