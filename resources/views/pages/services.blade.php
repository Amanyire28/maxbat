@extends('layouts.app')
@section('title', 'Services — MaxBat Automobil')
@section('meta_desc', 'ECU tuning, vehicle diagnostics, performance upgrades, turbo systems, exhaust, electronics and maintenance services.')

@push('styles')
<style>
    .services-grid { display: grid; grid-template-columns: 1fr; gap: 20px; margin-top: 48px; }
    @media(min-width:640px){ .services-grid { grid-template-columns: repeat(2,1fr); } }
    @media(min-width:1024px){ .services-grid { grid-template-columns: repeat(4,1fr); } }

    .service-card { position: relative; overflow: hidden; padding: 36px 32px; border-radius: 14px; background: var(--card-bg); border: 1px solid var(--border); transition: all 0.35s ease; display: flex; flex-direction: column; }
    .service-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: var(--green); transform: scaleX(0); transform-origin: left; transition: transform 0.35s ease; }
    .service-card:hover::before { transform: scaleX(1); }
    .service-card:hover { border-color: var(--green-border); box-shadow: 0 12px 44px rgba(0,0,0,0.5); transform: translateY(-3px); }
    .service-icon { width: 54px; height: 54px; border-radius: 10px; background: var(--green-light); border: 1px solid var(--green-border); display: flex; align-items: center; justify-content: center; font-size: 22px; color: var(--green); margin-bottom: 22px; transition: all 0.3s; flex-shrink: 0; }
    .service-card:hover .service-icon { background: var(--green); color: #000; }
    .service-card h3 { font-family: 'Bebas Neue', sans-serif; font-size: 22px; font-weight: 400; text-transform: uppercase; margin-bottom: 10px; color: #fff; }
    .service-card p { color: var(--card-subtext); font-size: 15px; line-height: 1.65; margin-bottom: 22px; flex: 1; }
    .service-card-footer { display: flex; flex-direction: column; gap: 10px; margin-top: auto; }
    .service-link { display: inline-flex; align-items: center; gap: 7px; font-family: 'Barlow', sans-serif; font-size: 13px; font-weight: 700; text-transform: uppercase; color: var(--green); transition: gap 0.25s; }
    .service-card:hover .service-link { gap: 11px; }
    .service-upload-btn {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 9px 16px; border-radius: 6px;
        background: rgba(91,200,0,0.10); border: 1px solid rgba(91,200,0,0.25);
        color: var(--green); font-family: 'Barlow', sans-serif;
        font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        cursor: pointer; transition: all 0.2s; width: 100%; justify-content: center;
    }
    .service-upload-btn:hover { background: var(--green); color: #000; }
    .service-number { position: absolute; top: 20px; right: 22px; font-family: 'Bebas Neue', sans-serif; font-size: 60px; color: rgba(255,255,255,0.04); line-height: 1; pointer-events: none; }

    /* ── Upload Modal ── */
    .upload-modal-overlay {
        position: fixed; inset: 0; z-index: 1100;
        background: rgba(0,0,0,0.75); backdrop-filter: blur(6px);
        display: none; align-items: center; justify-content: center; padding: 20px;
    }
    .upload-modal-overlay.open { display: flex; }
    .upload-modal {
        background: #161616; border: 1px solid rgba(255,255,255,0.08);
        border-radius: 16px; width: 100%; max-width: 560px;
        max-height: 90vh; overflow-y: auto;
        border-top: 3px solid var(--green);
    }
    .upload-modal-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 24px; border-bottom: 1px solid rgba(255,255,255,0.07);
        position: sticky; top: 0; background: #161616; z-index: 1;
    }
    .upload-modal-header h3 {
        font-family: 'Bebas Neue', sans-serif; font-size: 20px;
        font-weight: 400; text-transform: uppercase; letter-spacing: 1px; color: #fff;
    }
    .upload-modal-service-tag {
        font-size: 12px; color: var(--green); font-family: 'Barlow', sans-serif;
        font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
        background: rgba(91,200,0,0.10); border: 1px solid rgba(91,200,0,0.2);
        padding: 3px 10px; border-radius: 100px; margin-top: 4px; display: inline-block;
    }
    .upload-modal-close {
        width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
        background: rgba(255,255,255,0.06); border: none; cursor: pointer;
        color: #fff; font-size: 16px; display: flex; align-items: center; justify-content: center;
        transition: background 0.2s;
    }
    .upload-modal-close:hover { background: rgba(225,6,0,0.2); color: #ff6b6b; }
    .upload-modal-body { padding: 24px; }
    .upload-step { display: none; }
    .upload-step.active { display: block; }

    /* File type selection */
    .file-type-list { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px; }
    .file-type-option {
        display: flex; align-items: center; gap: 12px;
        padding: 13px 16px; background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.07); border-radius: 8px;
        cursor: pointer; transition: all 0.2s;
    }
    .file-type-option:hover { border-color: rgba(91,200,0,0.3); background: rgba(91,200,0,0.06); }
    .file-type-option input[type=radio] { accent-color: var(--green); width: 16px; height: 16px; flex-shrink: 0; }
    .file-type-option label { font-size: 15px; color: #fff; cursor: pointer; flex: 1; }

    /* Form fields */
    .u-form-group { margin-bottom: 14px; }
    .u-label { display: block; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: rgba(255,255,255,0.5); margin-bottom: 6px; }
    .u-input {
        width: 100%; background: #252525; border: 1px solid rgba(255,255,255,0.10);
        color: #fff; padding: 11px 14px; border-radius: 7px;
        font-family: 'Barlow', sans-serif; font-size: 14px; transition: border-color 0.2s;
    }
    .u-input:focus { outline: none; border-color: var(--green); box-shadow: 0 0 0 3px rgba(91,200,0,0.08); }
    .u-input::placeholder { color: rgba(255,255,255,0.2); }
    .u-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%235BC800' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px; cursor: pointer; }
    .u-select:disabled { opacity: 0.4; cursor: not-allowed; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E"); }
    .u-select option { background: #252525; color: #fff; }
    .u-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

    .file-drop-zone {
        border: 2px dashed rgba(91,200,0,0.3); border-radius: 10px;
        padding: 28px 20px; text-align: center; cursor: pointer;
        transition: all 0.2s; margin-bottom: 14px;
    }
    .file-drop-zone:hover, .file-drop-zone.dragover { border-color: var(--green); background: rgba(91,200,0,0.06); }
    .file-drop-zone i { font-size: 32px; color: var(--green); display: block; margin-bottom: 10px; }
    .file-drop-zone p { color: rgba(255,255,255,0.6); font-size: 14px; margin: 0; }
    .file-drop-zone span { color: var(--green); font-weight: 600; }
    .file-selected-name { font-size: 13px; color: var(--green); margin-top: 8px; display: none; }

    .u-submit-btn {
        width: 100%; padding: 14px; background: var(--green); color: #000;
        border: none; border-radius: 8px; font-family: 'Barlow', sans-serif;
        font-size: 15px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
        cursor: pointer; transition: background 0.2s; margin-top: 8px;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .u-submit-btn:hover { background: #68e000; }
    .u-submit-btn:disabled { background: #333; color: #666; cursor: not-allowed; }
    .u-continue-btn {
        width: 100%; padding: 13px; background: var(--green); color: #000;
        border: none; border-radius: 8px; font-family: 'Barlow', sans-serif;
        font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
        cursor: pointer; transition: background 0.2s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .u-continue-btn:hover { background: #68e000; }
    .u-continue-btn:disabled { background: #333; color: #666; cursor: not-allowed; }
    .u-back-btn {
        background: none; border: none; color: rgba(255,255,255,0.5); font-family: 'Barlow', sans-serif;
        font-size: 13px; cursor: pointer; display: flex; align-items: center; gap: 6px;
        margin-bottom: 16px; padding: 0; transition: color 0.2s;
    }
    .u-back-btn:hover { color: #fff; }
    .upload-success { text-align: center; padding: 20px 0; }
    .upload-success i { font-size: 48px; color: var(--green); display: block; margin-bottom: 16px; }
    .upload-success h4 { font-family: 'Bebas Neue', sans-serif; font-size: 22px; color: #fff; margin-bottom: 8px; text-transform: uppercase; }
    .upload-success p { color: rgba(255,255,255,0.6); font-size: 14px; line-height: 1.6; }
    .u-loading { display: none; }
</style>
@endpush

@section('content')
<div class="page-hero">
    <div class="page-hero-breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fa fa-chevron-right"></i>Services</div>
    <h1>Our <span>Services</span></h1>
    <p>From precision ECU mapping to full performance builds — engineering excellence at every level.</p>
</div>

<section class="section-pad" style="background:var(--section-dark);">
    <div class="container">
        <div class="reveal" style="text-align:center;">
            <div class="section-label" style="justify-content:center;">What We Do</div>
            <h2 class="section-title" style="text-align:center;">Performance <span>Services</span></h2>
        </div>
        <div class="services-grid">
            @forelse($services as $index => $s)
            <article class="service-card reveal" role="article" style="transition-delay:{{ $index * 0.05 }}s;">
                <div class="service-number">{{ str_pad($s->sort_order, 2, '0', STR_PAD_LEFT) }}</div>
                <div class="service-icon"><i class="fa {{ $s->icon }}"></i></div>
                <h3>{{ $s->name }}</h3>
                <p>{{ $s->description }}</p>
                <div class="service-card-footer">
                    <a href="https://wa.me/256701244403?text={{ urlencode('Hello MaxBat, I would like to get a quote for: ' . $s->name . '. Please advise on pricing and availability. Thank you.') }}"
                       class="service-link" target="_blank" rel="noopener noreferrer">
                        Get Quote <i class="fab fa-whatsapp"></i>
                    </a>
                    @if($s->file_upload_enabled)
                    <button
                        class="service-upload-btn"
                        onclick="openUploadModal({{ $s->id }}, '{{ addslashes($s->name) }}', '{{ addslashes($s->file_types ?? '') }}')"
                        aria-label="Upload file for {{ $s->name }}"
                    >
                        <i class="fa fa-upload"></i> Upload File
                    </button>
                    @endif
                </div>
            </article>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:60px 20px;">
                <i class="fa fa-tools" style="font-size:48px;color:rgba(255,255,255,0.1);display:block;margin-bottom:16px;"></i>
                <p style="color:rgba(255,255,255,0.4);">No services listed yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ── Upload Modal (single instance, reused for any service card) ── --}}
<div class="upload-modal-overlay" id="uploadModal" role="dialog" aria-modal="true" aria-labelledby="uploadModalTitle">
    <div class="upload-modal">
        <div class="upload-modal-header">
            <div>
                <h3 id="uploadModalTitle"><i class="fa fa-upload" style="color:var(--green);margin-right:8px;"></i> Upload File</h3>
                <span class="upload-modal-service-tag" id="uploadModalServiceTag"></span>
            </div>
            <button class="upload-modal-close" id="uploadModalClose" aria-label="Close upload modal">✕</button>
        </div>
        <div class="upload-modal-body">

            {{-- STEP 1: Select File Type (shown only when service has multiple file types) --}}
            <div class="upload-step" id="uStep1">
                <p style="color:rgba(255,255,255,0.6);font-size:14px;margin-bottom:14px;">Select the file type you want to upload:</p>
                <div class="file-type-list" id="uFileTypeList"></div>
                <button class="u-continue-btn" id="uContinueBtn" onclick="uGoToStep(2)" disabled>
                    Continue <i class="fa fa-arrow-right"></i>
                </button>
            </div>

            {{-- STEP 2: Vehicle + Contact Details + File --}}
            <div class="upload-step" id="uStep2">
                <form id="uploadForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="service_id" id="uHiddenServiceId">
                    <input type="hidden" name="file_type"  id="uHiddenFileType">

                    <p style="color:rgba(255,255,255,0.5);font-size:12px;text-transform:uppercase;letter-spacing:1px;margin-bottom:14px;">Vehicle Details</p>

                    {{-- Vehicle Type --}}
                    <div class="u-form-group">
                        <label class="u-label" for="uVehicleType">Vehicle Type *</label>
                        <select id="uVehicleType" name="vehicle_type_id" class="u-input u-select" required>
                            <option value="">— Select Type —</option>
                        </select>
                    </div>

                    {{-- Brand --}}
                    <div class="u-form-group">
                        <label class="u-label" for="uVehicleBrand">Brand *</label>
                        <select id="uVehicleBrand" name="vehicle_brand_id" class="u-input u-select" disabled required>
                            <option value="">— Select Brand —</option>
                        </select>
                    </div>

                    {{-- Series --}}
                    <div class="u-form-group">
                        <label class="u-label" for="uVehicleSeries">Series *</label>
                        <select id="uVehicleSeries" name="vehicle_series_id" class="u-input u-select" disabled required>
                            <option value="">— Select Series —</option>
                        </select>
                    </div>

                    {{-- Model --}}
                    <div class="u-form-group">
                        <label class="u-label" for="uVehicleModel">Model *</label>
                        <select id="uVehicleModel" name="vehicle_model_id" class="u-input u-select" disabled required>
                            <option value="">— Select Model —</option>
                        </select>
                    </div>

                    {{-- Engine --}}
                    <div class="u-form-group">
                        <label class="u-label" for="uVehicleEngine">Engine *</label>
                        <select id="uVehicleEngine" name="vehicle_engine_id" class="u-input u-select" disabled required>
                            <option value="">— Select Engine —</option>
                        </select>
                    </div>

                    <div class="u-form-group">
                        <label class="u-label" for="uChassisNo">Chassis Number *</label>
                        <input type="text" id="uChassisNo" name="chassis_no" class="u-input" placeholder="e.g. JTMBB3FV20D000000" required>
                    </div>

                    <p style="color:rgba(255,255,255,0.5);font-size:12px;text-transform:uppercase;letter-spacing:1px;margin:18px 0 14px;">Your Contact Details</p>
                    <div class="u-form-group">
                        <label class="u-label" for="uCustomerName">Full Name *</label>
                        <input type="text" id="uCustomerName" name="customer_name" class="u-input" placeholder="Your name" required>
                    </div>
                    <div class="u-row">
                        <div class="u-form-group">
                            <label class="u-label" for="uPhone">Phone *</label>
                            <input type="tel" id="uPhone" name="phone" class="u-input" placeholder="+256 7XX XXX XXX" required>
                        </div>
                        <div class="u-form-group">
                            <label class="u-label" for="uEmail">Email</label>
                            <input type="email" id="uEmail" name="email" class="u-input" placeholder="optional">
                        </div>
                    </div>

                    <p style="color:rgba(255,255,255,0.5);font-size:12px;text-transform:uppercase;letter-spacing:1px;margin:18px 0 14px;">File</p>
                    <div class="file-drop-zone" id="uDropZone" role="button" tabindex="0" aria-label="Click or drag to upload file">
                        <i class="fa fa-cloud-upload-alt"></i>
                        <p>Drag & drop your file here or <span>browse</span></p>
                        <p style="font-size:12px;margin-top:6px;color:rgba(255,255,255,0.35);">Supports: .bin, .hex, .zip, .rar, .pdf, .xls, .ori, .frf and more</p>
                        <input type="file" name="upload_file" id="uFileInput" style="display:none" required>
                    </div>
                    <div class="file-selected-name" id="uFileSelectedName">
                        <i class="fa fa-check-circle"></i> <span id="uSelectedFileName"></span>
                    </div>

                    <div class="u-form-group" style="margin-top:14px;">
                        <label class="u-label" for="uNotes">Notes (optional)</label>
                        <textarea id="uNotes" name="notes" class="u-input" rows="2" placeholder="Any additional details…" style="resize:vertical;"></textarea>
                    </div>

                    <button type="submit" class="u-submit-btn" id="uSubmitBtn">
                        <i class="fa fa-upload"></i>
                        <span id="uSubmitLabel">Submit File</span>
                        <span class="u-loading" id="uLoadingSpinner"><i class="fa fa-spinner fa-spin"></i></span>
                    </button>
                </form>
            </div>

            {{-- STEP 3: Success --}}
            <div class="upload-step" id="uStep3">
                <div class="upload-success">
                    <i class="fa fa-check-circle"></i>
                    <h4>File Submitted!</h4>
                    <p id="uSuccessMessage">Your file has been received. Our team will review it and contact you within 24 hours.</p>
                    <button class="u-submit-btn" style="max-width:220px;margin:20px auto 0;" onclick="uReset()">
                        <i class="fa fa-redo"></i> Upload Another
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    let uServiceId   = null;
    let uServiceName = '';
    let uFileTypes   = [];
    let uFileType    = null;

    // ── Open modal triggered from a service card button ──
    window.openUploadModal = function(id, name, fileTypesStr) {
        uServiceId   = id;
        uServiceName = name;
        uFileTypes   = fileTypesStr.split(',').map(t => t.trim()).filter(Boolean);
        uFileType    = null;

        document.getElementById('uploadModalServiceTag').textContent = name;
        document.getElementById('uploadModal').classList.add('open');
        document.body.style.overflow = 'hidden';

        if (uFileTypes.length > 1) {
            // Multiple file types — show selection step first
            buildFileTypeList();
            uGoToStep(1);
        } else {
            // Single file type (or none listed) — skip straight to the form
            uFileType = uFileTypes[0] || '';
            document.getElementById('uHiddenServiceId').value = uServiceId;
            document.getElementById('uHiddenFileType').value  = uFileType;
            uGoToStep(2);
        }
    };

    function buildFileTypeList() {
        const list = document.getElementById('uFileTypeList');
        list.innerHTML = uFileTypes.map((t, i) => `
            <div class="file-type-option">
                <input type="radio" name="u_file_type_choice" id="uft${i}" value="${t}" onchange="uOnTypeChange('${t.replace(/'/g,"\\'")}')">
                <label for="uft${i}">${t}</label>
            </div>
        `).join('');
        document.getElementById('uContinueBtn').disabled = true;
    }

    window.uOnTypeChange = function(type) {
        uFileType = type;
        document.getElementById('uContinueBtn').disabled = false;
    };

    window.uGoToStep = function(n) {
        document.querySelectorAll('.upload-step').forEach(s => s.classList.remove('active'));
        document.getElementById('uStep' + n).classList.add('active');
        if (n === 2) {
            document.getElementById('uHiddenServiceId').value = uServiceId;
            document.getElementById('uHiddenFileType').value  = uFileType;
        }
    };

    // ── Close modal ──
    function closeModal() {
        document.getElementById('uploadModal').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.getElementById('uploadModalClose').addEventListener('click', closeModal);
    document.getElementById('uploadModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

    // ── Reset after success ──
    window.uReset = function() {
        document.getElementById('uploadForm').reset();
        document.getElementById('uFileSelectedName').style.display = 'none';
        // Reset all vehicle dropdowns to disabled except type
        ['uVehicleBrand', 'uVehicleSeries', 'uVehicleModel', 'uVehicleEngine'].forEach(id => {
            const el = document.getElementById(id);
            el.innerHTML = '<option value="">— Select —</option>';
            el.disabled = true;
        });
        uFileType = null;
        if (uFileTypes.length > 1) {
            buildFileTypeList();
            uGoToStep(1);
        } else {
            uFileType = uFileTypes[0] || '';
            document.getElementById('uHiddenServiceId').value = uServiceId;
            document.getElementById('uHiddenFileType').value  = uFileType;
            uGoToStep(2);
        }
    };

    // ── Load initial vehicle types when modal opens ──
    async function loadVehicleTypes() {
        const select = document.getElementById('uVehicleType');
        if (select.options.length > 1) return; // already loaded
        try {
            const res = await fetch('{{ route("api.vehicles.types") }}');
            const types = await res.json();
            select.innerHTML = '<option value="">— Select Type —</option>' + types.map(t => `<option value="${t.id}">${t.name}</option>`).join('');
        } catch (e) {
            console.error('Failed to load vehicle types', e);
        }
    }

    // ── Cascading dropdowns ──
    document.getElementById('uVehicleType').addEventListener('change', async function() {
        const typeId = this.value;
        const brandSelect = document.getElementById('uVehicleBrand');
        // Reset children
        ['uVehicleBrand', 'uVehicleSeries', 'uVehicleModel', 'uVehicleEngine'].forEach(id => {
            const el = document.getElementById(id);
            el.innerHTML = '<option value="">— Select —</option>';
            el.disabled = true;
        });
        if (!typeId) return;
        try {
            const res = await fetch(`{{ route("api.vehicles.brands") }}?type_id=${typeId}`);
            const brands = await res.json();
            brandSelect.innerHTML = '<option value="">— Select Brand —</option>' + brands.map(b => `<option value="${b.id}">${b.name}</option>`).join('');
            brandSelect.disabled = false;
        } catch (e) {
            console.error('Failed to load brands', e);
        }
    });

    document.getElementById('uVehicleBrand').addEventListener('change', async function() {
        const brandId = this.value;
        const seriesSelect = document.getElementById('uVehicleSeries');
        ['uVehicleSeries', 'uVehicleModel', 'uVehicleEngine'].forEach(id => {
            const el = document.getElementById(id);
            el.innerHTML = '<option value="">— Select —</option>';
            el.disabled = true;
        });
        if (!brandId) return;
        try {
            const res = await fetch(`{{ route("api.vehicles.series") }}?brand_id=${brandId}`);
            const series = await res.json();
            seriesSelect.innerHTML = '<option value="">— Select Series —</option>' + series.map(s => `<option value="${s.id}">${s.name}</option>`).join('');
            seriesSelect.disabled = false;
        } catch (e) {
            console.error('Failed to load series', e);
        }
    });

    document.getElementById('uVehicleSeries').addEventListener('change', async function() {
        const seriesId = this.value;
        const modelSelect = document.getElementById('uVehicleModel');
        ['uVehicleModel', 'uVehicleEngine'].forEach(id => {
            const el = document.getElementById(id);
            el.innerHTML = '<option value="">— Select —</option>';
            el.disabled = true;
        });
        if (!seriesId) return;
        try {
            const res = await fetch(`{{ route("api.vehicles.models") }}?series_id=${seriesId}`);
            const models = await res.json();
            modelSelect.innerHTML = '<option value="">— Select Model —</option>' + models.map(m => `<option value="${m.id}">${m.name}${m.year_range ? ' (' + m.year_range + ')' : ''}</option>`).join('');
            modelSelect.disabled = false;
        } catch (e) {
            console.error('Failed to load models', e);
        }
    });

    document.getElementById('uVehicleModel').addEventListener('change', async function() {
        const modelId = this.value;
        const engineSelect = document.getElementById('uVehicleEngine');
        engineSelect.innerHTML = '<option value="">— Select —</option>';
        engineSelect.disabled = true;
        if (!modelId) return;
        try {
            const res = await fetch(`{{ route("api.vehicles.engines") }}?model_id=${modelId}`);
            const engines = await res.json();
            engineSelect.innerHTML = '<option value="">— Select Engine —</option>' + engines.map(e => `<option value="${e.id}">${e.name}${e.power ? ' — ' + e.power : ''}${e.fuel_type ? ' (' + e.fuel_type + ')' : ''}</option>`).join('');
            engineSelect.disabled = false;
        } catch (e) {
            console.error('Failed to load engines', e);
        }
    });

    // ── Load types when modal opens (hook into existing openUploadModal) ──
    const originalOpenUploadModal = window.openUploadModal;
    window.openUploadModal = function(id, name, fileTypesStr) {
        loadVehicleTypes();
        originalOpenUploadModal(id, name, fileTypesStr);
    };

    // ── File drop zone ──
    const dropZone = document.getElementById('uDropZone');
    const fileInput = document.getElementById('uFileInput');
    dropZone.addEventListener('click', () => fileInput.click());
    dropZone.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') fileInput.click(); });
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('dragover'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault(); dropZone.classList.remove('dragover');
        if (e.dataTransfer.files[0]) showFile(e.dataTransfer.files[0]);
    });
    fileInput.addEventListener('change', () => { if (fileInput.files[0]) showFile(fileInput.files[0]); });

    function showFile(file) {
        document.getElementById('uSelectedFileName').textContent = file.name;
        document.getElementById('uFileSelectedName').style.display = 'block';
    }

    // ── Form submit ──
    document.getElementById('uploadForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn     = document.getElementById('uSubmitBtn');
        const label   = document.getElementById('uSubmitLabel');
        const spinner = document.getElementById('uLoadingSpinner');

        btn.disabled     = true;
        label.textContent = '';
        spinner.style.display = 'inline';

        try {
            const res  = await fetch('{{ route("upload.store") }}', {
                method:  'POST',
                body:    new FormData(this),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();
            if (data.success) {
                document.getElementById('uSuccessMessage').textContent = data.message;
                uGoToStep(3);
            } else {
                const errors = data.errors
                    ? Object.values(data.errors).flat().join('\n')
                    : 'Submission failed. Please try again.';
                alert(errors);
            }
        } catch (err) {
            alert('Network error. Please check your connection and try again.');
        } finally {
            btn.disabled          = false;
            label.textContent     = 'Submit File';
            spinner.style.display = 'none';
        }
    });
})();
</script>
@endpush

