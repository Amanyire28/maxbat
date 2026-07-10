@extends('layouts.app')
@section('title', 'Blog — MaxBat Automobil')
@section('meta_desc', 'Performance tips, maintenance guides, tuning knowledge and product reviews from the MaxBat team.')

@push('styles')
<style>
    .blog-grid { display: grid; grid-template-columns: 1fr; gap: 24px; margin-top: 48px; }
    @media(min-width:768px){ .blog-grid { grid-template-columns: repeat(2,1fr); } }
    @media(min-width:1024px){ .blog-grid { grid-template-columns: repeat(3,1fr); } }
    .blog-card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; transition: all 0.3s ease; }
    .blog-card:hover { border-color: var(--green-border); transform: translateY(-4px); box-shadow: 0 16px 48px rgba(0,0,0,0.5); }
    .blog-img { aspect-ratio: 16/9; overflow: hidden; background: #111; }
    .blog-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .blog-card:hover .blog-img img { transform: scale(1.05); }
    .blog-body { padding: 24px; }
    .blog-cat { display: inline-block; padding: 4px 12px; border-radius: 4px; background: var(--green-light); color: var(--green); font-family: 'Barlow', sans-serif; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 12px; }
    .blog-body h3 { font-family: 'Bebas Neue', sans-serif; font-size: 21px; font-weight: 400; margin-bottom: 10px; line-height: 1.35; color: #fff; text-transform: uppercase; }
    .blog-body p { color: var(--card-subtext); font-size: 14px; line-height: 1.65; margin-bottom: 16px; }
    .blog-meta { display: flex; align-items: center; gap: 14px; font-size: 12px; color: rgba(255,255,255,0.35); }
    .blog-meta span { display: flex; align-items: center; gap: 5px; }
</style>
@endpush

@section('content')
<div class="page-hero">
    <div class="page-hero-breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fa fa-chevron-right"></i>Blog</div>
    <h1>Blog & <span>Knowledge</span></h1>
    <p>Performance tips, maintenance guides, tuning knowledge and expert product reviews.</p>
</div>

<section class="section-pad" style="background:var(--section-dark);">
    <div class="container">
        <div class="reveal">
            <div class="section-label">Knowledge Centre</div>
            <h2 class="section-title">Latest <span>Articles</span></h2>
        </div>
        <div class="blog-grid">
            @foreach([
                ['https://images.unsplash.com/photo-1580274455191-1c62238fa333?w=800&q=80','Tuning Knowledge','Stage 1 vs Stage 2 vs Stage 3 — Which ECU Tune is Right For You?','A complete breakdown of ECU tune stages, what hardware is required, and realistic power gains to expect.','6 min read','June 2026'],
                ['https://images.unsplash.com/photo-1487754180451-c456f719a1fc?w=800&q=80','Maintenance Guide','Turbocharger Care: How to Make Your Turbo Last 300,000km','Essential maintenance tips, oil change intervals and cool-down procedures to maximise turbocharger lifespan.','5 min read','May 2026'],
                ['https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=800&q=80','Product Review','Top 5 Performance Exhaust Systems for 2026 — Tested & Reviewed','We dyno-tested the top exhaust brands on identical platforms. Here is what we found.','8 min read','April 2026'],
                ['https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&q=80','Performance Tips','How to Prepare Your Car for a Dyno Tune — A Complete Guide','Everything you need to do before bringing your vehicle in for an ECU calibration session.','7 min read','March 2026'],
                ['https://images.unsplash.com/photo-1542362567-b07e54358753?w=800&q=80','Tuning Knowledge','Intercooler Upgrades — Why They Matter and Which to Choose','Explaining FMIC vs TMIC, core sizing, and which upgrade makes the most sense for your build.','6 min read','February 2026'],
                ['https://images.unsplash.com/photo-1626248801379-51a0748a5f96?w=800&q=80','Maintenance Guide','Brakes for Performance Cars — Pads, Rotors and Fluid Guide','Choosing the right brake setup for track days and spirited road driving without destroying your daily.','5 min read','January 2026'],
            ] as $post)
            <article class="blog-card reveal">
                <div class="blog-img"><img src="{{ $post[0] }}" alt="{{ $post[2] }}" loading="lazy"></div>
                <div class="blog-body">
                    <span class="blog-cat">{{ $post[1] }}</span>
                    <h3>{{ $post[2] }}</h3>
                    <p>{{ $post[3] }}</p>
                    <div class="blog-meta">
                        <span><i class="fa fa-clock"></i> {{ $post[4] }}</span>
                        <span><i class="fa fa-calendar"></i> {{ $post[5] }}</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endsection

