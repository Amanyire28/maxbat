@extends('layouts.app')
@section('title', 'About — MaxBat Automobil')
@section('meta_desc', 'Learn about MaxBat Automobil — 15+ years of performance engineering, certified technicians, and premium automotive solutions.')

@push('styles')
<style>
    .about-grid { display: grid; grid-template-columns: 1fr; gap: 60px; margin-top: 60px; }
    @media(min-width:1024px){ .about-grid { grid-template-columns: 1fr 1fr; align-items: center; } }
    .about-img { border-radius: 14px; overflow: hidden; aspect-ratio: 4/3; }
    .about-img img { width: 100%; height: 100%; object-fit: cover; }
    .about-text h2 { font-family: 'Bebas Neue', sans-serif; font-size: clamp(32px,5vw,52px); font-weight: 400; text-transform: uppercase; color: #fff; margin-bottom: 20px; }
    .about-text h2 span { color: var(--green); }
    .about-text p { color: var(--card-subtext); font-size: 16px; line-height: 1.8; margin-bottom: 16px; }
    .stat-row { display: grid; grid-template-columns: repeat(2,1fr); gap: 20px; margin-top: 36px; }
    @media(min-width:640px){ .stat-row { grid-template-columns: repeat(4,1fr); } }
    .stat-card { text-align: center; padding: 24px 16px; background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; }
    .stat-num { font-family: 'Bebas Neue', sans-serif; font-size: 40px; font-weight: 400; color: var(--green); display: block; line-height: 1; }
    .stat-label { font-size: 12px; color: var(--card-subtext); text-transform: uppercase; letter-spacing: 1px; margin-top: 6px; }
    .team-grid { display: grid; grid-template-columns: repeat(2,1fr); gap: 20px; margin-top: 48px; }
    @media(min-width:768px){ .team-grid { grid-template-columns: repeat(4,1fr); } }
    .team-card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; transition: all 0.3s; }
    .team-card:hover { border-color: var(--green-border); transform: translateY(-3px); }
    .team-avatar { aspect-ratio: 1; background: #222; display: flex; align-items: center; justify-content: center; font-size: 48px; color: var(--green); }
    .team-body { padding: 16px; text-align: center; }
    .team-name { font-family: 'Bebas Neue', sans-serif; font-size: 18px; font-weight: 400; text-transform: uppercase; color: #fff; }
    .team-role { font-size: 13px; color: var(--green); margin-top: 4px; }
</style>
@endpush

@section('content')
<div class="page-hero">
    <div class="page-hero-breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fa fa-chevron-right"></i>About</div>
    <h1>About <span>MaxBat</span></h1>
    <p>15+ years of performance engineering, trusted by enthusiasts and professionals across the region.</p>
</div>

<section class="section-pad" style="background:var(--section-dark);">
    <div class="container">
        <div class="about-grid">
            <div class="about-img reveal-left">
                <img src="https://images.unsplash.com/photo-1487754180451-c456f719a1fc?w=900&q=80" alt="MaxBat workshop" loading="lazy">
            </div>
            <div class="about-text reveal-right">
                <h2>Engineered For <span>Excellence</span></h2>
                <p>MaxBat Automobil was founded with a single mission — to deliver world-class automotive performance solutions to enthusiasts and professionals who refuse to compromise.</p>
                <p>From our state-of-the-art workshop, our certified technicians apply precision engineering to every vehicle that passes through our doors. Whether it's a Stage 1 ECU remap or a full turbo build, we treat every car as if it were our own.</p>
                <p>We partner with the world's leading performance brands including Akrapovič, BOSCH, Alientech, Garrett, Brembo and more — giving you access to the finest components on the market.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary" style="margin-top:24px;">
                    <i class="fa fa-envelope"></i> Get In Touch
                </a>
            </div>
        </div>

        <div class="stat-row reveal" style="margin-top:60px;">
            @foreach([['850+','Vehicles Tuned'],['99%','Satisfaction Rate'],['15+','Years Experience'],['120+','Brands Supported']] as $s)
            <div class="stat-card">
                <span class="stat-num">{{ $s[0] }}</span>
                <div class="stat-label">{{ $s[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-pad" style="background:var(--section-alt);">
    <div class="container">
        <div class="reveal" style="text-align:center;">
            <div class="section-label" style="justify-content:center;">The Team</div>
            <h2 class="section-title" style="text-align:center;">Meet Our <span>Specialists</span></h2>
        </div>
        <div class="team-grid">
            @foreach([
                ['fa-user','Nikola Petrović','Lead ECU Tuner'],
                ['fa-user','Stefan Marković','Turbo Specialist'],
                ['fa-user','Marija Ilić','Diagnostics Expert'],
                ['fa-user','Aleksandar Đorić','Performance Engineer'],
            ] as $m)
            <div class="team-card reveal">
                <div class="team-avatar"><i class="fa {{ $m[0] }}"></i></div>
                <div class="team-body">
                    <div class="team-name">{{ $m[1] }}</div>
                    <div class="team-role">{{ $m[2] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

