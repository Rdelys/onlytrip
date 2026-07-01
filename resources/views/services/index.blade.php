{{-- resources/views/services/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Mes Services — OnlyTrip')

@push('styles')
<style>
/* ── PAGE WRAPPER ── */
.sv-page { 
    padding: 1.5rem 1rem 3rem; 
    max-width: 1400px;
    margin: 0 auto;
}

/* ── PAGE HEADER ── */
.sv-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}
.sv-header-left h1 {
    font-family: 'Nunito', sans-serif;
    font-size: clamp(1.25rem, 4vw, 1.75rem);
    font-weight: 800;
    color: #0a0a0f;
    margin-bottom: 4px;
    letter-spacing: -0.02em;
}
.sv-header-left p { 
    color: #6b7280; 
    font-size: clamp(0.8125rem, 1.5vw, 0.9375rem); 
    margin: 0; 
}

/* ── ALERT ── */
.sv-alert {
    padding: 12px 18px;
    border-radius: 12px;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Nunito', sans-serif;
    flex-wrap: wrap;
    word-break: break-word;
}
.sv-alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
.sv-alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

/* ── STATS ── */
.sv-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 12px;
    margin-bottom: 2.5rem;
}
.sv-stat-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 1rem 1.25rem;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: transform 0.2s, box-shadow 0.2s;
}
.sv-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.sv-stat-icon {
    width: 40px; 
    height: 40px;
    border-radius: 10px;
    display: flex; 
    align-items: center; 
    justify-content: center;
    flex-shrink: 0;
    font-size: 1rem;
}
.sv-stat-icon.blue   { background: #eff6ff; color: #3b82f6; }
.sv-stat-icon.green  { background: #d1fae5; color: #10b981; }
.sv-stat-icon.orange { background: #fff7ed; color: #f97316; }
.sv-stat-icon.red    { background: #fee2e2; color: #ef4444; }
.sv-stat-body strong {
    display: block;
    font-size: clamp(1.125rem, 2.5vw, 1.375rem);
    font-weight: 800;
    color: #0a0a0f;
    font-family: 'Nunito', sans-serif;
    line-height: 1.2;
    margin-bottom: 2px;
}
.sv-stat-body span { 
    font-size: 0.7rem; 
    color: #9ca3af; 
    font-family: 'Nunito', sans-serif; 
    display: block;
}

/* ── SERVICES GRID ── */
.sv-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 2rem;
}

/* ── SERVICE CARD ── */
.sv-card {
    background: #fff;
    border: 1.5px solid #e5e7eb;
    border-radius: 18px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
    position: relative;
}
.sv-card:hover { 
    transform: translateY(-4px); 
    box-shadow: 0 12px 35px rgba(59,130,246,0.12); 
    border-color: #bfdbfe; 
}
.sv-card.inactive { opacity: 0.6; }

/* Badge disponibilité */
.sv-card-status {
    position: absolute;
    top: 12px; 
    right: 12px;
    font-size: 0.6rem;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 100px;
    font-family: 'Nunito', sans-serif;
    letter-spacing: 0.05em;
    z-index: 2;
    backdrop-filter: blur(4px);
    background: rgba(255,255,255,0.9);
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.sv-card-status.actif   { background: #d1fae5; color: #065f46; }
.sv-card-status.inactif { background: #fee2e2; color: #991b1b; }

/* Photo */
.sv-card-img { 
    position: relative; 
    overflow: hidden;
}
.sv-card-img img { 
    width: 100%; 
    height: 200px; 
    object-fit: cover; 
    display: block; 
    transition: transform 0.4s ease;
}
.sv-card:hover .sv-card-img img {
    transform: scale(1.03);
}
.sv-card-cat {
    position: absolute;
    bottom: -10px; 
    left: 14px;
    background: #3b82f6; 
    color: #fff;
    font-size: 0.6rem; 
    font-weight: 700;
    padding: 3px 12px; 
    border-radius: 100px;
    letter-spacing: 0.05em;
    font-family: 'Nunito', sans-serif;
    box-shadow: 0 2px 8px rgba(59,130,246,0.25);
}

/* Body */
.sv-card-body { 
    padding: 1rem 1.125rem 0.875rem; 
    flex: 1; 
}
.sv-card-title {
    font-family: 'Nunito', sans-serif;
    font-size: clamp(0.875rem, 1.5vw, 0.9375rem);
    font-weight: 800;
    color: #0a0a0f;
    margin: 0.5rem 0 0.4rem;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.sv-card-desc {
    font-size: 0.8rem;
    color: #6b7280;
    line-height: 1.5;
    margin-bottom: 0.75rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    font-family: 'Nunito', sans-serif;
}
.sv-card-meta {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    font-size: 0.7rem;
    color: #9ca3af;
    font-family: 'Nunito', sans-serif;
    margin-bottom: 0.75rem;
}
.sv-card-meta span { 
    display: flex; 
    align-items: center; 
    gap: 4px; 
}
.sv-card-meta i { 
    color: #3b82f6; 
    font-size: 10px; 
}

.sv-card-price {
    font-family: 'Nunito', sans-serif;
    font-size: clamp(1rem, 2vw, 1.125rem);
    font-weight: 800;
    color: #0a0a0f;
    margin-bottom: 0.875rem;
}
.sv-card-price span { 
    font-size: 0.7rem; 
    font-weight: 500; 
    color: #9ca3af; 
}

/* Actions */
.sv-card-actions {
    display: flex;
    gap: 8px;
    padding: 0 1.125rem 1rem;
    flex-wrap: wrap;
}
.sv-btn-sm {
    flex: 1;
    min-width: 70px;
    font-family: 'Nunito', sans-serif;
    font-size: clamp(0.65rem, 1.2vw, 0.75rem);
    font-weight: 700;
    border: none;
    border-radius: 100px;
    padding: 8px 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    transition: all 0.25s ease;
    min-width: 0;
    white-space: nowrap;
}
.sv-btn-sm i { font-size: 0.8rem; }
.sv-btn-edit    { background: #eff6ff; color: #1d4ed8; }
.sv-btn-edit:hover { background: #dbeafe; transform: scale(1.02); }
.sv-btn-toggle  { background: #f3f4f6; color: #374151; }
.sv-btn-toggle:hover { background: #e5e7eb; transform: scale(1.02); }
.sv-btn-delete  { 
    background: #fee2e2; 
    color: #b91c1c; 
    flex: 0 0 auto;
    padding: 8px 14px;
}
.sv-btn-delete:hover { background: #fecaca; transform: scale(1.05); }

/* ── EMPTY STATE ── */
.sv-empty {
    text-align: center;
    padding: 3rem 1.5rem;
    background: #fff;
    border: 2px dashed #e5e7eb;
    border-radius: 20px;
    transition: border-color 0.3s ease;
}
.sv-empty:hover {
    border-color: #bfdbfe;
}
.sv-empty i { 
    font-size: clamp(2.5rem, 5vw, 3rem); 
    color: #d1d5db; 
    margin-bottom: 1rem; 
    display: block; 
}
.sv-empty h3 {
    font-family: 'Nunito', sans-serif;
    font-size: clamp(1rem, 2vw, 1.125rem);
    font-weight: 800;
    color: #0a0a0f;
    margin-bottom: 8px;
}
.sv-empty p { 
    color: #6b7280; 
    font-size: clamp(0.8rem, 1.2vw, 0.9rem); 
    margin-bottom: 1.5rem; 
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

/* ── BOUTON MODERNISÉ ── */
.sv-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 24px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: #fff;
    border: none;
    border-radius: 50px;
    font-family: 'Nunito', sans-serif;
    font-size: clamp(0.8rem, 1.2vw, 0.875rem);
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 14px rgba(59, 130, 246, 0.25);
    position: relative;
    overflow: hidden;
    text-decoration: none;
}
.sv-btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}
.sv-btn-primary:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 6px 24px rgba(59, 130, 246, 0.35);
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: #fff;
}
.sv-btn-primary:hover::before {
    left: 100%;
}
.sv-btn-primary:active {
    transform: translateY(0) scale(0.98);
}
.sv-btn-primary i {
    font-size: 1rem;
    transition: transform 0.3s ease;
}
.sv-btn-primary:hover i {
    transform: rotate(90deg) scale(1.1);
}

/* Version petite */
.sv-btn-primary-sm {
    padding: 8px 18px;
    font-size: clamp(0.7rem, 1vw, 0.8rem);
    box-shadow: 0 3px 10px rgba(59, 130, 246, 0.2);
}
.sv-btn-primary-sm i {
    font-size: 0.85rem;
}

/* ── MODAL CORRIGÉ ── */
.modal-dialog {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: calc(100% - 1rem);
    margin: 0.5rem auto;
}

.modal {
    text-align: left;
}

.modal-dialog-centered {
    display: flex;
    align-items: center;
    min-height: calc(100% - 1rem);
}

.sv-modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    max-height: 90vh;
    margin: 0 auto;
    width: 100%;
}

.modal-header {
    padding: 1.25rem 1.5rem 0.5rem;
}

.modal-body {
    padding: 1rem 1.5rem;
    max-height: calc(90vh - 180px);
    overflow-y: auto;
}

.modal-footer {
    padding: 0.75rem 1.5rem 1.25rem;
}

.sv-modal-title {
    font-family: 'Nunito', sans-serif;
    font-size: clamp(1rem, 2vw, 1.125rem);
    font-weight: 800;
    color: #0a0a0f;
}

/* ── FORMULAIRE ── */
.sv-form-label {
    font-family: 'Nunito', sans-serif;
    font-size: clamp(0.75rem, 1.2vw, 0.8125rem);
    font-weight: 700;
    color: #374151;
    margin-bottom: 5px;
    display: block;
}
.sv-form-label span { color: #ef4444; margin-left: 2px; }
.sv-form-control {
    width: 100%;
    border: 1.5px solid #e5e7eb;
    border-radius: 10px;
    padding: 9px 13px;
    font-family: 'Nunito', sans-serif;
    font-size: clamp(0.8rem, 1.2vw, 0.875rem);
    color: #0a0a0f;
    transition: border-color 0.2s, box-shadow 0.2s;
    outline: none;
    background: #fff;
}
.sv-form-control:focus { 
    border-color: #3b82f6; 
    box-shadow: 0 0 0 4px rgba(59,130,246,0.12); 
}
select.sv-form-control { 
    appearance: none; 
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); 
    background-repeat: no-repeat; 
    background-position: right 10px center; 
    background-size: 16px; 
    padding-right: 32px; 
    cursor: pointer;
}
.sv-form-control::placeholder {
    color: #b0b5bf;
    font-weight: 400;
}

/* Prix inline */
.sv-tarif-group { 
    display: flex; 
    gap: 10px; 
}
.sv-tarif-group .sv-form-control:first-child { flex: 0 0 120px; }
.sv-tarif-group .sv-form-control:last-child  { flex: 1; }

/* Photo upload zone */
.sv-photo-zone {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 1.5rem 1rem;
    text-align: center;
    transition: border-color 0.3s ease, background 0.3s ease, transform 0.2s ease;
    cursor: pointer;
    background: #f9fafb;
}
.sv-photo-zone:hover { 
    border-color: #3b82f6; 
    background: #eff6ff; 
    transform: scale(1.01);
}
.sv-photo-zone i { 
    font-size: clamp(1.25rem, 2vw, 1.5rem); 
    color: #9ca3af; 
    display: block; 
    margin-bottom: 6px; 
}
.sv-photo-zone p { 
    font-size: clamp(0.7rem, 1.2vw, 0.8125rem); 
    color: #6b7280; 
    margin: 0; 
    font-family: 'Nunito', sans-serif; 
}
.sv-photo-zone input[type="file"] { display: none; }

/* Preview photos */
.sv-photos-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}
.sv-photo-thumb {
    position: relative;
    width: clamp(60px, 8vw, 70px);
    height: clamp(60px, 8vw, 70px);
    flex-shrink: 0;
}
.sv-photo-thumb img {
    width: 100%; 
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    transition: border-color 0.2s;
}
.sv-photo-thumb:hover img {
    border-color: #3b82f6;
}
.sv-photo-thumb .sv-rm-photo {
    position: absolute;
    top: -5px; 
    right: -5px;
    width: 18px; 
    height: 18px;
    background: #ef4444; 
    color: #fff;
    border: none; 
    border-radius: 50%;
    font-size: 9px; 
    cursor: pointer;
    display: flex; 
    align-items: center; 
    justify-content: center;
    line-height: 1;
    transition: transform 0.2s;
    box-shadow: 0 2px 6px rgba(239,68,68,0.3);
}
.sv-photo-thumb .sv-rm-photo:hover {
    transform: scale(1.15);
}
.sv-photo-thumb input[type="checkbox"] { display: none; }

/* Bonus list input */
.sv-bonus-hint { 
    font-size: clamp(0.65rem, 1vw, 0.75rem); 
    color: #9ca3af; 
    margin-top: 4px; 
    font-family: 'Nunito', sans-serif; 
}

/* Btn submit */
.sv-btn-submit {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: #fff;
    border: none;
    border-radius: 100px;
    padding: 11px 24px;
    font-family: 'Nunito', sans-serif;
    font-size: clamp(0.8rem, 1.2vw, 0.9375rem);
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    box-shadow: 0 4px 14px rgba(59,130,246,0.25);
}
.sv-btn-submit:hover { 
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 24px rgba(59,130,246,0.35);
}
.sv-btn-submit:active {
    transform: translateY(0);
}

.sv-btn-cancel {
    background: #f3f4f6;
    color: #374151;
    border: none;
    border-radius: 100px;
    padding: 11px 20px;
    font-family: 'Nunito', sans-serif;
    font-size: clamp(0.8rem, 1.2vw, 0.9375rem);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s ease;
}
.sv-btn-cancel:hover { 
    background: #e5e7eb; 
    transform: translateY(-2px);
}

/* Tabs in modal (Add / Edit) */
.sv-section-label {
    font-size: clamp(0.6rem, 1vw, 0.7rem);
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #9ca3af;
    font-family: 'Nunito', sans-serif;
    margin: 1.25rem 0 0.75rem;
    display: flex;
    align-items: center;
    gap: 8px;
}
.sv-section-label::after { 
    content: ''; 
    flex: 1; 
    height: 1px; 
    background: #e5e7eb; 
}

/* Scrollbar personnalisée pour le modal */
.modal-body::-webkit-scrollbar {
    width: 6px;
}
.modal-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}
.modal-body::-webkit-scrollbar-thumb {
    background: #c1c7cd;
    border-radius: 10px;
}
.modal-body::-webkit-scrollbar-thumb:hover {
    background: #a0a7ae;
}

/* ── RESPONSIVE ── */
/* Tablettes et petits écrans */
@media (max-width: 992px) {
    .sv-grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 16px;
    }
    .sv-stats {
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 10px;
    }
    .sv-stat-card {
        padding: 0.875rem 1rem;
    }
}

/* Mobiles */
@media (max-width: 768px) {
    .sv-page {
        padding: 1rem 0.75rem 2rem;
    }
    .sv-header {
        flex-direction: column;
        align-items: stretch;
        gap: 0.75rem;
    }
    .sv-header-left h1 {
        font-size: 1.25rem;
    }
    .sv-btn-primary {
        width: 100%;
        justify-content: center;
    }
    .sv-grid {
        grid-template-columns: 1fr;
        gap: 14px;
    }
    .sv-stats {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }
    .sv-stat-card {
        padding: 0.75rem;
        gap: 10px;
    }
    .sv-stat-icon {
        width: 34px;
        height: 34px;
        font-size: 0.85rem;
    }
    .sv-stat-body strong {
        font-size: 1rem;
    }
    .sv-stat-body span {
        font-size: 0.6rem;
    }
    .sv-card-img img {
        height: 160px;
    }
    .sv-card-body {
        padding: 0.875rem 0.875rem 0.75rem;
    }
    .sv-card-actions {
        padding: 0 0.875rem 0.875rem;
        gap: 6px;
    }
    .sv-btn-sm {
        font-size: 0.65rem;
        padding: 6px 10px;
        min-width: 60px;
    }
    .sv-btn-sm i {
        font-size: 0.7rem;
    }
    
    /* Modal responsive */
    .modal-dialog {
        margin: 0.25rem;
        min-height: calc(100% - 0.5rem);
    }
    .modal-dialog-centered {
        min-height: calc(100% - 0.5rem);
    }
    .sv-modal-content {
        border-radius: 14px;
        max-height: 95vh;
    }
    .modal-body {
        padding: 0.75rem 1rem;
        max-height: calc(95vh - 160px);
    }
    .modal-header {
        padding: 1rem 1rem 0.25rem;
    }
    .modal-footer {
        padding: 0.5rem 1rem 1rem;
    }
    .sv-tarif-group { 
        flex-direction: column; 
        gap: 8px;
    }
    .sv-tarif-group .sv-form-control:first-child { 
        flex: unset; 
    }
    .sv-photo-zone {
        padding: 1rem 0.75rem;
    }
    .sv-section-label {
        font-size: 0.6rem;
        margin: 1rem 0 0.5rem;
    }
}

/* Très petits écrans */
@media (max-width: 480px) {
    .sv-page {
        padding: 0.75rem 0.5rem 1.5rem;
    }
    .sv-stats {
        grid-template-columns: 1fr 1fr;
        gap: 6px;
    }
    .sv-stat-card {
        padding: 0.625rem;
        border-radius: 10px;
        gap: 8px;
    }
    .sv-stat-icon {
        width: 30px;
        height: 30px;
        font-size: 0.75rem;
        border-radius: 8px;
    }
    .sv-stat-body strong {
        font-size: 0.875rem;
    }
    .sv-stat-body span {
        font-size: 0.55rem;
    }
    .sv-card-img img {
        height: 140px;
    }
    .sv-card-title {
        font-size: 0.8rem;
    }
    .sv-card-desc {
        font-size: 0.7rem;
    }
    .sv-card-meta {
        font-size: 0.6rem;
        gap: 6px;
    }
    .sv-card-price {
        font-size: 0.9rem;
    }
    .sv-btn-sm {
        font-size: 0.6rem;
        padding: 5px 8px;
        min-width: 50px;
    }
    .sv-btn-sm i {
        font-size: 0.6rem;
    }
    .sv-btn-delete {
        padding: 5px 10px;
    }
    .sv-btn-primary {
        padding: 8px 16px;
        font-size: 0.75rem;
    }
    .sv-btn-primary i {
        font-size: 0.85rem;
    }
    .sv-btn-submit {
        font-size: 0.75rem;
        padding: 9px 16px;
    }
    .sv-btn-cancel {
        font-size: 0.75rem;
        padding: 9px 14px;
    }
    .sv-empty {
        padding: 2rem 1rem;
    }
    .sv-empty i {
        font-size: 2rem;
    }
    .sv-empty h3 {
        font-size: 0.875rem;
    }
    .sv-empty p {
        font-size: 0.75rem;
    }
    .sv-photo-thumb {
        width: 50px;
        height: 50px;
    }
    .sv-photo-thumb .sv-rm-photo {
        width: 16px;
        height: 16px;
        font-size: 7px;
    }
    
    /* Modal très petit */
    .modal-body {
        padding: 0.5rem 0.75rem;
        max-height: calc(95vh - 140px);
    }
    .sv-modal-content {
        border-radius: 12px;
    }
}

/* ── ANIMATIONS ── */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.sv-card {
    animation: fadeInUp 0.4s ease forwards;
}
.sv-card:nth-child(2) { animation-delay: 0.05s; }
.sv-card:nth-child(3) { animation-delay: 0.1s; }
.sv-card:nth-child(4) { animation-delay: 0.15s; }
.sv-card:nth-child(5) { animation-delay: 0.2s; }
.sv-card:nth-child(6) { animation-delay: 0.25s; }

/* ── ACCESSIBILITÉ ── */
.sv-btn-sm:focus-visible,
.sv-btn-primary:focus-visible,
.sv-btn-submit:focus-visible,
.sv-btn-cancel:focus-visible,
.sv-form-control:focus-visible {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}
</style>
@endpush

@section('content')
<div class="sv-page">

    {{-- ── Header ── --}}
    <div class="sv-header">
        <div class="sv-header-left">
            <h1><i class="fa-solid fa-briefcase me-2 text-primary"></i>Mes Services</h1>
            <p>Gérez les expériences que vous proposez aux voyageurs</p>
        </div>
        <button class="sv-btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="fa-solid fa-plus"></i> Ajouter un service
        </button>
    </div>

    {{-- ── Flash messages ── --}}
    @if(session('success'))
        <div class="sv-alert sv-alert-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="sv-alert sv-alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ $errors->first() }}
        </div>
    @endif

    {{-- ── Stats ── --}}
    @php
        $total   = $services->count();
        $actifs  = $services->where('disponible', true)->count();
        $inactifs= $total - $actifs;
        $tarifMoy= $total > 0 ? round($services->avg('tarif'), 0) : 0;
    @endphp
    <div class="sv-stats">
        <div class="sv-stat-card">
            <div class="sv-stat-icon blue"><i class="fa-solid fa-list-check"></i></div>
            <div class="sv-stat-body">
                <strong>{{ $total }}</strong>
                <span>Services créés</span>
            </div>
        </div>
        <div class="sv-stat-card">
            <div class="sv-stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
            <div class="sv-stat-body">
                <strong>{{ $actifs }}</strong>
                <span>Actifs</span>
            </div>
        </div>
        <div class="sv-stat-card">
            <div class="sv-stat-icon orange"><i class="fa-solid fa-euro-sign"></i></div>
            <div class="sv-stat-body">
                <strong>{{ $tarifMoy }} €</strong>
                <span>Tarif moyen</span>
            </div>
        </div>
        <div class="sv-stat-card">
            <div class="sv-stat-icon red"><i class="fa-solid fa-pause-circle"></i></div>
            <div class="sv-stat-body">
                <strong>{{ $inactifs }}</strong>
                <span>Désactivés</span>
            </div>
        </div>
    </div>

    {{-- ── Grid de services ── --}}
    @if($services->isEmpty())
        <div class="sv-empty">
            <i class="fa-regular fa-folder-open"></i>
            <h3>Aucun service pour le moment</h3>
            <p>Ajoutez votre premier service pour le faire apparaître sur l'accueil.</p>
            <button class="sv-btn-primary sv-btn-primary-sm" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                Créer mon premier service
            </button>
        </div>
    @else
        <div class="sv-grid">
            @foreach($services as $service)
            <div class="sv-card {{ $service->disponible ? '' : 'inactive' }}">

                {{-- Badge statut --}}
                <span class="sv-card-status {{ $service->disponible ? 'actif' : 'inactif' }}">
                    {{ $service->disponible ? '● Actif' : '● Désactivé' }}
                </span>

                {{-- Image --}}
                <div class="sv-card-img">
                    <img src="{{ $service->coverPhoto() }}" alt="{{ $service->titre }}" loading="lazy">
                    <span class="sv-card-cat">{{ $service->categorie }}</span>
                </div>

                {{-- Body --}}
                <div class="sv-card-body">
                    <h3 class="sv-card-title">{{ $service->titre }}</h3>
                    <p class="sv-card-desc">{{ $service->description }}</p>

                    <div class="sv-card-meta">
                        @if($service->ville || $service->pays)
                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            {{ implode(', ', array_filter([$service->ville, $service->pays])) }}
                        </span>
                        @endif
                        @if($service->duree)
                        <span><i class="fa-regular fa-clock"></i> {{ $service->duree }}</span>
                        @endif
                        @if($service->max_personnes)
                        <span><i class="fa-solid fa-users"></i> max {{ $service->max_personnes }}</span>
                        @endif
                    </div>

                    <div class="sv-card-price">
                        {{ number_format($service->tarif, 2, ',', ' ') }} €
                        <span>{{ $service->typeTarifLabel() }}</span>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="sv-card-actions">
                    <button class="sv-btn-sm sv-btn-edit"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $service->id }}">
                        <i class="fa-regular fa-pen-to-square"></i> Modifier
                    </button>

                    {{-- Toggle disponibilité --}}
                    <form method="POST" action="{{ route('services.toggle', $service->id) }}" style="flex:1">
                        @csrf @method('PATCH')
                        <button type="submit" class="sv-btn-sm sv-btn-toggle w-100">
                            @if($service->disponible)
                                <i class="fa-solid fa-pause"></i> Désactiver
                            @else
                                <i class="fa-solid fa-play"></i> Activer
                            @endif
                        </button>
                    </form>

                    {{-- Supprimer --}}
                    <form method="POST" action="{{ route('services.destroy', $service->id) }}"
                          onsubmit="return confirm('Supprimer ce service définitivement ?')" style="flex:0">
                        @csrf @method('DELETE')
                        <button type="submit" class="sv-btn-sm sv-btn-delete" style="padding: 7px 12px; flex:0">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>

            {{-- ── Modal Modifier ── --}}
            <div class="modal fade" id="editModal{{ $service->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content sv-modal-content">
                        <div class="modal-header border-0">
                            <h5 class="sv-modal-title">
                                <i class="fa-regular fa-pen-to-square me-2 text-primary"></i>
                                Modifier « {{ Str::limit($service->titre, 30) }} »
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="POST" action="{{ route('services.update', $service->id) }}"
                              enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="modal-body">
                                @include('services._form', [
                                    'service'    => $service,
                                    'categories' => $categories,
                                    'typesTarif' => $typesTarif,
                                    'mode'       => 'edit',
                                ])
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="sv-btn-cancel" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="sv-btn-submit">
                                    <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

</div>

{{-- ══════════════════════════════════
     MODAL — Ajouter un service
══════════════════════════════════ --}}
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content sv-modal-content">
            <div class="modal-header border-0">
                <h5 class="sv-modal-title">
                    <i class="fa-solid fa-plus-circle me-2 text-primary"></i>
                    Ajouter un service
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @include('services._form', [
                        'service'    => null,
                        'categories' => $categories,
                        'typesTarif' => $typesTarif,
                        'mode'       => 'add',
                    ])
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="sv-btn-cancel" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="sv-btn-submit">
                        <i class="fa-solid fa-plus"></i> Ajouter le service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// ── Prévisualisation photos (ajout) ──────────────────────────────────────────
document.querySelectorAll('.sv-photo-input').forEach(input => {
    input.addEventListener('change', function() {
        const wrap = document.getElementById(this.dataset.preview);
        if (!wrap) return;
        wrap.innerHTML = '';
        Array.from(this.files).forEach(file => {
            if (!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = e => {
                const thumb = document.createElement('div');
                thumb.className = 'sv-photo-thumb';
                thumb.innerHTML = `<img src="${e.target.result}" alt="Aperçu photo">`;
                wrap.appendChild(thumb);
            };
            reader.readAsDataURL(file);
        });
    });
});

// ── Ouvrir le modal si erreur de validation ────────────────────────────────
@if($errors->any())
    const addModal = new bootstrap.Modal(document.getElementById('addServiceModal'));
    addModal.show();
@endif

// ── Gestion du bouton de suppression de photos ─────────────────────────────
document.querySelectorAll('.sv-rm-photo').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const checkbox = this.previousElementSibling;
        if (checkbox && checkbox.type === 'checkbox') {
            checkbox.checked = !checkbox.checked;
            this.parentElement.parentElement.style.opacity = checkbox.checked ? '0.4' : '1';
        }
    });
});
</script>
@endpush