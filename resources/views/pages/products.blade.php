@extends('layouts.app')
@section('title', 'Products — MaxBat Automobil')
@section('meta_desc', 'Shop premium automotive products — lubricants, differential fluid, Android car screens, car speakers and more.')

@push('styles')
<style>
    .products-grid { display: grid; grid-template-columns: 1fr; gap: 24px; margin-top: 48px; }
    @media(min-width:640px){ .products-grid { grid-template-columns: repeat(2,1fr); } }
    @media(min-width:1024px){ .products-grid { grid-template-columns: repeat(2,1fr); } }
    .product-card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; transition: all 0.3s ease; }
    .product-card:hover { border-color: var(--green-border); transform: translateY(-4px); box-shadow: 0 16px 48px rgba(0,0,0,0.5); }
    .product-img { position: relative; aspect-ratio: 16/10; overflow: hidden; background: #111; }
    .product-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
    .product-card:hover .product-img img { transform: scale(1.06); }
    .product-badge { position: absolute; top: 14px; left: 14px; background: var(--green); color: #000; font-family: 'Barlow', sans-serif; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; padding: 5px 12px; border-radius: 4px; }
    .product-actions-hover { position: absolute; bottom: -64px; left: 0; right: 0; background: rgba(15,15,15,0.96); display: flex; gap: 10px; padding: 14px; transition: bottom 0.3s ease; }
    .product-card:hover .product-actions-hover { bottom: 0; }
    .product-actions-hover button { flex: 1; padding: 11px; border-radius: 5px; font-family: 'Barlow', sans-serif; font-size: 13px; font-weight: 700; text-transform: uppercase; transition: all 0.2s; cursor: pointer; }
    .btn-quote { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: #fff; }
    .btn-quote:hover { border-color: var(--green); color: var(--green); }
    .btn-cart { background: var(--green); color: #000; border: none; }
    .btn-cart:hover { background: #68e000; }
    .product-body { padding: 26px; }
    .product-cat { font-size: 11px; color: var(--green); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px; font-weight: 700; }
    .product-name { font-family: 'Bebas Neue', sans-serif; font-size: 24px; font-weight: 400; margin-bottom: 10px; color: #fff; text-transform: uppercase; line-height: 1.2; }
    .product-desc { font-size: 14px; color: var(--card-subtext); line-height: 1.6; margin-bottom: 18px; }
    .product-price { display: flex; align-items: center; justify-content: space-between; }
    .price { font-family: 'Bebas Neue', sans-serif; font-size: 28px; color: var(--green); }
    .price-old { font-size: 14px; color: rgba(255,255,255,0.35); text-decoration: line-through; }
</style>
@endpush

@section('content')
<div class="page-hero">
    <div class="page-hero-breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fa fa-chevron-right"></i>Products</div>
    <h1>Our <span>Products</span></h1>
    <p>Quality automotive products carefully selected for performance, durability and value.</p>
</div>

<section class="section-pad" style="background:var(--section-dark);">
    <div class="container">
        <div class="reveal">
            <div class="section-label">Shop Now</div>
            <h2 class="section-title">Automotive <span>Products</span></h2>
            <p class="section-desc">From engine care to in-car technology — everything your vehicle needs in one place.</p>
        </div>
        <div class="products-grid">

            @forelse($products as $index => $product)
            <article class="product-card reveal" style="transition-delay:{{ $index * 0.05 }}s;">
                <div class="product-img">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#1a1a1a;">
                            <i class="fa fa-image" style="font-size:48px;color:rgba(255,255,255,0.1);"></i>
                        </div>
                    @endif
                    @if($product->badge)
                        <div class="product-badge">{{ $product->badge }}</div>
                    @endif
                    <div class="product-actions-hover">
                        <a href="https://wa.me/256701244403?text={{ urlencode('Hello MaxBat, I would like to get a quote for: ') }}{{ urlencode($product->name) }}{{ urlencode('. Please advise on availability and pricing. Thank you.') }}"
                           target="_blank" rel="noopener noreferrer"
                           class="btn-quote" style="display:flex;align-items:center;justify-content:center;gap:6px;text-decoration:none;">
                            <i class="fab fa-whatsapp" style="color:#25D366;"></i> Quick Contact
                        </a>
                        <button class="btn-cart"
                            onclick="addToCart(
                                {{ $product->id }},
                                {{ json_encode($product->name) }},
                                {{ json_encode($product->price ?? '') }},
                                {{ json_encode($product->image ? asset('storage/'.$product->image) : '') }}
                            )">
                            <i class="fa fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
                <div class="product-body">
                    <div class="product-cat">{{ $product->category }}</div>
                    <div class="product-name">{{ $product->name }}</div>
                    @if($product->description)
                        <div class="product-desc">{{ $product->description }}</div>
                    @endif
                    @if($product->price)
                    <div class="product-price">
                        <span class="price">{{ $product->price }}</span>
                    </div>
                    @endif
                </div>
            </article>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:60px 20px;">
                <i class="fa fa-box-open" style="font-size:48px;color:rgba(255,255,255,0.1);margin-bottom:16px;display:block;"></i>
                <p style="color:rgba(255,255,255,0.4);font-size:16px;">No products available yet. Check back soon.</p>
            </div>
            @endforelse

        </div>

        {{-- CTA --}}
        <div class="reveal" style="text-align:center;margin-top:60px;">
            <p style="color:var(--card-subtext);font-size:16px;margin-bottom:20px;">Looking for something specific? Get in touch and we'll source it for you.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">
                <i class="fa fa-envelope"></i> Contact Us
            </a>
        </div>
    </div>
</section>
@endsection

