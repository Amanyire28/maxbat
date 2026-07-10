@extends('layouts.app')
@section('title', 'Cars for Sale — MaxBat Second-Hand Vehicles')
@section('meta_desc', 'Browse available high-quality second-hand cars for sale. Fully inspected performance cars, sedans, and SUVs.')

@section('content')
<style>
    .cars-hero {
        padding: 80px 0 50px;
        background: linear-gradient(rgba(10,10,10,0.85), rgba(15,15,15,1)), url('{{ asset('storage/maxbat.jpg') }}') center/cover no-repeat;
        text-align: center;
        border-bottom: 1px solid var(--border);
    }
    .cars-hero h1 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 56px;
        letter-spacing: 2px;
        color: #fff;
        margin-bottom: 12px;
        text-transform: uppercase;
    }
    .cars-hero p {
        font-size: 16px;
        color: var(--muted);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }
    .cars-section {
        padding: 60px 0 90px;
        background: #0f0f0f;
    }
    .cars-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }
    @media(min-width: 640px) {
        .cars-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media(min-width: 1024px) {
        .cars-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    .car-card {
        background: #161616;
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .car-card:hover {
        border-color: var(--green-border);
        transform: translateY(-4px);
        box-shadow: 0 16px 48px rgba(0,0,0,0.5);
    }
    .car-img {
        position: relative;
        width: 100%;
        aspect-ratio: 16/10;
        overflow: hidden;
        background: #1a1a1a;
    }
    .car-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .car-card:hover .car-img img {
        transform: scale(1.04);
    }
    .car-badge-year {
        position: absolute;
        top: 14px;
        left: 14px;
        background: #000;
        color: #fff;
        padding: 4px 10px;
        font-size: 12px;
        font-weight: 700;
        border-radius: 6px;
        border: 1px solid rgba(255,255,255,0.15);
    }
    .car-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .car-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 24px;
        letter-spacing: 0.5px;
        color: #fff;
        text-transform: uppercase;
        margin-bottom: 8px;
    }
    .car-price {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 26px;
        color: var(--green);
        margin-bottom: 14px;
        letter-spacing: 0.5px;
    }
    .car-specs {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-bottom: 20px;
        font-size: 13px;
        color: var(--muted);
    }
    .car-spec-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .car-spec-item i {
        color: var(--green);
        font-size: 14px;
        width: 16px;
        text-align: center;
    }
    .btn-car-detail {
        margin-top: auto;
        width: 100%;
        padding: 12px;
        background: transparent;
        border: 1px solid rgba(255,255,255,0.12);
        color: #fff;
        border-radius: 8px;
        font-family: 'Barlow', sans-serif;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        display: block;
        text-decoration: none;
    }
    .car-card:hover .btn-car-detail {
        background: var(--green);
        color: #000;
        border-color: var(--green);
    }
</style>

<section class="cars-hero" aria-labelledby="cars-title">
    <div class="container">
        <h1 id="cars-title">Second-Hand Cars For Sale</h1>
        <p>Premium pre-owned cars, thoroughly inspected and prepared by our engineering team to ensure quality, performance, and durability.</p>
    </div>
</section>

<section class="cars-section" aria-label="Cars List">
    <div class="container">
        <div class="cars-grid">
            @forelse($cars as $car)
            <article class="car-card reveal">
                <div class="car-img">
                    @if($car->image)
                        <img src="{{ asset('storage/'.$car->image) }}" alt="{{ $car->make }} {{ $car->model }}">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#1a1a1a;">
                            <i class="fa fa-car" style="font-size:48px;color:rgba(255,255,255,0.06);"></i>
                        </div>
                    @endif
                    <div class="car-badge-year">{{ $car->year }}</div>
                </div>
                <div class="car-body">
                    <h3 class="car-title">{{ $car->make }} {{ $car->model }}</h3>
                    <div class="car-price">UGX {{ number_format($car->price, 0) }}</div>
                    
                    <div class="car-specs">
                        <div class="car-spec-item"><i class="fa fa-tachometer-alt"></i> {{ number_format($car->mileage) }} km</div>
                        <div class="car-spec-item"><i class="fa fa-cog"></i> {{ $car->transmission }}</div>
                        <div class="car-spec-item"><i class="fa fa-gas-pump"></i> {{ $car->fuel_type }}</div>
                        @if($car->engine_size)
                            <div class="car-spec-item"><i class="fa fa-microchip"></i> {{ $car->engine_size }}</div>
                        @else
                            <div class="car-spec-item"><i class="fa fa-car-side"></i> Specs Info</div>
                        @endif
                    </div>
                    
                    <a href="{{ route('cars_for_sale.show', $car->id) }}" class="btn-car-detail">View Details</a>
                </div>
            </article>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; border: 1px dashed rgba(255,255,255,0.1); border-radius: 14px; background: #161616;">
                <i class="fa fa-car" style="font-size: 48px; color: var(--green); opacity: 0.3; margin-bottom: 16px; display: block;"></i>
                <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 24px; color: #fff; text-transform: uppercase;">No Cars Listed Right Now</h3>
                <p style="color: var(--muted); font-size: 14px; margin-top: 6px;">Check back soon! We update our second-hand stock frequently.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
