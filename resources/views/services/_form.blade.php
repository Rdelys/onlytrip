{{-- resources/views/services/_form.blade.php --}}
{{-- Variables attendues : $service (null ou Service), $categories, $typesTarif, $mode ('add'|'edit') --}}

@php
    $uid = $mode === 'edit' ? $service->id : 'new';
@endphp

<style>
    .sv-modal-scrollable {
        max-height: 70vh;
        overflow-y: auto;
        padding-right: 10px;
        scroll-behavior: smooth;
    }
    
    .sv-modal-scrollable::-webkit-scrollbar {
        width: 6px;
    }
    
    .sv-modal-scrollable::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    .sv-modal-scrollable::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }
    
    .sv-modal-scrollable::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<div class="sv-modal-scrollable">
    {{-- ── Infos essentielles ── --}}
    <div class="sv-section-label">
        <i class="fa-solid fa-star text-primary"></i> Infos essentielles
    </div>

    <div class="mb-3">
        <label class="sv-form-label">Titre du service <span>*</span></label>
        <input type="text" name="titre" class="sv-form-control"
               placeholder="Ex : Cours de cuisine traditionnelle"
               value="{{ old('titre', $service->titre ?? '') }}" required maxlength="200">
    </div>

    <div class="mb-3">
        <label class="sv-form-label">Description détaillée <span>*</span></label>
        <textarea name="description" class="sv-form-control" rows="4"
                  placeholder="Décrivez votre service, ce qui rend votre expérience unique, le déroulement…"
                  required maxlength="3000">{{ old('description', $service->description ?? '') }}</textarea>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="sv-form-label">Catégorie <span>*</span></label>
            <select name="categorie" class="sv-form-control" required>
                <option value="">-- Choisir --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}"
                        {{ old('categorie', $service->categorie ?? '') === $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="sv-form-label">Tarif <span>*</span></label>
            <div class="sv-tarif-group">
                <input type="number" name="tarif" class="sv-form-control"
                       placeholder="Prix (€)"
                       value="{{ old('tarif', $service->tarif ?? '') }}"
                       min="0" step="0.01" required>
                <select name="type_tarif" class="sv-form-control" required>
                    @foreach($typesTarif as $key => $label)
                        <option value="{{ $key }}"
                            {{ old('type_tarif', $service->type_tarif ?? 'journee') === $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- ── Bonus inclus ── --}}
    <div class="mb-3">
        <label class="sv-form-label">Bonus / Ce qui est inclus</label>
        <textarea name="bonus" class="sv-form-control" rows="2"
                  placeholder="Ex : Transport, repas, matériel, eau…"
                  maxlength="1500">{{ old('bonus', $service->bonus ?? '') }}</textarea>
        <p class="sv-bonus-hint">
            <i class="fa-solid fa-circle-info me-1"></i>Séparez les éléments par une virgule pour un affichage sous forme de liste.
        </p>
    </div>

    {{-- ── Détails ── --}}
    <div class="sv-section-label">
        <i class="fa-solid fa-circle-info text-primary"></i> Détails pratiques
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="sv-form-label">Durée estimée</label>
            <input type="text" name="duree" class="sv-form-control"
                   placeholder="Ex : 3 heures, Journée complète"
                   value="{{ old('duree', $service->duree ?? '') }}" maxlength="150">
        </div>
        <div class="col-md-6">
            <label class="sv-form-label">Personnes maximum</label>
            <input type="number" name="max_personnes" class="sv-form-control"
                   placeholder="Ex : 8"
                   value="{{ old('max_personnes', $service->max_personnes ?? '') }}"
                   min="1" max="500">
        </div>
    </div>

    <div class="mb-3">
        <label class="sv-form-label">Langues parlées</label>
        <input type="text" name="langues" class="sv-form-control"
               placeholder="Ex : Français, Anglais, Espagnol"
               value="{{ old('langues', $service->langues ?? '') }}" maxlength="250">
    </div>

    {{-- ── Localisation (sans adresse précise) ── --}}
    <div class="sv-section-label">
        <i class="fa-solid fa-location-dot text-primary"></i> Localisation
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="sv-form-label">Ville</label>
            <input type="text" name="ville" class="sv-form-control"
                   placeholder="Ex : Marrakech"
                   value="{{ old('ville', $service->ville ?? '') }}" maxlength="100">
        </div>
        <div class="col-md-6">
            <label class="sv-form-label">Pays</label>
            <input type="text" name="pays" class="sv-form-control"
                   placeholder="Ex : Maroc"
                   value="{{ old('pays', $service->pays ?? '') }}" maxlength="100">
        </div>
    </div>

    {{-- ── Photos ── --}}
    <div class="sv-section-label">
        <i class="fa-regular fa-images text-primary"></i> Photos d'illustration
        <small class="text-muted">(max 6 · JPEG / PNG / WebP · 4 Mo)</small>
    </div>

    @if($mode === 'edit' && !empty($service->photos))
        <p class="sv-bonus-hint mb-2">Photos actuelles — cochez pour supprimer :</p>
        <div class="sv-photos-preview mb-3">
            @foreach($service->photos as $path)
            <div class="sv-photo-thumb">
                <img src="{{ asset('storage/' . $path) }}" alt="Photo">
                <label title="Supprimer">
                    <input type="checkbox" name="photos_delete[]" value="{{ $path }}">
                    <button type="button" class="sv-rm-photo"
                            onclick="this.previousElementSibling.checked = !this.previousElementSibling.checked; this.parentElement.parentElement.style.opacity = this.previousElementSibling.checked ? '0.4' : '1'">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </label>
            </div>
            @endforeach
        </div>
    @endif

    <label class="sv-photo-zone" for="photoInput{{ $uid }}">
        <i class="fa-regular fa-cloud-arrow-up"></i>
        <p>Cliquez ou glissez-déposez vos photos ici</p>
        <input type="file" id="photoInput{{ $uid }}"
               name="{{ $mode === 'edit' ? 'photos_new[]' : 'photos[]' }}"
               multiple accept="image/*"
               class="sv-photo-input" data-preview="preview{{ $uid }}">
    </label>
    <div class="sv-photos-preview mt-2" id="preview{{ $uid }}"></div>
</div>