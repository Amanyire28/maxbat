@extends('layouts.app')
@section('title', $car->make . ' ' . $car->model . ' (' . $car->year . ') — MaxBat')
@section('meta_desc', 'Get details and specs for the second-hand ' . $car->make . ' ' . $car->model . '. Available for sale at MaxBat.')

@section('content')
<style>
    .car-detail-section {
        padding: 50px 0 90px;
        background: #0f0f0f;
    }
    .back-nav {
        margin-bottom: 24px;
    }
    .back-nav a {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--muted);
        font-size: 14px;
        font-weight: 500;
        transition: color 0.2s;
    }
    .back-nav a:hover {
        color: var(--green);
    }
    .car-detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 40px;
    }
    @media(min-width: 1024px) {
        .car-detail-grid {
            grid-template-columns: 1.2fr 1fr;
        }
    }
    
    /* GALLERY */
    .gallery-container {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .main-photo {
        width: 100%;
        aspect-ratio: 16/10;
        background: #161616;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border);
    }
    .main-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .thumbnail-grid {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .thumb-item {
        width: 80px;
        height: 55px;
        border-radius: 6px;
        overflow: hidden;
        border: 2px solid transparent;
        cursor: pointer;
        background: #161616;
        transition: all 0.2s;
    }
    .thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .thumb-item.active, .thumb-item:hover {
        border-color: var(--green);
    }
    
    /* DETAILS SIDEBAR */
    .car-info-sidebar {
        display: flex;
        flex-direction: column;
    }
    .car-header {
        margin-bottom: 24px;
        border-bottom: 1px solid var(--border);
        padding-bottom: 20px;
    }
    .car-year-badge {
        font-size: 13px;
        font-weight: 700;
        color: var(--green);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 8px;
        display: block;
    }
    .car-name-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 40px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 1px;
        line-height: 1.1;
        margin-bottom: 10px;
    }
    .car-detail-price {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 36px;
        color: var(--green);
        letter-spacing: 0.5px;
    }
    .cta-container {
        margin-bottom: 30px;
    }
    .btn-inquire-whatsapp {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 15px;
        background: #25D366;
        color: #000;
        font-family: 'Barlow', sans-serif;
        font-weight: 700;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-inquire-whatsapp:hover {
        background: #20ba5a;
    }
    .btn-inquire-call {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 12px;
        background: rgba(255,255,255,0.06);
        border: 1px solid var(--border);
        color: #fff;
        font-family: 'Barlow', sans-serif;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 8px;
        text-decoration: none;
        margin-top: 10px;
        transition: all 0.2s;
    }
    .btn-inquire-call:hover {
        background: rgba(255,255,255,0.12);
        border-color: rgba(255,255,255,0.2);
    }
    
    /* SPECS TABLE */
    .specs-card {
        background: #161616;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 30px;
    }
    .specs-card h4 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 20px;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 16px;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        padding-bottom: 8px;
    }
    .specs-table {
        width: 100%;
        border-collapse: collapse;
    }
    .specs-table tr {
        border-bottom: 1px solid rgba(255,255,255,0.03);
    }
    .specs-table tr:last-child {
        border-bottom: none;
    }
    .specs-table td {
        padding: 10px 0;
        font-size: 14px;
    }
    .specs-table td.label {
        color: var(--muted);
        font-weight: 500;
        width: 45%;
    }
    .specs-table td.value {
        color: #fff;
        font-weight: 600;
        text-align: right;
    }
    
    /* DESCRIPTION */
    .car-description-section {
        margin-top: 40px;
        border-top: 1px solid var(--border);
        padding-top: 40px;
    }
    .car-description-section h3 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 24px;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 18px;
    }
    .car-description-text {
        color: rgba(255,255,255,0.7);
        font-size: 15px;
        line-height: 1.8;
    }
    .car-description-text p {
        margin-bottom: 16px;
    }
</style>

<section class="car-detail-section" aria-labelledby="car-page-title">
    <div class="container">
        
        <div class="back-nav">
            <a href="{{ route('cars_for_sale') }}"><i class="fa fa-arrow-left"></i> Back to Cars for Sale</a>
        </div>
        
        <div class="car-detail-grid">
            
            {{-- PHOTOS GALLERY --}}
            <div class="gallery-container">
                <div class="main-photo">
                    @if($car->image)
                        <img id="mainCarImage" src="{{ asset('storage/'.$car->image) }}" alt="{{ $car->make }} {{ $car->model }}">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#161616;">
                            <i class="fa fa-car" style="font-size:72px;color:rgba(255,255,255,0.05);"></i>
                        </div>
                    @endif
                </div>
                
                @if(($car->gallery && count($car->gallery) > 0) || $car->image)
                <div class="thumbnail-grid" role="group" aria-label="Photo thumbnails">
                    @if($car->image)
                        <button class="thumb-item active" onclick="setMainImage('{{ asset('storage/'.$car->image) }}', this)" aria-label="Main photo view">
                            <img src="{{ asset('storage/'.$car->image) }}" alt="Main thumbnail">
                        </button>
                    @endif
                    @if($car->gallery)
                        @foreach($car->gallery as $idx => $gImage)
                            <button class="thumb-item" onclick="setMainImage('{{ asset('storage/'.$gImage) }}', this)" aria-label="Gallery photo {{ $idx+1 }}">
                                <img src="{{ asset('storage/'.$gImage) }}" alt="Thumbnail {{ $idx+1 }}">
                            </button>
                        @endforeach
                    @endif
                </div>
                @endif
            </div>
            
            {{-- DETAILS PANEL --}}
            <div class="car-info-sidebar">
                <header class="car-header">
                    <span class="car-year-badge">{{ $car->year }} MODEL</span>
                    <h1 id="car-page-title" class="car-name-title">{{ $car->make }} {{ $car->model }}</h1>
                    <div class="car-detail-price">UGX {{ number_format($car->price, 0) }}</div>
                </header>
                
                <div class="cta-container">
                    <a href="https://wa.me/256701244403?text={{ rawurlencode('Hello MaxBat, I would like to inquire about the listed ') }}{{ rawurlencode($car->year) }}{{ rawurlencode(' ') }}{{ rawurlencode($car->make) }}{{ rawurlencode(' ') }}{{ rawurlencode($car->model) }}{{ rawurlencode(' priced at UGX ') }}{{ rawurlencode(number_format($car->price, 0)) }}{{ rawurlencode('. Is it still available for viewing?') }}" 
                       target="_blank" rel="noopener noreferrer" class="btn-inquire-whatsapp">
                        <i class="fab fa-whatsapp"></i> Inquire via WhatsApp
                    </a>
                    <a href="tel:+256703560021" class="btn-inquire-call">
                        <i class="fa fa-phone"></i> Call Workshop Inquiry
                    </a>
                </div>
                
                <div class="specs-card">
                    <h4>Technical Specifications</h4>
                    <table class="specs-table" aria-label="Vehicle Specs">
                        <tbody>
                            <tr>
                                <td class="label">Make</td>
                                <td class="value">{{ $car->make }}</td>
                            </tr>
                            <tr>
                                <td class="label">Model</td>
                                <td class="value">{{ $car->model }}</td>
                            </tr>
                            <tr>
                                <td class="label">Year</td>
                                <td class="value">{{ $car->year }}</td>
                            </tr>
                            <tr>
                                <td class="label">Mileage</td>
                                <td class="value">{{ number_format($car->mileage) }} km</td>
                            </tr>
                            <tr>
                                <td class="label">Transmission</td>
                                <td class="value">{{ $car->transmission }}</td>
                            </tr>
                            <tr>
                                <td class="label">Fuel Type</td>
                                <td class="value">{{ $car->fuel_type }}</td>
                            </tr>
                            @if($car->engine_size)
                            <tr>
                                <td class="label">Engine Size</td>
                                <td class="value">{{ $car->engine_size }}</td>
                            </tr>
                            @endif
                            @if($car->color)
                            <tr>
                                <td class="label">Color</td>
                                <td class="value">{{ $car->color }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        {{-- VEHICLE DESCRIPTION --}}
        @if($car->description)
        <div class="car-description-section">
            <h3>Vehicle Details & Description</h3>
            <div class="car-description-text">
                {!! nl2br(e($car->description)) !!}
            </div>
        </div>
        @endif
        
    </div>
</section>

<script>
function setMainImage(url, element) {
    document.getElementById('mainCarImage').src = url;
    
    // Toggle active classes
    const thumbs = document.querySelectorAll('.thumb-item');
    thumbs.forEach(t => t.classList.remove('active'));
    element.classList.add('active');
}
</script>
@endsection
